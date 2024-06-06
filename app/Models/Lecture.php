<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable=[
    'code',
    'title',
    'description',
    'credits',
    'start_time',
    'end_time',
    ];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
