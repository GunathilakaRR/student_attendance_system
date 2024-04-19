<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewStudents(){
        $students = Student::all();

        // Pass $students to your view
        return view('admin.view-students', ['students' => $students]);
    }

}
