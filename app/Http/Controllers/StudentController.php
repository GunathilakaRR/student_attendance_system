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
use Illuminate\Support\Facades\Http;

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




    public function ShowMarks($registration_number)
    {
        $registration_number = urldecode($registration_number);
        $student = Student::where('registration_number', $registration_number)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }

        $marks = Marks::where('registration_number', $registration_number)->first();
        $grades = [];
        $feedback = [];
        $videos = [];

        if ($marks) {
            $grades = [
                'subject1_grade' => $this->determineGrade($marks->subject1_marks),
                'subject2_grade' => $this->determineGrade($marks->subject2_marks),
                'subject3_grade' => $this->determineGrade($marks->subject3_marks),
                'subject4_grade' => $this->determineGrade($marks->subject4_marks),
                'subject5_grade' => $this->determineGrade($marks->subject5_marks),
            ];

            $feedbackData = $this->generateFeedback($marks);
            $feedback = $feedbackData['feedback'];
            $videos = $feedbackData['videos'];
        }

        return view('student.student-marks', compact('student', 'marks', 'grades', 'feedback', 'videos'));
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
        $videos = [];
        $subjects = [
            'subject1_marks' => 'Python',
            'subject2_marks' => 'Java',
            'subject3_marks' => 'PHP',
            'subject4_marks' => 'Javascript',
            'subject5_marks' => 'C++',
        ];

        foreach ($subjects as $key => $subject) {
            if ($marks->$key <= 40) {
                $feedback[$subject] = "\n\nYou've got low marks in $subject.\nDon't worry. Keep practicing, stay motivated, and use the following course materials to boost your skills!";
                $videos[$subject] = $this->fetchYouTubeVideos($subject); // Call to fetch videos
            }
        }

        return ['feedback' => $feedback, 'videos' => $videos];
    }

    private function fetchYouTubeVideos($subject)
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $query = urlencode($subject . ' tutorial');
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q={$query}&key={$apiKey}&maxResults=5&type=video";

        // Disable SSL verification
        $response = Http::withOptions(['verify' => false])->get($url);

        if ($response->successful()) {
            return collect($response->json()['items'])->map(function ($item) {
                return [
                    'url' => 'https://www.youtube.com/watch?v=' . $item['id']['videoId'],
                    'thumbnail' => $item['snippet']['thumbnails']['medium']['url'],
                    'title' => $item['snippet']['title'],
                ];
            })->toArray();
        }

        return [];
    }



}



    // public function ShowMarks($registration_number, YouTubeService $youTubeService)
    // {
    //     $registration_number = urldecode($registration_number);
    //     $student = Student::where('registration_number', $registration_number)->first();
    //     if (!$student) {
    //         return redirect()->back()->with('error', 'Student not found');
    //     }

    //     $marks = Marks::where('registration_number', $registration_number)->first();
    //     $grades = [];
    //     $feedback = [];
    //     $playlists = [];

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
    //     return view('student.student-marks', compact('student', 'marks', 'grades', 'feedback', 'playlists'));
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
    //         $feedback['subject1'] = 'Need to improve in Python';
    //     }
    //     if ($marks->subject2_marks <= 40) {
    //         $feedback['subject2'] = 'Need to improve in Java';
    //     }
    //     if ($marks->subject3_marks <= 40) {
    //         $feedback['subject3'] = 'Need to improve in PHP';
    //     }
    //     if ($marks->subject4_marks <= 40) {
    //         $feedback['subject4'] = 'Need to improve in Javascript';
    //     }
    //     if ($marks->subject5_marks <= 40) {
    //         $feedback['subject5'] = 'Need to improve in C++';
    //     }
    //     return $feedback;
    // }




    // public function ShowMarks($registration_number, YouTubeService $youTubeService)
    // {
    //     $registration_number = urldecode($registration_number);
    //     $student = Student::where('registration_number', $registration_number)->first();
    //     if (!$student) {
    //         return redirect()->back()->with('error', 'Student not found');
    //     }

    //     $marks = Marks::where('registration_number', $registration_number)->first();
    //     $grades = [];
    //     $feedback = [];
    //     $playlists = [];

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
    //     return view('student.student-marks', compact('student', 'marks', 'grades', 'feedback', 'playlists'));
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
    //     $subjects = [
    //         'subject1_marks' => 'Python',
    //         'subject2_marks' => 'Java',
    //         'subject3_marks' => 'PHP',
    //         'subject4_marks' => 'Javascript',
    //         'subject5_marks' => 'C++',
    //     ];

    //     foreach ($subjects as $key => $subject) {
    //         if ($marks->$key <= 40) {
    //             $feedback[$subject] = "\n\nYou've got low marks in $subject.\n Don't worry. Keep practicing, stay motivated, and use the following course materials to boost your skills!";
    //         }
    //     }

    //     return $feedback;
    // }








