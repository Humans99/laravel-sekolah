<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
    }

    public function show(Student $student)
    {
        $student->load(['user', 'parent', 'grade', 'class', 'attendances', 'results']);

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
