<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\Course;
use Livewire\Component;

class QuizDetail extends Component
{
    public Course $course;
    public Quiz $quiz;

    public function mount(Course $course, Quiz $quiz)
    {
        if ($quiz->course_id !== $course->id) {
            abort(404);
        }

        $this->course = $course;
        $this->quiz = $quiz->load('questions');
    }

    public function render()
    {
        return view('livewire.quiz-detail', [
            'questions' => $this->quiz->questions,
        ]);
    }
}
