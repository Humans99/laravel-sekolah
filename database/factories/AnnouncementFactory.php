<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;
    public function definition(): array
    {
        return [
            'class_id' => ClassModel::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTime
        ];
    }
}
