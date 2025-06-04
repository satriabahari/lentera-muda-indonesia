<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Arr;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Course::factory()->count(10)->create();

        $studentTypeIds = [1, 2];

        for ($i = 1; $i <= 3; $i++) {
            $course = Course::create([
                'title' => "Course $i",
                'description' => "Description for course $i",
                'image' => "/images/placeholder.png",
                'student_type_id' => Arr::random($studentTypeIds),
            ]);

            // 3 Certificate
            Certificate::create([
                'course_id' => $course->id,
                'name' => "Certificate for Course $i",
                'image' => "/images/placeholder.png",
            ]);

            // Buat 3 Lesson untuk setiap Course
            for ($j = 1; $j <= 3; $j++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => "Lesson $j for Course $i",
                    'content' => "Content of lesson $j",
                    'video_url' => "https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4",
                    'is_active' => true,
                ]);
            }

            // Buat 3 Quiz untuk setiap Course
            for ($k = 1; $k <= 3; $k++) {
                $quiz = Quiz::create([
                    'course_id' => $course->id,
                    'title' => "Quiz $k for Course $i",
                    'is_active' => true,
                ]);

                // Buat 1 Question untuk setiap Quiz
                Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => "What is the answer to question $k for Course $i?",
                    'is_active' => true,
                ]);
            }
        }
    }
}
