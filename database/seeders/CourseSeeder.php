<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Arr;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentTypeIds = [1, 2]; // Pastikan data ini tersedia di tabel student_types

        for ($i = 1; $i <= 3; $i++) {
            // Buat Course
            $course = Course::create([
                'title' => "Mastering Skill Level $i",
                'description' => "This comprehensive course is tailored to help learners at Level $i build a strong foundation in both theoretical knowledge and practical applications.
                Across a structured set of lessons, you will explore core principles, frameworks, and case studies that reflect real-world challenges in various domains.
                Each module is carefully crafted to reinforce your understanding through a blend of multimedia materials, guided tutorials, and hands-on projects.
                Additionally, the course emphasizes collaborative learning through discussion forums, peer reviews, and instructor feedback.
                By the end of this course, you will be equipped with the skills necessary to progress confidently to the next level or apply what you've learned directly in your work or studies.
                Whether you're pursuing academic excellence or professional growth, this course will serve as a vital stepping stone on your journey.",
                'image' => "placeholder.png",
                'student_type_id' => Arr::random($studentTypeIds),
            ]);

            // Tambahkan Certificate
            Certificate::create([
                'course_id' => $course->id,
                'name' => "Completion Certificate for Level $i",
                'image' => "certificate_level_$i.png",
            ]);

            // Tambahkan Lessons
            for ($j = 1; $j <= 3; $j++) {
                Lesson::create([
                    'course_id' => $course->id,
                    'title' => "Lesson $j: Deep Dive into Key Concepts",
                    'content' => "In this lesson, we take an in-depth look at part $j of the core competencies for Skill Level $i. You'll begin by understanding the historical and theoretical background of the topic,
                    including its evolution and relevance in today’s digital and globalized world. From there, we move into detailed explanations of major frameworks, models, and practical tools used in the field.
                    Real-world case studies and examples will help bridge theory with application, showing how these ideas are implemented across industries and sectors.
                    The lesson includes multiple checkpoints for reflection, interactive exercises, and opportunities to apply your knowledge to simulated environments.
                    Additionally, you'll gain insight from expert interviews and curated reading materials that go beyond the core textbook.
                    By the end of this lesson, you should be able to critically evaluate, apply, and communicate the main ideas with confidence.",
                    'video_url' => "https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4",
                    'is_active' => true,
                ]);
            }

            // Tambahkan Quiz dan Questions
            for ($k = 1; $k <= 3; $k++) {
                $quiz = Quiz::create([
                    'course_id' => $course->id,
                    'title' => "Quiz $k: Comprehensive Assessment for Level $i",
                    'is_active' => true,
                ]);

                Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => "Which of the following statements best reflects the key principle discussed in Lesson $k of Level $i? Consider both theoretical aspects and real-world implications in your answer.",
                    'is_active' => true,
                ]);
            }
        }
    }
}
