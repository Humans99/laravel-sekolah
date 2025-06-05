<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    public function definition(): array
    {
        return [
            'teacher_id' => Teacher::factory(),
            'subject_id' => Subject::factory(),
            'class_id' => ClassModel::factory(),
        ];
    }
}
