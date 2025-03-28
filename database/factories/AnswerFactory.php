<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_id' => Question::inRandomOrder()->first()->id ?? 1, // Ambil question_id secara acak
            'answer' => $this->faker->sentence(5),
            'is_correct' => $this->faker->boolean(20), // 20% kemungkinan jawaban benar
        ];
    }
}
