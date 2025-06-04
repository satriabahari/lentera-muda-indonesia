<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()->id ?? 1, // Ambil course_id secara acak
            'title' => $this->faker->sentence(3),
            'status' => $this->faker->randomElement(['Draft', 'Published', 'Archived']),
            'is_active' => $this->faker->boolean(50),
        ];
    }
}
