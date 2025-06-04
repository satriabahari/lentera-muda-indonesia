<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        "student_type_id",
        "phone",
        "address",
        "school_name",
        "school_address"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentType()
    {
        return $this->belongsTo(StudentType::class);
    }
}
