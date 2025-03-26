<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
