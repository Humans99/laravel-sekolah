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
        $username = $this->faker->unique()->userName;
        return [
            'user_id' => User::factory()->create(['role' => 'student'])->id,
            'parent_id' => ParentModel::factory(),
            'grade_id' => Grade::factory(),
            'class_id' => ClassModel::factory(),
            'username' => $username,
            'password' => Hash::make($username),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->numerify("08##-####-####"),
            'address' => $this->faker->address,
            'bloodType' => $this->faker->randomElement(['A', 'AB', 'B', 'O'])
        ];
    }
}
