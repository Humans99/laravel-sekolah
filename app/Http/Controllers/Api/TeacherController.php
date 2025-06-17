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

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['user', 'subject'])->paginate(request()->get('per_page', 10));

        if ($teachers->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No teachers found'
            ], 404);
        }

        return new TeacherCollection($teachers);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => ['required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', 'unique:users,email'],
            'password' => 'required|string|min:8',

            'subject_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string',
            'bloodType' => 'required|in:A,AB,B,O',
            'gender' => 'required|in:Pria,Wanita',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'role' => 'teacher'
            ]);

            $code = $this->generateUniqueCode();
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'subject_id' => $validated['subject_id'],
                'code' => $code,
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'bloodType' => $validated['bloodType'],
                'gender' => $validated['gender'],
            ]);

            DB::commit();

            return response()->json([
                'status' => 201,
                'message' => 'Teacher created successfully',
                'data' => new TeacherResource($teacher->load(['user', 'subject'])),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create teacher',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(3));
        } while (Teacher::where('code', $code)->exists() || !preg_match('/^[A-Z]{3}$/', $code));
        return $code;
    }

    public function show(string $id)
    {
        $teacher = Teacher::with(['subject', 'user'])->find($id);

        if (!$teacher) {
            return response()->json([
                'status' => 404,
                'error' => true,
                'message' => 'Teacher not found',
            ], 404);
        }

        return new TeacherResource($teacher);
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
