<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $username = $this->faker->unique()->userName;
        return [
            'username' => $username,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($username),
            'role' => $this->faker->randomElement(['admin', 'teacher', 'student', 'parent'])
        ];
    }
}
