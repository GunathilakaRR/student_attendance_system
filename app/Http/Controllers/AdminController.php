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
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{

    public function viewStudents(){
        // $students = Student::all();

        $students = Student::paginate(5);
        return view('admin.view-students', ['students' => $students]);
    }


    public function viewlecturers(){
        // $lecturers = Lecturer::all();

        $lecturers = Lecturer::paginate(5);
        return view('admin.view-lecturers', ['lecturers' => $lecturers]);
    }


    public function adminViewStudent($id){

        $students = Student::find($id);

        $attendanceRecords = DB::table('attendances')
        ->join('lectures', 'attendances.lecture_id', '=', 'lectures.id')
        ->select('lectures.title as lecture_name', 'attendances.created_at as date')
        ->where('attendances.student_id', $id)
        ->orderBy('attendances.created_at')
        ->get();

        // Prepare data for pie chart
    $attendanceCounts = [];
    foreach ($attendanceRecords as $record) {
        $attendanceCounts[$record->lecture_name]['attended'] = ($attendanceCounts[$record->lecture_name]['attended'] ?? 0) + 1;
    }

    // Assuming you have a total of 30 sessions for each lecture
    foreach ($attendanceCounts as $lecture => $counts) {
        $attendanceCounts[$lecture]['missed'] = 30 - ($counts['attended'] ?? 0); // Assuming 30 sessions
    }

        return view('admin.admin-viewStudent', compact('students', 'attendanceCounts'));
    }


    public function adminViewLecturer($id){

        $lecturers = Lecturer::find($id);
        $lectures = Lecture::with('lecturers')->get();

        return view('admin.admin-viewLecturers', compact('lecturers', 'lectures'));

    }

    public function viewLectures(){

        // $lectures = Lecture::with('lecturers')->get();
        $lectures = Lecture::with('lecturers')->paginate(5);
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

        $lecture = Lecture::where('code', $code)->with(['lecturers', 'schedules'])->firstOrFail();
        //dd($lecture);
        return view('admin.admin-viewLectureInfo', compact('lecture'));
    }



    public function DeleteLecture($id){
        $lecture = Lecture::findOrFail($id);
        $lecture->delete();

        return redirect()->back()->with('success', 'Lecture deleted successfully.');
    }



    public function AddMarks(){
         $marks = Marks::all();
        // $marks = Marks::paginate(5);

        if ($marks->isEmpty()) {
            dd('No marks found');
        }

        return view('admin.admin-addMarks', compact('marks'));
    }




    public function ImportMarks(Request $request){

    $request->validate([
        'import_file' => 'required|file|mimes:xls,xlsx'
    ]);

    Excel::import(new MarkImport, $request->file('import_file'));

    $marks = Marks::all();

    // Flash the success message to the session
    session()->flash('success', 'File uploaded successfully');

    // Return the view with the marks and success message
    return view('admin.admin-addMarks', compact('marks'));

    // if ($marks->isEmpty()) {
    //     dd('No marks found after import');
    // }

    //  return view('admin.admin-addMarks', compact('marks'))->with('success', 'File uploaded successfully');
}











}


