<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $parents = ParentModel::all();
        $grades = Grade::pluck('id');
        $classes = ClassModel::pluck('id');

        foreach ($parents as $parent) {
            // Buat 1 hingga 3 siswa untuk setiap ortu
            $childOut = random_int(1, 3);
            for ($i = 0; $i < $childOut; $i++) {
                Student::factory()->create([
                    'parent_id' => $parent->id,
                    'class_id' => $classes->random(),
                    'grade_id' => $grades->random(),
                ]);
            }
        }
    }
}
