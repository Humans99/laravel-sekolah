<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModelFactory extends Factory
{
    use HasFactory;
    protected $model = ClassModel::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I']),
            'capacity' => $this->faker->numberBetween(20, 40),
            'supervisor_id' => Teacher::factory()
        ];
    }
}
