<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@admin.com')->exists()) {

            $user = User::create([
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]);

            Admin::create([
                'user_id' => $user->id,
                'name' => 'Administrator',
            ]);
        }
    }
}
