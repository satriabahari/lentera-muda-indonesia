<?php

namespace App\Livewire;

use App\Models\Course;
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

    public function mount(Course $course)
    {
        $this->course = $course->load(['lessons', 'quizzes', 'certificate']);

        // $this->studentAnswers = $course->studentAnswers ?? collect();

        $this->studentAnswers = StudentAnswer::whereHas('quiz', function ($query) use ($course) {
            $query->where('course_id', $course->id);
        })
            ->where('user_id', Auth::id()) // hanya ambil jawaban dari user saat ini
            ->get();

        // $this->studentAnswers = StudentAnswer::whereHas('quiz', function ($query) use ($course) {
        //     $query->where('course_id', $course->id);
        // })->get();
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
