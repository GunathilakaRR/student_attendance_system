<?php

namespace App\Http\Controllers;
use APP\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Lecture;
use App\Models\Schedule;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        $role = Auth::user()->role;

        if (auth()->user()->role == '1') {
            // Fetch student count
            $studentCount = Student::count();

            // Fetch lecturer count
            $lecturerCount = Lecturer::count();

            // Calculate average marks for each subject
            $averageMarks = DB::table('marks')
                ->select(
                    DB::raw('AVG(subject1_marks) as subject1_avg'),
                    DB::raw('AVG(subject2_marks) as subject2_avg'),
                    DB::raw('AVG(subject3_marks) as subject3_avg'),
                    DB::raw('AVG(subject4_marks) as subject4_avg'),
                    DB::raw('AVG(subject5_marks) as subject5_avg')
                )
                ->first();

            // Convert the result to an array for easy manipulation in the view
            $averageMarks = (array) $averageMarks;

            // Fetch attendance data along with lecture names
            $attendanceData = DB::table('attendances')
                ->join('lectures', 'attendances.lecture_id', '=', 'lectures.id')
                ->select('lectures.title as lecture_name', DB::raw('COUNT(attendances.student_id) as attendance_count'))
                ->groupBy('lectures.title')
                ->get();

            // Prepare attendance data for the view
            $attendanceCounts = [];
            foreach ($attendanceData as $data) {
                $attendanceCounts[$data->lecture_name] = $data->attendance_count;
            }

            return view('admin.admin-dashboard', compact('studentCount', 'lecturerCount', 'averageMarks', 'attendanceCounts'));


        }elseif($role == '2'){

        //     $lecturer = Lecturer::with('lectures.schedules')->findOrFail($id);
        // // return view('lecturer.lecturer-viewAssigned-lectures', compact('lecturer'));
        //     return view('lecturer.lecturer-dashboard', compact('lecturer'));

        $user = Auth::user();

        if (!$user->lecturer) {
            return redirect()->back()->with('error', 'You are not registered as a lecturer.');
        }

        // Get all lectures along with their schedules for the logged-in lecturer
        $lecturer = $user->lecturer->load('lectures.schedules');
        return view('lecturer.lecturer-dashboard', compact('lecturer'));


        }
        else{

            $user = Auth::user();

            if (!$user->student) {
                return redirect()->back()->with('error', 'You are not registered as a student.');
            }

            // Get all lectures for the logged-in student's lectures
            $lectures = $user->student->lectures()->with('schedules')->get();

            foreach ($lectures as $lecture) {


                foreach ($lecture->schedules as $schedule) {
                             $schedule->formatted_start_time = Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('g:i A');
                             $schedule->formatted_end_time = Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('g:i A');
                         }


                // Total sessions for each lecture module
                $totalSessions = 30; // Assuming each lecture module has 30 sessions

                // Get the attendance count for the student for this lecture
                $attendanceCount = $lecture->attendances()
                    ->where('student_id', $user->student->id) // Filter by student ID
                    ->where('lecture_id', $lecture->id) // Filter by the current lecture's ID
                    ->count();

                // Store attendance data in the lecture object
                $lecture->attendance_data = [
                    'sessions_attended' => $attendanceCount,   // Number of sessions attended
                    'sessions_missed' => $totalSessions - $attendanceCount, // Number of sessions missed
                ];
            }

            // Pass the lectures to the view
            return view('student.student-dashboard', compact('lectures'));


        }
    }
}
