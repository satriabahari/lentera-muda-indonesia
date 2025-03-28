<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()->count(10)->create();

        // Course::unguard();

        // Course::create([
        //     'title' => 'Kursus Laravel Dasar',
        //     'description' => 'Belajar Laravel dari dasar hingga mahir.',
        //     'category' => 'mandiri',
        //     'status' => 'Published',
        //     'image' => 'course-images/laravel.jpg',
        // ]);

        // Course::create([
        //     'title' => 'Kursus ReactJS',
        //     'description' => 'Membangun aplikasi web modern dengan React.',
        //     'category' => 'osis',
        //     'status' => 'Draft',
        //     'image' => 'course-images/react.jpg',
        // ]);
    }
}
