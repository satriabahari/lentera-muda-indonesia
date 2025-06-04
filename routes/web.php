<?php

use App\Livewire\Counter;
use App\Livewire\Student;
use App\Livewire\CourseList;
use App\Livewire\LessonList;
use App\Livewire\QuizDetail;
use App\Livewire\StudentList;
use App\Livewire\CourseDetail;
use App\Livewire\LessonDetail;
use App\Livewire\QuizResult;
use App\Livewire\StudentDetail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/courses', CourseList::class)->name('course');

// Route::get('/courses/{courseId}', CourseDetail::class)->name('course.show');

Route::get('/courses/{course}', CourseDetail::class)->name('course.show');

Route::get('/courses/{course}/lessons/{lesson}', LessonDetail::class)->name('lesson.show');

Route::get('/courses/{course}/quiz/{quiz}', QuizDetail::class)->name('quiz.show');

Route::get('/courses/{course}/quiz/{quiz}/result', QuizResult::class)->name('quiz.result');

Route::get('students', StudentList::class)->name('student');

Route::get('/students/{studentId}', StudentDetail::class)->name('student.show');

require __DIR__ . '/auth.php';
