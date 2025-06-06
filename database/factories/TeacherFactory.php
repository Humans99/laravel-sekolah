<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'teacher'])->id,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->numerify("08##-####-####"),
            'address' => $this->faker->address,
            'bloodType' => $this->faker->randomElement(['A', "B", 'AB', 'O']),
            'gender' => $this->faker->randomElement(['Pria', "Wanita"]),
        ];
    }
}
