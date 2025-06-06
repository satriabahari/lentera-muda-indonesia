<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuizResult extends Component
{
    public Course $course;
    public Quiz $quiz;
    public int $score = 0;

    public function mount(Course $course, Quiz $quiz)
    {
        $this->course = $course;
        $this->quiz = $quiz->load("question");
    }

    public function render()
    {
        $studentAnswer = StudentAnswer::with('question')
            ->where('user_id', Auth::id())
            ->where('course_id', $this->course->id)
            ->where('quiz_id', $this->quiz->id)
            ->whereIn('question_id', $this->quiz->question->pluck('id'))
            ->get()
            ->groupBy('question_id');

        return view('livewire.quiz-result', [
            'course' => $this->course,
            'quiz' => $this->quiz,
            'studentAnswer' => $studentAnswer,
            'score' => $this->score,
        ]);
    }
}
