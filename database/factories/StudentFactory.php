<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role_id' => 4,
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'school_name' => $this->faker->company(),
            'school_address' => $this->faker->address(),
        ];
    }
}
