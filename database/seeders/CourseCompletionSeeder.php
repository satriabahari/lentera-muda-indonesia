<?php

namespace Database\Seeders;

use App\Models\CourseCompletion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCompletionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(3, 5) as $userId) {
            foreach (range(1, 3) as $courseId) {
                CourseCompletion::create([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    // 'score' => rand(70, 100),
                    'score' => null,
                    'is_completed' => false,
                ]);
            }
        }
    }
}
