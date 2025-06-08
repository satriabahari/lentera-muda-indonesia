<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Livewire\CourseList;
use App\Livewire\CourseDetail;
use App\Livewire\LessonDetail;
use App\Livewire\QuizDetail;
use App\Livewire\QuizResult;

// =====================
// Dashboard & Profile
// =====================

Route::view('/', 'home')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// =====================
// Courses
// =====================

Route::get('/courses', CourseList::class)
    ->middleware(['auth', 'verified'])
    ->name('course');

Route::get('/courses/{course}', CourseDetail::class)
    ->middleware(['auth', 'verified'])
    ->name('course.show');

Route::get('/courses/{course}/lessons/{lesson}', LessonDetail::class)
    ->middleware(['auth', 'verified'])
    ->name('lesson.show');

Route::get('/courses/{course}/quiz/{quiz}', QuizDetail::class)
    ->middleware(['auth', 'verified'])
    ->name('quiz.show');

Route::get('/courses/{course}/quizzes/{quiz}/result', QuizResult::class)
    ->middleware(['auth', 'verified'])
    ->name('quiz.result');

// =====================
// Certificate Download
// =====================

Route::get('/certificate/download/{filename}', function ($filename) {
    /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
    $disk = Storage::disk('public');

    $path = 'certificates/' . $filename;

    if (!$disk->exists($path)) {
        abort(404);
    }

    return $disk->download($path);
})->name('certificate.download');

// =====================
// Auth Routes
// =====================

require __DIR__ . '/auth.php';
