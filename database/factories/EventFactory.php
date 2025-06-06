<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 week', '+1 week');
        return [
            'class_id' => ClassModel::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start' => $start,
            'end' => $this->faker->dateTimeBetween($start, '+3 days'),
        ];
    }
}
