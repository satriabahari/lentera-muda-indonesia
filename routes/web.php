<?php

use App\Livewire\Counter;
use App\Livewire\CourseList;
use App\Livewire\CourseDetail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::get("/course", CourseList::class);

Route::get('course', CourseList::class);

Route::get('/course/{id}', CourseDetail::class)->name('course.show');

require __DIR__ . '/auth.php';
