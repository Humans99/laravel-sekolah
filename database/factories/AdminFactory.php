<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'admin'])->id(),
            'username' => $this->faker->unique()->userName()
        ];
    }
}
