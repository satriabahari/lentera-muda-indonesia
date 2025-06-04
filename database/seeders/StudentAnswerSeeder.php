<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            foreach ([3, 4, 5] as $userId) {
                StudentAnswer::create([
                    'question_id' => $question->id,
                    'user_id' => $userId,
                    'answer_text' => "Jawaban user $userId untuk pertanyaan {$question->id}",
                    'score' => rand(1, 10),
                ]);
            }
        }
    }
}
