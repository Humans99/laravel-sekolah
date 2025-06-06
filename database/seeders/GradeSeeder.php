<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        Grade::factory()->create(['level' => 'Grade 7']);
        Grade::factory()->create(['level' => 'Grade 8']);
        Grade::factory()->create(['level' => 'Grade 9']);
    }
}
