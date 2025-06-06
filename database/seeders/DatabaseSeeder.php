<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GradeSeeder::class,
            SubjectSeeder::class,
            // UserSeeder::class,
            AdminSeeder::class,
            TeacherSeeder::class,
            ParentSeeder::class,
            ClassSeeder::class,
            StudentSeeder::class,
            LessonSeeder::class,
            AssignmentSeeder::class,
            ExamSeeder::class,
            AttendanceSeeder::class,
            AnnouncementSeeder::class,
            EventSeeder::class,
            ResultSeeder::class,
        ]);
    }
}
