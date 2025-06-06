<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    protected $model = Exam::class;
    public function definition(): array
    {
        $start = $this->faker->dateTime;
        return [
            'lesson_id' => Lesson::factory(),
            'title' => $this->faker->sentence(),
            'start' => $start,
            'end' => $this->faker->dateTimeBetween($start, '+1 week')
        ];
    }
}
