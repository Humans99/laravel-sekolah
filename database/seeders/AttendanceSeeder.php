<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        Lesson::all()->each(function ($lesson) {
            Student::inRandomOrder()->limit(3)->get()->each(function ($student) use ($lesson) {
                Attendance::factory()->create([
                    'lesson_id' => $lesson->id,
                    'student_id' => $student->id,
                ]);
            });
        });
    }
}
