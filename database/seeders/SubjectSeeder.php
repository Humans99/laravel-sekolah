<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = ['Matematika', 'IPA', "IPS", "Bahasa Indonesia", 'Bahasa Inggris', 'Seni Budaya', 'PJOK', 'PKN', 'Pendidikan Agama'];
        foreach ($subjects as $subject) {
            Subject::create(['name' => $subject]);
        }
    }
}
