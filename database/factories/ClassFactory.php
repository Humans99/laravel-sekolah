<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassFactory extends Factory
{
    protected $model = ClassModel::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomLetter(),
            'capacity' => $this->faker->randomElement([20, 30, 40]),
            'supervisor_id' => Teacher::factory()
        ];
    }
}
