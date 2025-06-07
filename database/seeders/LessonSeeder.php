<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $grades = Grade::all();
        $classes = ClassModel::all();

        foreach ($grades as $grade) {
            foreach ($classes as $class) {
                $subjects = Subject::inRandomOrder()->limit(4)->get();
                foreach ($subjects as $subject) {
                    $teacher = Teacher::where('subject_id', $subject->id)->inRandomOrder()->first();

                    if (!$teacher) {
                        continue;
                    }

                    $start = $faker->dateTimeBetween('08:00', '12:00');
                    $end = (clone $start)->modify('+1 hour');

                    Lesson::create([
                        'name' => $grade->level . '-' . $class->name,
                        'grade_id' => $grade->id,
                        'class_id' => $class->id,
                        'subject_id' => $teacher->subject->id,
                        'teacher_id' => $teacher->id,
                        'start' => $start,
                        'end' => $end,
                    ]);
                }
            }
        }
    }
}
