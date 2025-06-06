<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'lesson_id' => Lesson::factory(),
            'date' => $this->faker->dateTime,
            'status' => $this->faker->randomElement(['Hadir', 'Sakit', 'Ijin', 'Alfa'])
        ];
    }
}
