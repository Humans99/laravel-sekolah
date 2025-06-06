<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        ClassModel::all()->each(fn($class) => Event::factory(3)->create(['class_id' => $class->id]));
    }
}
