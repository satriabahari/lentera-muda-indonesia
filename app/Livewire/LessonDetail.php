<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class LessonDetail extends Component
{
    // public $course;
    // public $lesson;

    // public function mount($courseId, $lessonId)
    // {
    //     $this->course = Course::findOrFail($courseId);
    //     $this->lesson = Lesson::where('course_id', $courseId)->findOrFail($lessonId);
    // }
    public $courseId;
    public $lessonId;
    public $lesson;
    public $previousLesson;
    public $nextLesson;

    public function mount($course, $lesson)
    {
        $this->courseId = $course;
        $this->lessonId = $lesson;

        $this->loadLesson();
    }

    public function loadLesson()
    {
        $this->lesson = Lesson::where('course_id', $this->courseId)->where("is_active", true)->findOrFail($this->lessonId);

        $lessons = Lesson::where('course_id', $this->courseId)->where("is_active", true)->orderBy('id')->get();
        $currentIndex = $lessons->search(fn($item) => $item->id == $this->lesson->id);

        $this->previousLesson = $currentIndex > 0 ? $lessons[$currentIndex - 1] : null;
        $this->nextLesson = $currentIndex < $lessons->count() - 1 ? $lessons[$currentIndex + 1] : null;
    }

    public function goToPrevious()
    {
        if ($this->previousLesson) {
            return redirect()->route('lesson.show', ['course' => $this->courseId, 'lesson' => $this->previousLesson->id]);
        }
    }

    public function goToNext()
    {
        if ($this->nextLesson) {
            return redirect()->route('lesson.show', ['course' => $this->courseId, 'lesson' => $this->nextLesson->id]);
        }
    }

    public function render()
    {
        return view('livewire.lesson-detail');
    }
}
