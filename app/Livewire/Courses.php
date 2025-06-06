<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class Courses extends Component
{
    public function render()
    {
        return view('livewire.courses', [
            'courses' => Course::all()
        ]);
    }
}
