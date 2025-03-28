<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        $users = User::all();

        foreach ($courses as $course) {
            foreach ($users->random(3) as $user) { // Setiap course punya 3 review random
                Review::factory()->create([
                    'course_id' => $course->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        // Review::unguard();

        // Review::create([
        //     'course_id' => 1,
        //     'user_id' => 1, // Sesuaikan dengan ID user yang ada di database
        //     'rating' => 5,
        //     'comment' => 'Kursusnya sangat membantu, recommended!',
        // ]);

        // Review::create([
        //     'course_id' => 2,
        //     'user_id' => 2,
        //     'rating' => 4,
        //     'comment' => 'Materi cukup bagus, tapi perlu lebih banyak contoh kode.',
        // ]);
    }
}
