<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizDetail extends Component
{
    public Quiz $quiz; // 👈 Properti model yang bertipe Quiz
    public array $answers = []; // Untuk menyimpan jawaban user

    public function mount(Quiz $quiz)
    {
        // Pastikan model Quiz dimuat dengan relasi questions dan options
        $this->quiz = $quiz->load(['course', 'questions.answers']);
    }

    public function submit()
    {
        $user = Auth::user();

        foreach ($this->quiz->questions as $question) {
            if (!isset($this->answers[$question->id])) continue;

            UserAnswer::updateOrCreate(
                [
                    'user_id'     => $user->id,
                    'question_id' => $question->id,
                ],
                [
                    'answer_id' => $this->answers[$question->id],
                ]
            );
        }

        session()->flash('message', 'Quiz submitted successfully!');

        return redirect()->route('quiz.result', [
            'course' => $this->quiz->course->id,
            'quiz' => $this->quiz->id,
        ]);
    }

    public function render()
    {
        return view('livewire.quiz-detail', [
            'questions' => $this->quiz->questions,
        ]);
    }
}
