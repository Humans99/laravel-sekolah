<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = Subject::pluck('id')->toArray();

        // Buat 20 teacher dengan subject_id acak dari daftar subject yang ada
        Teacher::factory()->count(41)->create([
            'subject_id' => function () use ($subjects) {
                return fake()->randomElement($subjects);
            }
        ]);
    }
}
