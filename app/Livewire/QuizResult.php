<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizResult extends Component
{
    public Course $course;
    public Quiz $quiz;
    public $userAnswers;
    public int $score = 0;

    public function mount(Course $course, Quiz $quiz)
    {
        $this->course = $course;
        $this->quiz = $quiz;

        // Ambil jawaban user untuk quiz ini
        $this->userAnswers = UserAnswer::with(['question', 'answer'])
            ->where('user_id', Auth::id())
            ->whereIn('question_id', $quiz->questions->pluck('id'))
            ->get()
            ->groupBy('question_id');

        // Hitung skor dari jawaban yang benar
        $this->score = $this->userAnswers->flatten()
            ->filter(fn($ans) => $ans->answer?->is_correct)
            ->count();
    }

    public function render()
    {
        return view('livewire.quiz-result');
    }
}
