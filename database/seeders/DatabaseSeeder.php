<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StudentTypeSeeder::class,
            UserSeeder::class,
            StudentProfileSeeder::class,
            CourseSeeder::class,
            CourseCompletionSeeder::class,
            StudentAnswerSeeder::class,

            // RoleSeeder::class,
            // UserSeeder::class,
            // StudentSeeder::class,
            // LessonSeeder::class,
            // ReviewSeeder::class,
            // QuizSeeder::class,
            // QuestionSeeder::class,
            // CertificateSeeder::class,
            // UserAnswerSeeder::class,
        ]);
    }
}
