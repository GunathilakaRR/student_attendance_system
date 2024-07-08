<?php

namespace App\Http\Controllers;
use App\Services\YouTubeService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecture;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\Marks;


class StudentController extends Controller
{

    public function CvBilder(){

        $users = User::all();
        return view('student.student-builder', ['users' => $users]);
    }

    public function StudentAttendance(){
        $studentId = auth()->user()->student->id;
    $attendances = Attendance::where('student_id', $studentId)->get();

    return view('student.student-attendance', compact('attendances'));
        // return view('student.student-attendance');
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

    // Check if the student has already marked attendance for this lecture today
    $currentDate = now()->format('Y-m-d');
    $attendanceExists = Attendance::where('student_id', $studentId)
                                  ->where('lecture_id', $lectureId)
                                  ->whereDate('marked_at', $currentDate)
                                  ->exists();
    if ($attendanceExists) {
        return redirect()->back()->withErrors(['error' => 'You have already marked your attendance for this lecture today.']);
    }

    Attendance::create([
        'student_id' => $studentId,
        'lecture_id' => $lectureId,
        'marked_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Attendance marked successfully.');
}



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





    public function ShowMarks($registration_number, YouTubeService $youTubeService)
    {
        $registration_number = urldecode($registration_number);
        $student = Student::where('registration_number', $registration_number)->first();
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        $marks = Marks::where('registration_number', $registration_number)->first();
        $grades = [];
        $feedback = [];
        $playlists = [];

        if ($marks) {
            $grades = [
                'subject1_grade' => $this->determineGrade($marks->subject1_marks),
                'subject2_grade' => $this->determineGrade($marks->subject2_marks),
                'subject3_grade' => $this->determineGrade($marks->subject3_marks),
                'subject4_grade' => $this->determineGrade($marks->subject4_marks),
                'subject5_grade' => $this->determineGrade($marks->subject5_marks),
            ];

            $feedback = $this->generateFeedback($marks);

            // Fetch playlists for subjects with low marks
            // if ($marks->subject1_marks <= 40) {
            //     $playlists['subject1'] = $youTubeService->getPlaylists('Python');
            // }
            // if ($marks->subject2_marks <= 40) {
            //     $playlists['subject2'] = $youTubeService->getPlaylists('Mathematics');
            // }
            // if ($marks->subject3_marks <= 40) {
            //     $playlists['subject3'] = $youTubeService->getPlaylists('Physics');
            // }
            // if ($marks->subject4_marks <= 40) {
            //     $playlists['subject4'] = $youTubeService->getPlaylists('Chemistry');
            // }
            // if ($marks->subject5_marks <= 40) {
            //     $playlists['subject5'] = $youTubeService->getPlaylists('Biology');
            // }
        }

        return view('student.student-marks', compact('student', 'marks', 'grades', 'feedback', 'playlists'));
    }

    private function determineGrade($marks)
    {
        if ($marks < 50) {
            return 'F';
        } elseif ($marks <= 60) {
            return 'C';
        } elseif ($marks <= 70) {
            return 'B';
        } else {
            return 'A';
        }
    }

    private function generateFeedback($marks)
    {
        $feedback = [];
        if ($marks->subject1_marks <= 40) {
            $feedback['subject1'] = 'Need to improve in Subject 1';
        }
        if ($marks->subject2_marks <= 40) {
            $feedback['subject2'] = 'Need to improve in Subject 2';
        }
        if ($marks->subject3_marks <= 40) {
            $feedback['subject3'] = 'Need to improve in Subject 3';
        }
        if ($marks->subject4_marks <= 40) {
            $feedback['subject4'] = 'Need to improve in Subject 4';
        }
        if ($marks->subject5_marks <= 40) {
            $feedback['subject5'] = 'Need to improve in Subject 5';
        }
        return $feedback;
    }




//     public function ShowMarks($registration_number)
// {
//     $registration_number = urldecode($registration_number);
//     $student = Student::where('registration_number', $registration_number)->first();
//     if (!$student) {
//         return redirect()->back()->with('error', 'Student not found');
//     }

//     $marks = Marks::where('registration_number', $registration_number)->first();
//     $grades = [];
//     $feedback = [];

//     if ($marks) {
//         $grades = [
//             'subject1_grade' => $this->determineGrade($marks->subject1_marks),
//             'subject2_grade' => $this->determineGrade($marks->subject2_marks),
//             'subject3_grade' => $this->determineGrade($marks->subject3_marks),
//             'subject4_grade' => $this->determineGrade($marks->subject4_marks),
//             'subject5_grade' => $this->determineGrade($marks->subject5_marks),
//         ];

//         $feedback = $this->generateFeedback($marks);
//     }

//     return view('student.student-marks', compact('student', 'marks', 'grades', 'feedback'));
// }

// private function determineGrade($marks)
// {
//     if ($marks < 50) {
//         return 'F';
//     } elseif ($marks <= 60) {
//         return 'C';
//     } elseif ($marks <= 70) {
//         return 'B';
//     } else {
//         return 'A';
//     }
// }

// private function generateFeedback($marks)
// {
//     $feedback = [];

//     if ($marks->subject1_marks <= 40) {
//         $feedback['subject1'] = 'You need to work hard in Subject 1.';
//     }
//     if ($marks->subject2_marks <= 40) {
//         $feedback['subject2'] = 'You need to work hard in Subject 2.';
//     }
//     if ($marks->subject3_marks <= 40) {
//         $feedback['subject3'] = 'You need to work hard in Subject 3.';
//     }
//     if ($marks->subject4_marks <= 40) {
//         $feedback['subject4'] = 'You need to work hard in Subject 4.';
//     }
//     if ($marks->subject5_marks <= 40) {
//         $feedback['subject5'] = 'You need to work hard in Subject 5.';
//     }

//     return $feedback;
// }




}



