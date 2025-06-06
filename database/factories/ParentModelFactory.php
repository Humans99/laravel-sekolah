<?php

namespace Database\Factories;

use App\Models\ParentModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentModelFactory extends Factory
{
    protected $model = ParentModel::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => 'parent'])->id,
            'name' => $this->faker->name,
            'phone' => $this->faker->unique()->numerify("08##-####-####"),
            'address' => $this->faker->address
        ];
    }
}
