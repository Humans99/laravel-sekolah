<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'parent', 'grade', 'class'])
            ->paginate(request()->get('per_page', 10));

        if ($students->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No students found'
            ], 404);
        }

        return new StudentResource(
            $students,
            200,
            'Students retrieved successfully'
        );
    }

    public function registerFull(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:students,nis',
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
            $nis = $request->nis;
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
            ]);

            // Student Account
            $studentUser = User::create([
                'username' => $nis,
                'email' => $request->user()->email,
                'password' => Hash::make($nis),
                'role' => 'student',
            ]);

            $student = $studentUser->student()->create([
                'user_id' => $studentUser->id,
                'parent_id' => $parent->id,
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'bloodType' => $request->bloodType,
                'nis' => $request->nis,
                'gender' => $request->gender
            ]);

            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Student registered successfully',
                'data' => new StudentResource($student)
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to register student',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $student = Student::with(['user', 'parent', 'grade', 'class'])->find($id);
        if (!$student) {
            return response()->json([
                'status' => 404,
                'error' => true,
                'message' => 'Student not found'
            ], 404);
        }
        return new StudentResource(
            $student,
            200,
            'Student retrieved successfully'
        );
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
