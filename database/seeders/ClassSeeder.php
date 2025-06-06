<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        ClassModel::factory(5)->create();
    }
}
