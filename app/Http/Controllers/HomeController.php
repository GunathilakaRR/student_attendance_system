<?php

namespace App\Http\Controllers;
use APP\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Lecture;
use App\Models\Schedule;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        $role = Auth::user()->role;

        if($role == '1'){

            $studentCount = Student::count();
            $lecturerCount = Lecturer::count();

            return view('admin.admin-dashboard', compact( 'studentCount', 'lecturerCount'));
        }elseif($role == '2'){
            return view('lecturer.lecturer-dashboard');
        }
        else{
            $user = Auth::user();

    if (!$user->student) {
        return redirect()->back()->with('error', 'You are not registered as a student.');
    }

    // Get all lectures along with their schedules for the logged-in student's lectures
    $lectures = $user->student->lectures()->with('schedules')->get();

    foreach ($lectures as $lecture) {
        foreach ($lecture->schedules as $schedule) {
            $schedule->formatted_start_time = Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('g:i A');
            $schedule->formatted_end_time = Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('g:i A');
        }

        // Get attendance data for the last 60 days
        $startDate = Carbon::now()->subDays(60);
        $attendanceCount = $lecture->attendances()
            ->where('student_id', $user->student->id)
            ->where('created_at', '>=', $startDate)
            ->count();

        // Store attendance data in the lecture object
        $lecture->attendance_data = [
            'days_attended' => $attendanceCount,
            'days_missed' => 60 - $attendanceCount,
        ];
    }

    return view('student.student-dashboard', compact('lectures'));







            // $user = Auth::user();
            // if (!$user->student) {
            //     return redirect()->back()->with('error', 'You are not registered as a student.');
            // }

            // $lectures = $user->student->lectures()->with('schedules')->get();

            // foreach ($lectures as $lecture) {
            //     foreach ($lecture->schedules as $schedule) {
            //         $schedule->formatted_start_time = Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('g:i A');
            //         $schedule->formatted_end_time = Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('g:i A');
            //     }
            // }

            // return view('student.student-dashboard', compact('lectures'));

        }
    }
}
