<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Lesson::all()->each(fn($lesson) => Assignment::factory(3)->create(['lesson_id' => $lesson->id]));
    }
}
