<?php

namespace App\Livewire;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Courses extends Component
{
    public function render()
    {
        $user = Auth::user();
        $studentTypeId = $user->studentProfile->student_type_id ?? null;
        $studentRoleId = $user->role_id;

        if (!$studentTypeId && !in_array($studentRoleId, [1, 2])) {
            return view('livewire.courses', [
                'courses' => collect(),
            ]);
        }

        if (in_array($studentRoleId, [1, 2])) {
            $courses = Course::where('is_active', true)
                ->with('studentType')
                ->get();
        } else {
            $courses = Course::where('student_type_id', $studentTypeId)
                ->where('is_active', true)
                ->with('studentType')
                ->get();
        }

        return view('livewire.courses', [
            'courses' => $courses,
        ]);
    }
}
