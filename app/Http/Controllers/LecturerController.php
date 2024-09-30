<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Lecture;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LecturerController extends Controller
{


    public function codeGenerate(){

        $lecturer = Auth::user()->lecturer;
        $lectures = $lecturer->lectures;
        return view('lecturer.lecturer-code-generate', compact('lectures'));
    }




    public function otcGenerate(Request $request)
{
    // Validate that course_id is required and exists in the lectures table
    $request->validate([
        'course_id' => 'required|exists:lectures,id',
    ]);

    $lecture = Lecture::findOrFail($request->course_id);
    $oneTimeCode = $lecture->code .'-'. Str::random(4);
    $expiration = now()->addSeconds(30);

    // Store the one-time code in cache with expiration
    Cache::put($oneTimeCode, $lecture->id, $expiration);

    return redirect()->back()->with([
        'success' => 'One-time code generated successfully.',
        'one_time_code' => $oneTimeCode,
        'expiration' => $expiration->timestamp,
        'selected_lecture' => $request->course_id,
    ]);
}




public function attendanceSummary($lectureId)
{
    $lecture = Lecture::find($lectureId);
    $currentDate = now()->format('Y-m-d');

    // Fetch the list of students who marked attendance
    $attendances = $lecture->attendances()
        ->whereDate('created_at', $currentDate)
        ->get();

    // Extract student names
    $students = $attendances->map(function($attendance) {
        return [
            'name' => $attendance->student->name1,
            'registration_number' => $attendance->student->registration_number,
        ];
    });

    $attendanceCount = $attendances->count();

    return response()->json([
        'attendanceCount' => $attendanceCount,
        'students' => $students,
    ]);
}


// LecturerController.php
public function videoCall()
{
    return view('lecturer.lecturerVideocall');
}


// public function attendanceSummary($lectureId)
//     {
//         $lecture = Lecture::find($lectureId);
//     $currentDate = now()->format('Y-m-d');
//     $attendanceCount = $lecture->attendances()
//         ->whereDate('created_at', $currentDate)
//         ->count();
//     return response()->json(['attendanceCount' => $attendanceCount]);


//     }

    // public function otcGenerate(Request $request){


    //     $request->validate([
    //         'course_id' => 'required|exists:lectures,id',
    //     ]);

    //     $lecture = Lecture::findOrFail($request->course_id);

    //     $oneTimeCode = $lecture->code . Str::random(4);
    //     $expiration = now()->addSeconds(30)->timestamp;;


    //     return redirect()->back()->with([
    //         'success' => 'One-time code generated successfully.',
    //         'one_time_code' => $oneTimeCode,
    //         'expiration' => $expiration,
    //     ]);


    // }


    public function LecturerProfileUpdate($id){

        $lecturers = Lecturer::find($id);
        return view('lecturer.lecturer-update', compact('lecturers'));
    }



    public function UpdateProfile(Request $request, $id){
        //dd($request);

        $validatedData = $request->validate([
            'name1' => 'required|string|max:255',
            'name2' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_pic'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lecturer = Lecturer::find($id);

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $validatedData['image'] = $path;
        }

        $lecturer->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function ViewAssignedlectures($id){

        $lecturer = Lecturer::with('lectures.schedules')->findOrFail($id);
        return view('lecturer.lecturer-viewAssigned-lectures', compact('lecturer'));
    }



    public function attendanceTrends($id)
    {
        $lectures = DB::table('lectures')
        ->join('lecture_lecturer', 'lectures.id', '=', 'lecture_lecturer.lecture_id')
        ->where('lecture_lecturer.lecturer_id', $id)
        ->select('lectures.id', 'lectures.title')
        ->get();

    $lectureData = [];

    foreach ($lectures as $lecture) {
        $attendanceRecords = Attendance::select('marked_at as date', 'attendance_count')
                                       ->where('lecture_id', $lecture->id)
                                       ->orderBy('marked_at', 'asc')
                                       ->get();

        $lectureData[] = [
            'lectureName' => $lecture->lecture_name,
            'dates' => $attendanceRecords->pluck('date')->toArray(),
            'attendanceCounts' => $attendanceRecords->pluck('attendance_count')->toArray(),
        ];
    }

    return view('dashboard.attendance', ['lectureData' => $lectureData]);
    }


    public function downloadSummary($lectureId)
{
    // Load the lecture with the attendances for today only
    $today = Carbon::today(); // Get today's date
    $lecture = Lecture::with(['attendances' => function ($query) use ($today) {
        $query->whereDate('created_at', $today); // Filter attendances for the current day
    }, 'attendances.student'])->findOrFail($lectureId);

    // Check if there are any attendances for today
    if ($lecture->attendances->isEmpty()) {
        return back()->with('error', 'No attendance records found for today.');
    }

    // Create the content for the summary file
    $content = "Attendance Summary for " . $lecture->title . " (Date: " . $today->toDateString() . ")\n\n";
    $content .= "Student Registration Number\tDate and Time\n";

    foreach ($lecture->attendances as $attendance) {
        if ($attendance->student) {
            $content .= $attendance->student->registration_number . "\t" . $attendance->created_at->format('Y-m-d H:i:s') . "\n";
        }
    }

    $fileName = 'attendance-summary-' . $lecture->id . '-'. $today->format('Y-m-d') .'.txt';

    // Return the response for download
    return Response::make($content, 200, [
        'Content-Type' => 'text/plain',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
    ]);
}


    // public function downloadSummary($lectureId)
    // {


    //     $lecture = Lecture::findOrFail($lectureId);
    //     $attendances = $lecture->attendances;

    //     $content = "Attendance Summary for " . $lecture->title . "\n\n";
    //     $content .= "Student Registration Number\tDate and Time\n";

    //     foreach ($attendances as $attendance) {
    //         $content .= $attendance->student->registration_number . "\t" . $attendance->created_at . "\n";
    //     }

    //     $fileName = 'attendance-summary-' . $lecture->id . '.txt';

    //     return Response::make($content, 200, [
    //         'Content-Type' => 'text/plain',
    //         'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
    //     ]);
    // }



}
