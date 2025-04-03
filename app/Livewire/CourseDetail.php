<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class CourseDetail extends Component
{
    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course->load(['lessons', 'quizzes', 'reviews']);
    }


    public function render()
    {
        return view('livewire.course-detail', [
            'lessons' => $this->course->lessons,
            'quizzes' => $this->course->quizzes,
            'reviews' => $this->course->reviews,
        ]);
    }
}
