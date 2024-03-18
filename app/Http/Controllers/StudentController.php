<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{

    public function CvBilder(){

        $users = User::all();
        return view('student.student-builder', ['users' => $users]);
    }


}
