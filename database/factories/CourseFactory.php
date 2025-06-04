<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Course::class;

    protected function withFaker()
    {
        return \Faker\Factory::create('id_ID');
    }

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['mandiri', 'osis']),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            'image' => 'placeholder.png',
        ];
    }
}
