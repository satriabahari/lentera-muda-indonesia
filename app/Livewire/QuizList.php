<?php

namespace App\Livewire;

use Livewire\Component;

class QuizList extends Component
{
    public $quizzes;

    public $studentAnswers;

    public function mount($quizzes, $studentAnswers)
    {
        $this->quizzes = $quizzes;
        $this->studentAnswers = $studentAnswers;
    }

    public function render()
    {
        return view('livewire.quiz-list');
    }
}
