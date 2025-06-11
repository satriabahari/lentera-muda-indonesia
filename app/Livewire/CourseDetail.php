<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseCompletion;
use App\Models\Lesson;
use App\Models\StudentAnswer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Lentera Muda Indonesia')]
class CourseDetail extends Component
{
    public Course $course;

    public Collection $studentAnswers;

    public ?CourseCompletion $courseCompletion = null;

    public function hasCompletedAllQuizzes(): bool
    {
        $totalQuizzes = $this->course->quizzes->count();

        $answeredQuizIds = $this->studentAnswers
            ->pluck('quiz_id')
            ->unique()
            ->count();

        return $totalQuizzes > 0 && $answeredQuizIds === $totalQuizzes;
    }

    public function mount(Course $course)
    {
        $this->course = $course->load(['lessons', 'quizzes', 'certificate', 'courseCompletions']);

        // $this->studentAnswers = $course->studentAnswers ?? collect();

        $this->studentAnswers = StudentAnswer::whereHas('quiz', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })
            ->where('user_id', Auth::id()) // hanya ambil jawaban dari user saat ini
            ->get();

        $this->courseCompletion = $course->courseCompletions
            ->where('user_id', Auth::id())
            ->first();

        // dd("test");

        if ($this->hasCompletedAllQuizzes()) {

            $averageScore = $this->studentAnswers->avg('score') ?? 0;

            $this->courseCompletion = CourseCompletion::create([
                'course_id' => $course->id,
                'user_id' => Auth::id(),
                'score' => $averageScore,
                'is_completed' => true,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.course-detail', [
            'studentAnswers' => $this->studentAnswers,
            'lessons' => $this->course->lessons,
            'quizzes' => $this->course->quizzes,
            'certificate' => $this->course->certificate,
        ]);
    }
}
