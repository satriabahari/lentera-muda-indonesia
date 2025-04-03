<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentDetail extends Component
{
    public function render()
    {
        return view('livewire.student-detail');
    }

    public $student;

    public function mount($id)
    {
        $this->student = Student::findOrFail($id);
    }
}
