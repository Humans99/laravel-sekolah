<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'username' => 'admin',
            'password' => Hash::make('admin')
        ];
    }
}
