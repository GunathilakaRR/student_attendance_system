<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;


class LecturerController extends Controller
{


    public function codeGenerate(){

        $lecturer = Auth::user()->lecturer;
        $lectures = $lecturer->lectures;
        return view('lecturer.lecturer-code-generate', compact('lectures'));
    }


    public function otcGenerate(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:lectures,id',
    ]);

    $lecture = Lecture::findOrFail($request->course_id);
    $oneTimeCode = $lecture->code . Str::random(4);
    $expiration = now()->addSeconds(30);

    // Store the one-time code in cache with expiration
    Cache::put($oneTimeCode, $lecture->id, $expiration);

    return redirect()->back()->with([
        'success' => 'One-time code generated successfully.',
        'one_time_code' => $oneTimeCode,
        'expiration' => $expiration->timestamp,
    ]);
}


public function attendanceSummary($lectureId)
    {
        $lecture = Lecture::find($lectureId);
    $attendanceCount = $lecture->attendances()->count();
    return response()->json(['attendanceCount' => $attendanceCount]);
    }

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




    public function downloadSummary($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);
        $attendances = $lecture->attendances;

        $content = "Attendance Summary for " . $lecture->title . "\n\n";
        $content .= "Student Registration Number\tDate and Time\n";

        foreach ($attendances as $attendance) {
            $content .= $attendance->student->registration_number . "\t" . $attendance->created_at . "\n";
        }

        $fileName = 'attendance-summary-' . $lecture->id . '.txt';

        return Response::make($content, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ]);
    }



}
