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
        'category',
        'status',
    ];

    protected $casts = [
        'category' => 'string',
    ];

    public static function categories(): array
    {
        return [
            'mandiri' => 'Mandiri',
            'osis' => 'OSIS',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($course) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
        });
    }
}
