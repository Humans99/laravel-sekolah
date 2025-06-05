<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    protected $model = Grade::class;
    public function definition(): array
    {
        return [
            'level' => $this->faker->randomElement([7, 8, 9])
        ];
    }
}
