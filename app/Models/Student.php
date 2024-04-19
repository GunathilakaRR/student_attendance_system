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
        // Add other student details here
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
