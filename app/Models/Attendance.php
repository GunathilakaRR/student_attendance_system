<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'lecture_id',
        'marked_at',
    ];


    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}

