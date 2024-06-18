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
    ];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,'lecture_student');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
