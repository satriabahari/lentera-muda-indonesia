<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(), // Buat course baru atau ambil yang ada
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(),
            'video_url' => $this->faker->url(),
            'is_active' => $this->faker->boolean(50),
        ];
    }
}
