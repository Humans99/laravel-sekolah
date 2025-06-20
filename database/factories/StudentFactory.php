<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    protected $model = Student::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'student'])->id,
            'parent_id' => ParentModel::factory(),
            'grade_id' => Grade::factory(),
            'class_id' => ClassModel::factory(),
            'name' => $this->faker->name,
            'nis' => $this->faker->unique()->numerify('##########'),
            'phone' => $this->faker->unique()->numerify("08##-####-####"),
            'bloodType' => $this->faker->randomElement(['A', 'AB', 'B', 'O']),
            'gender' => $this->faker->randomElement(['Pria', 'Wanita'])
        ];
    }
}
