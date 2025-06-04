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

    public function certificates()
    {
        return $this->hasOne(Certificate::class);
    }

    public function studentType()
    {
        return $this->belongsTo(StudentType::class);
    }

    public function courseCompletion()
    {
        return $this->hasMany(CourseCompletion::class);
    }
}
