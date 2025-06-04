<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Question::class;
    public function definition(): array
    {
        return [
            'quiz_id' => Quiz::inRandomOrder()->first()->id ?? 1, // Ambil quiz_id secara acak
            'question' => $this->faker->sentence(10),
        ];
    }
}
