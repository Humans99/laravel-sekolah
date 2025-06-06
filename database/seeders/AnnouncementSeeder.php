<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\ClassModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        ClassModel::all()->each(fn($class) => Announcement::factory(3)->create(['class_id' => $class->id]));
    }
}
