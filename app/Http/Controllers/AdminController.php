<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewStudents(){
        $students = Student::all();

        // Pass $students to your view
        return view('admin.view-students', ['students' => $students]);

        
    }


    public function viewlecturers(){
        $lecturers = Lecturer::all();

        return view('admin.view-lecturers', ['lecturers' => $lecturers]);
    }

    public function adminViewStudent($id){

        $students = Student::find($id);

        return view('admin.admin-viewStudent', compact('students'));
    }

    public function adminViewLecturer($id){

        $lecturers = Lecturer::find($id);

        return view('admin.admin-viewLecturers', compact('lecturers'));

    }

    public function selectYear(){

    }

}
