<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'student_id',
        'registration_number',
        'subject1_marks',
        'subject2_marks',
        'subject3_marks',
        'subject4_marks',
        'subject5_marks',
    ];

    // public function student()
    // {
    //     return $this->belongsTo(Student::class, 'registration_number', 'registration_number');
    // }
}
