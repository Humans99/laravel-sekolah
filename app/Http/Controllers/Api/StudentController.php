<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function index()
    {
        $perPage = request()->get('per_page', 12);

        $students = Student::with(['user', 'parent', 'grade', 'class'])
            ->paginate($perPage);

        if ($students->isEmpty()) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'No students found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new StudentCollection($students);
    }

    public function registerFull(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'gender' => 'required|in:Pria,Wanita',
            'phone' => 'required|unique:students,phone',
            'bloodType' => 'required|in:A,AB,B,O',
            'parent_id' => 'nullable|exists:parents,id',
            'class_id' => 'required|exists:classes,id',
            'grade_id' => 'required|exists:grades,id',
            'email' => 'required|email|unique:users,email',

            'parent_name' => 'required|string',
            'parent_email' => 'required|email|unique:users,email',
            'parent_phone' => 'required|unique:parents,phone',
            'parent_address' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $nis = $this->generateUniqueNis();
            $last4 = substr($nis, -4);

            // Parent Account
            $parentUser = User::create([
                'username' => 'ORTU' . $last4,
                'email' => $request->parent_email,
                'password' => Hash::make('ORTU' . $last4),
                'role' => 'parent',
            ]);

            $parent = $parentUser->parent()->create([
                'name' => $request->parent_name,
                'user_id' => $parentUser->id,
                'phone' => $request->parent_phone,
                'address' => $request->parent_address ?? 'No address provided',
            ]);

            // Student Account
            $studentUser = User::create([
                'username' => $nis,
                'email' => $request->email,
                'password' => Hash::make($nis),
                'role' => 'student',
            ]);

            $student = $studentUser->student()->create([
                'user_id' => $studentUser->id,
                'parent_id' => $parent->id,
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'nis' => $nis,
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'bloodType' => $request->bloodType,
            ]);

            DB::commit();

            return response()->json([
                'status' => Response::HTTP_CREATED,
                'message' => 'Student registered successfully',
                'data' => new StudentResource($student->load('user', 'parent', 'grade', 'class'))
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to create student',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(string $nis)
    {
        $student = Student::with(['user', 'parent', 'grade', 'class'])->where('nis', $nis)->first();

        if (!$student) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => true,
                'message' => 'Student not found'
            ], Response::HTTP_NOT_FOUND);
        }
        return new StudentResource($student);
    }

    public function updateByNis(Request $request, string $nis) {}


    public function destroyByNis(string $nis)
    {
        $student = Student::where('nis', $nis)->first();

        if (!$student) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => true,
                'message' => "Student not found with the specified nis"
            ], Response::HTTP_NOT_FOUND);
        }

        DB::beginTransaction();

        try {
            // Hapus akun siswa
            $student->user->delete();

            // Hapus aku parent
            $student->parent->user->delete();

            // Hapus data siswa
            $student->delete();

            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => "Student deleted successfully",
            ], Response::HTTP_OK);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'message' => 'Failed to delete student',
                'details' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function generateUniqueNis(): string
    {
        do {
            $nis = str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (Student::where('nis', $nis)->exists());

        return $nis;
    }
}
