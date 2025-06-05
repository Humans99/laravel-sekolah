<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    protected $model = Result::class;
    public function definition(): array
    {
        return [
            'score' => $this->faker->numberBetween(0, 100),
            'exam_id' => Exam::factory(),
            'assignment_id' => Assignment::factory(),
            'student_id' => Student::factory(),
        ];
    }
}
