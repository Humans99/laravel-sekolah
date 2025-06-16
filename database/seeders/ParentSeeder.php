<?php

namespace Database\Seeders;

use App\Models\ParentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 50 data orang tua
        ParentModel::factory(50)->create();
    }
}
