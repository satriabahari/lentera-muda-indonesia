<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Lentera Muda Indonesia')]
class QuizDetail extends Component
{
    public Quiz $quiz;
    public array $answers = [];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load(['course', 'question']);
    }

    public function submit()
    {
        $user = Auth::user();
        $question = $this->quiz->question;

        $studentAnswer = StudentAnswer::updateOrCreate(
            [
                'user_id'     => $user->id,
                'course_id'   => $this->quiz->course_id,
                'quiz_id'     => $this->quiz->id,
                'question_id' => $question->id,
            ],
            [
                'answer_text' => $this->answers[$question->id],
                'score' => null,
            ]
        );

        return redirect()->route('course.show', [
            'course' => $this->quiz->course_id,
            'studentAnswer' => $studentAnswer,
        ]);

        // return redirect()->route('course.show', [
        //     'course' => $this->quiz->course_id,
        //     'quiz'   => $this->quiz->id,
        // ]);
        // return redirect()->route('quiz.result', [
        //     'course' => $this->quiz->course_id,
        //     'quiz'   => $this->quiz->id,
        // ]);
    }

    public function render()
    {
        return view('livewire.quiz-detail', [
            'question' => $this->quiz->question,
            'studentAnswer' => $this->quiz->studentAnswer()->where('user_id', Auth::id())->first(),
        ]);
    }
}
