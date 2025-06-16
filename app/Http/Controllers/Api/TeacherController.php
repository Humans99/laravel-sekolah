<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherCollection;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

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
        //
    }

    public function show(string $id)
    {
        //
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
