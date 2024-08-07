<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Lecture;
use App\Models\Schedule;
use App\Models\Marks;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\LecturerAssignedNotification;
use App\Imports\MarkImport;
use Maatwebsite\Excel\Facades\Excel;

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
            'day' => 'required|array',
            'day.*' => 'required|string|max:255',
            'start_time' => 'required|array',
            'start_time.*' => 'required|date_format:H:i',
            'end_time' => 'required|array',
            'end_time.*' => 'required|date_format:H:i',
        ]);

        $lecture = Lecture::create([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description,
        ]);

        foreach ($request->day as $index => $day) {
            Schedule::create([
                'lecture_id' => $lecture->id,
                'day' => $day,
                'start_time' => $request->start_time[$index],
                'end_time' => $request->end_time[$index],
            ]);
        }


        return redirect()->back()->with('success','Lecture added successfully');

    }


    public function ShowAssignForm($id){

        $lecturers = Lecturer::all();
        $lectures = Lecture::findOrFail($id);
        return view('admin.admin-assignLecturer', compact('lecturers', 'lectures'));
    }


    public function AssignLecturer(Request $request){
        //dd($request);
        $validatedData = $request->validate([
            'lecture_id' => 'required|exists:lectures,id',
            'lecturer_id' => 'required|exists:lecturers,id',
        ]);
        $lecture = Lecture::find($request->lecture_id);
        $lecture->lecturers()->attach($request->lecturer_id);

        // $lecturer->notify(new LecturerAssignedNotification($lecture));

        return redirect()->back()->with('success', 'Lecturer assigned to lecture successfully.');
    }


    public function ViewLectureInfo($code){

        $lecture = Lecture::where('code', $code)->with('lecturers')->firstOrFail();
        return view('admin.admin-viewLectureInfo', compact('lecture'));
    }



    public function DeleteLecture($id){
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();

        return redirect()->back()->with('success', 'Lecture deleted successfully.');
    }



    public function AddMarks(){
        return view('admin.admin-addMarks');
    }


    public function ImportMarks(Request $request)
{

    $request->validate([
        'import_file' => 'required|file|mimes:xls,xlsx'
    ]);


    Excel::import(new MarkImport, $request->file('import_file'));

    // Retrieve all marks from the database
    // $marks = DB::table('marks')->get();

    // Return the view with the retrieved marks
     return view('admin.admin-addMarks')->with('success', 'File uploaded successfully');
    // return view('admin.admin-addMarks', ['marks' => $marks])->with('success', 'File Uploaded Successfully.');
}











}


