<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $classes = ClassModel::all();

        foreach ($classes as $class) {
            foreach ($subjects as $subject) {
                Lesson::factory()->create([
                    'class_id' => $class->id,
                    'subject_id' => $subject->id,
                    'teacher_id' => $teachers->random()->id,
                ]);
            }
        }
    }
}
