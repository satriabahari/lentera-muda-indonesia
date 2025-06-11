<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'student_type_id',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($course) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
        });
    }

    public function studentType()
    {
        return $this->belongsTo(StudentType::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function quizzes()
    {
        return $this->hasMany(quiz::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    public function courseCompletions()
    {
        return $this->hasMany(CourseCompletion::class);
    }
}
