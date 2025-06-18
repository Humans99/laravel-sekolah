<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherCollection;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
    public function index()
    {
        $perPage = request()->get('per_page', 12);
        $teachers = Teacher::with(['user', 'subject'])->paginate($perPage);

        if ($teachers->isEmpty()) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'No teachers found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new TeacherCollection($teachers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', 'unique:users,email'],
            'subject_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:100',
            'nip' => 'required|string|unique:teachers,nip|min:18|max:18',
            'address' => 'required|string',
            'phone' => 'required|string',
            'bloodType' => 'required|in:A,AB,B,O',
            'gender' => 'required|in:Pria,Wanita',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $validated['nip'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['nip']),
                'role' => 'teacher'
            ]);

            $teacher = Teacher::create([
                'user_id' => $user->id,
                'subject_id' => $validated['subject_id'],
                'code' => $this->generateUniqueCode(),
                'name' => $validated['name'],
                'nip' => $validated['nip'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'bloodType' => $validated['bloodType'],
                'gender' => $validated['gender'],
            ]);

            DB::commit();

            return response()->json([
                'status' => Response::HTTP_CREATED,
                'message' => 'Teacher created successfully',
                'data' => new TeacherResource($teacher->load(['user', 'subject'])),
            ], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Failed to create teacher',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showByCode(string $code)
    {
        $teacher = Teacher::with(['subject', 'user'])->where('code', $code)->first();

        if (!$teacher) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => true,
                'message' => 'Teacher not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return new TeacherResource($teacher);
    }

    public function updateByCode(Request $request, string $code)
    {
        $teacher = Teacher::with('user')->where('code', $code)->first();

        if (!$teacher) {
            if (!$teacher) {
                return response()->json([
                    'status' => Response::HTTP_NOT_FOUND,
                    'error' => true,
                    'message' => 'Teacher not found with the specified code',
                ], Response::HTTP_NOT_FOUND);
            }
        }

        $validated = $request->validate([
            // Teachers
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'bloodType' => 'sometimes|string|in:A,B,AB,O',
            'gender' => 'sometimes|string|in:Pria,Wanita',
            'subject_id' => 'sometimes|exists:subjects,id',
            // Users
            'password' => 'sometimes|string|min:8',
        ]);

        $teacher->update(array_filter($validated, fn($key) => $key !== 'password', ARRAY_FILTER_USE_KEY));

        if (isset($validated['password'])) {
            $teacher->user->update(['password' => bcrypt($validated['password'])]);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Teacher updated successfully',
            'data' => new TeacherResource($teacher->fresh(['user', 'subject'])),
        ], Response::HTTP_OK);
    }

    public function destroyByCode(string $code)
    {
        $teacher = Teacher::where('code', $code)->first();

        if (!$teacher) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'error' => true,
                'message' => 'Teacher not found with the specified code'
            ], Response::HTTP_NOT_FOUND);
        }

        DB::beginTransaction();

        try {
            // Hapus akun guru
            $teacher->user->delete();

            // Hapus data guru
            $teacher->delete();

            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => "Teacher deleted successfully",
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => true,
                'message' => 'Failed to delete teacher',
                'details' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(3));
        } while (Teacher::where('code', $code)->exists() || !preg_match('/^[A-Z]{3}$/', $code));
        return $code;
    }
}
