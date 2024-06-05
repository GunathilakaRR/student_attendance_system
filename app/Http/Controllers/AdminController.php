<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Lecture;
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
        $lectures = Lecture::with('lecturers')->get();

        return view('admin.admin-viewLecturers', compact('lecturers', 'lectures'));

    }

    public function viewLectures(){
        // $lectures = Lecture::all();
        // return view('admin.admin-viewLectures',  ['lectures' => $lectures]);
        $lectures = Lecture::with('lecturers')->get();
        return view('admin.admin-viewLectures', compact('lectures'));
    }

    public function addNewLecture(){
        return view('admin.admin-addNewLecture');
    }


    public function AddLecture(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string|max:50',
        ]);

        Lecture::create($validatedData);
        return redirect()->back()->with('success','Lecture added successfully');
    }


    public function ShowAssignForm(){

        $lecturers = Lecturer::all();
        $lectures = Lecture::all();
        return view('admin.admin-assignLecturer', compact('lecturers', 'lectures'));

    }


    public function AssignLecturer(Request $request){

        $validatedData = $request->validate([
            'lecture_id' => 'required|exists:lectures,id',
            'lecturer_id' => 'required|exists:lecturers,id',
        ]);

        $lecture = Lecture::find($request->lecture_id);
        $lecture->lecturers()->attach($request->lecturer_id);

        return redirect()->back()->with('success', 'Lecturer assigned to lecture successfully.');

    }



    public function selectYear(){

    }

}
