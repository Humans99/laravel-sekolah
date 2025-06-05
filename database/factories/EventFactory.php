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
        return [
            'class_id' => ClassModel::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
        ];
    }
}
