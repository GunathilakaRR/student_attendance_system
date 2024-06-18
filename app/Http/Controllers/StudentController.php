<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecture;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function CvBilder(){

        $users = User::all();
        return view('student.student-builder', ['users' => $users]);
    }

    public function StudentAttendance(){
        return view('student.student-attendance');
    }



    public function AttendanceMark(Request $request)
    {
        $request->validate([
            'one_time_code' => 'required|string',
        ]);

        // Retrieve lecture ID from the cache
        $lectureId = Cache::get($request->one_time_code);

        if (!$lectureId) {
            return redirect()->back()->withErrors(['error' => 'Invalid or expired one-time code.']);
        }

        // Assuming you have a way to get the currently logged-in student
        $studentId = auth()->user()->student->id;

        // Check if the student has already marked attendance for this lecture
        $attendanceExists = Attendance::where('student_id', $studentId)
                                      ->where('lecture_id', $lectureId)
                                      ->exists();

        if ($attendanceExists) {
            return redirect()->back()->withErrors(['error' => 'You have already marked your attendance for this lecture.']);
        }

        Attendance::create([
            'student_id' => $studentId,
            'lecture_id' => $lectureId,
            'marked_at' => now(),
        ]);
        // Do not forget the one-time code so other students can use it
        // Cache::forget($request->one_time_code); // Comment this line out or remove it
        return redirect()->back()->with('success', 'Attendance marked successfully.');
    }

// ------------------------------------------------------------------------------------------------


    // public function AttendanceMark(Request $request)
    // {
    //     //dd($request);
    //     $request->validate([
    //         'one_time_code' => 'required|string',
    //     ]);

    //     $lectureId = Cache::get($request->one_time_code);

    //     if (!$lectureId) {
    //         return redirect()->back()->withErrors(['error' => 'Invalid or expired one-time code.']);
    //     }

    //     // Assuming you have a way to get the currently logged-in student
    //     $studentId = auth()->user()->student->id;

    //     // Mark attendance for the student
    //     // Attendance::create([
    //     //     'student_id' => $studentId,
    //     //     'lecture_id' => $lectureId,
    //     //     'marked_at' => now(),
    //     // ]);

    //     // Remove the one-time code from cache after usage
    //     Cache::forget($request->one_time_code);

    //     return redirect()->back()->with('success', 'Attendance marked successfully.');
    // }



    public function StudentProfileUpdate( $id){
        $students = Student::find($id);
    return view('student.student-update', compact('students'));
    }



    public function Student_Profile_Update(Request $request, $id){

        $validatedData = $request->validate([
            'name1' => 'required|string|max:255',
            'name2' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'student_registration_number' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'profile_pic'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = Student::find($id);
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $validatedData['image'] = $path;
        }
        $student->update($validatedData);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function RegisterForCourses(){
        $lectures = Lecture::all();
        // $students = Student::all();
        return view('student.student-registerCourses', compact('lectures'));
    }


    public function Register(Request $request){
        $request->validate([
            'lectures' => 'required|array',
            'lectures.*' => 'exists:lectures,id',
        ]);
        $user = Auth::user();
        if (!$user->student) {
            return redirect()->back()->with('error', 'You are not registered as a student.');
        }
        $user->student->lectures()->sync($request->lectures);
        return redirect()->back()->with('success', 'Registration successful.');
    }


    // public function UpdateProfile(Request $request, $id){

    //     dd($request);

    //     $validatedData = $request->validate([
    //         'name1' => 'required|string|max:255',
    //         'name2' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'student_registration_number' => 'required|string|max:255',
    //         'phone_number' => 'nullable|string|max:20',
    //         'profile_pic'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

    //     ]);

    //     $student = Student::find($id);

    //     if ($request->hasFile('profile_pic')) {

    //         $file = $request->file('profile_pic');

    //         $filename = time() . '.' . $file->getClientOriginalExtension();

    //         $path = $file->storeAs('profile_pictures', $filename, 'public');

    //         $validatedData['image'] = $path;
    //     }


    //     $student->update($validatedData);

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }

}
