<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    protected $model = Assignment::class;
    public function definition(): array
    {
        $start = $this->faker->dateTime('now');
        return [
            'lesson_id' => Lesson::factory(),
            'title' => $this->faker->sentence(),
            'start' => $this->faker->dateTimeBetween($start),
            'due' => $this->faker->dateTimeBetween($start, '+1 week')
        ];
    }
}
