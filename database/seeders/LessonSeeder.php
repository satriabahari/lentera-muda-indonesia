<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::unguard();

        Lesson::create([
            'course_id' => 1, 
            'title' => 'Pengenalan Laravel',
            'content' => 'Belajar tentang dasar-dasar Laravel dan frameworknya.',
        ]);

        Lesson::create([
            'course_id' => 2,
            'title' => 'State Management di React',
            'content' => 'Memahami useState dan useEffect di ReactJS.',
        ]);
    }
}
