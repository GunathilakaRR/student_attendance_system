<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;

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
        // dd($request);
        $request->validate([
            'entered_code' => 'required|string',
        ]);

        // Retrieve one-time code from session
        $oneTimeCode = $request->session()->get('one_time_code');

        if ($oneTimeCode && $oneTimeCode === $request->entered_code) {
            // Codes match, mark attendance
            // Your logic here
            return redirect()->back()->with('success', 'Attendance marked successfully.');
        } else {
            // Codes do not match
            return redirect()->back()->with('error', 'Invalid one-time code.');
        }
    }



    public function StudentProfileUpdate( $id)
    {

        $students = Student::find($id);
    return view('student.student-update', compact('students'));
    }


    public function UpdateProfile(Request $request, $id){

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

}
