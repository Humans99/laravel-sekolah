<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        $students->each(function ($student) {
            Assignment::inRandomOrder()->limit(2)->get()->each(function ($assignment) use ($student) {
                Result::factory()->create([
                    'student_id' => $student->id,
                    'assignment_id' => $assignment->id,
                    'exam_id' => null,
                ]);
            });

            Exam::inRandomOrder()->limit(2)->get()->each(function ($exam) use ($student) {
                Result::factory()->create([
                    'student_id' => $student->id,
                    'exam_id' => $exam->id,
                    'assignment_id' => null,
                ]);
            });
        });
    }
}
