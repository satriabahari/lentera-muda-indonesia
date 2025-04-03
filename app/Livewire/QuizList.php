<?php

namespace App\Livewire;

use Livewire\Component;

class QuizList extends Component
{
    public $quizzes;

    public function mount($quizzes)
    {
        $this->quizzes = $quizzes;
    }

    public function render()
    {
        return view('livewire.quiz-list');
    }
}
