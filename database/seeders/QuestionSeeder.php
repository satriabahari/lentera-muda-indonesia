<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::factory()
            ->count(10)
            ->create()
            ->each(function ($question) {
                // Tambahkan 4 jawaban per pertanyaan
                Answer::factory()
                    ->count(4)
                    ->create(['question_id' => $question->id]);
            });
    }
}
