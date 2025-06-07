<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    public function definition(): array
    {
        $start = $this->faker->dateTime('now');
        return [
            'start' => $start,
            'end' => $this->faker->dateTimeBetween($start, '+2 hours'),
            'teacher_id' => Teacher::factory(),
            'class_id' => ClassModel::factory(),
            'grade_id' => Grade::factory(),
        ];
    }
}
