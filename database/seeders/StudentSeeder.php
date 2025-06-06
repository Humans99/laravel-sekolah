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
        $grades = Grade::all();
        $classes = ClassModel::all();

        foreach ($parents as $parent) {
            Student::factory()->create([
                'parent_id' => $parent->id,
                'class_id' => $classes->random()->id,
                'grade_id' => $grades->random()->id,
            ]);
        }
    }
}
