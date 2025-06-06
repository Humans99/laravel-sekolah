<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        Lesson::all()->each(fn($lesson) => Exam::factory(2)->create(['lesson_id' => $lesson->id]));
    }
}
