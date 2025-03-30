<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseDetail extends Component
{
    public function render()
    {
        return view('livewire.course-detail');
    }
    public $course;

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);
    }
}
