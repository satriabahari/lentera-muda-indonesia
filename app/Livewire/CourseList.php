<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseList extends Component
{
    public $title = 'Satria Bahari';
    public function render()
    {
        return view('livewire.course-list')->with([
            'courses' => Course::all()
        ]);
    }

    public function viewDetail($id)
    {
        return redirect()->route("course.show", $id);
    }
}
