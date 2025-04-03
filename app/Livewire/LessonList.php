<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class LessonList extends Component
{
    public ?Course $course = null;
    public $lessons = [];

    public function mount($courseId)
    {
        $this->course = Course::with('lessons')->findOrFail($courseId);
        $this->lessons = $this->course->lessons;
    }

    public function render()
    {
        return view('livewire.lesson-list');
    }
}
