<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name1',
        'name2',
        'email',
        'password',
        'registration_number',
        'surname',
        'city',
        'phone_number',
        'image',
        // Add other student details here
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lectures(){
        return $this->belongsToMany(Lecture::class,'lecture_student');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
