<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
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
        // Add other lecturer details here
    ];

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }

    public function courseCodes()
    {
        return $this->hasMany(CourseCode::class);
    }

}
