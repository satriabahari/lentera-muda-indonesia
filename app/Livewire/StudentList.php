<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentList extends Component
{
    public function render()
    {
        return view('livewire.student-list')->with([
            'students' => Student::all()
        ]);
    }

    public function viewDetail($id)
    {
        return redirect()->route("student.show", $id);
    }
}
