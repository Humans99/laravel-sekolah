<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        ClassModel::factory()->create(['name' => 'A']);
        ClassModel::factory()->create(['name' => 'B']);
        ClassModel::factory()->create(['name' => 'C']);
        ClassModel::factory()->create(['name' => 'D']);
        ClassModel::factory()->create(['name' => 'E']);
        ClassModel::factory()->create(['name' => 'F']);
        ClassModel::factory()->create(['name' => 'G']);
        ClassModel::factory()->create(['name' => 'H']);
        ClassModel::factory()->create(['name' => 'I']);
    }
}
