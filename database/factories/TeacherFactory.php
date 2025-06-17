<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        $user = User::factory()->create([
            'role' => 'teacher',
        ]);

        return [
            'user_id' => $user->id,
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'code' => $this->generateUniqueCode(),
            'name' => $this->faker->name,
            'phone' => $this->faker->unique()->numerify("08##########"),
            'address' => $this->faker->address,
            'bloodType' => $this->faker->randomElement(['A', "B", 'AB', 'O']),
            'gender' => $this->faker->randomElement(['Pria', "Wanita"]),
        ];
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = $this->faker->regexify('[A-Z]{3}');
        } while (Teacher::where('code', $code)->exists());
        return $code;
    }
}
