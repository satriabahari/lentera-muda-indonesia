<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class LessonDetail extends Component
{
    public $course;
    public $lesson;

    public function mount($courseId, $lessonId)
    {
        $this->course = Course::findOrFail($courseId);
        $this->lesson = Lesson::where('course_id', $courseId)->findOrFail($lessonId);
    }

    public function render()
    {
        return view('livewire.lesson-detail');
    }
}
