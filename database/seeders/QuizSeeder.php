<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID course yang ada (pastikan sudah ada course dalam database)
        // $courseId = DB::table('courses')->first()->id ?? null;

        // if (!$courseId) {
        //     return;
        // }

        // // Buat daftar kuis
        // $quizzes = [
        //     [
        //         'title' => 'Kuis Matematika Dasar',
        //         'status' => 'Published',
        //         'course_id' => $courseId,
        //     ],
        //     [
        //         'title' => 'Kuis IPA',
        //         'status' => 'Draft',
        //         'course_id' => $courseId,
        //     ],
        // ];

        // foreach ($quizzes as $quizData) {
        //     $quiz = Quiz::create($quizData);

        //     // Tambahkan pertanyaan untuk setiap kuis
        //     $questions = [
        //         [
        //             'question' => 'Berapakah hasil dari 2 + 2?',
        //             'type' => 'multiple_choice',
        //             'quiz_id' => $quiz->id,
        //         ],
        //         [
        //             'question' => 'Apa nama planet terbesar di tata surya?',
        //             'type' => 'multiple_choice',
        //             'quiz_id' => $quiz->id,
        //         ],
        //     ];

        //     foreach ($questions as $questionData) {
        //         $question = Question::create($questionData);

        //         // Tambahkan jawaban untuk setiap pertanyaan
        //         $answers = [
        //             [
        //                 'answer' => '3',
        //                 'is_correct' => false,
        //                 'question_id' => $question->id,
        //             ],
        //             [
        //                 'answer' => '4',
        //                 'is_correct' => true,
        //                 'question_id' => $question->id,
        //             ],
        //             [
        //                 'answer' => 'Jupiter',
        //                 'is_correct' => true,
        //                 'question_id' => $question->id,
        //             ],
        //             [
        //                 'answer' => 'Mars',
        //                 'is_correct' => false,
        //                 'question_id' => $question->id,
        //             ],
        //         ];

        //         foreach ($answers as $answerData) {
        //             Answer::create($answerData);
        //         }
        //     }
        // }

        Quiz::factory(5)->create()->each(function ($quiz) {
            // Untuk setiap kuis, buat 5 pertanyaan
            Question::factory(5)->create(['quiz_id' => $quiz->id])->each(function ($question) {
                // Untuk setiap pertanyaan multiple choice, buat 4 jawaban
                if ($question->type === 'multiple_choice') {
                    Answer::factory(4)->create(['question_id' => $question->id]);
                }
            });
        });
    }
}
