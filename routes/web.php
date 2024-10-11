<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LecturerController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('generate-cv', [CVController::class, 'cvGenerate'])->name('generate.cv');

Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('student-cvbuilder', [StudentController::class, 'CvBilder'])->name('student-cvbuilder');
Route::get('student-attendance', [StudentController::class, 'StudentAttendance'])->name('student-attendance');
Route::post('attendance_mark', [StudentController::class, 'AttendanceMark'])->name('attendance_mark');
Route::get('studentProfile_update/{id}', [StudentController::class, 'StudentProfileUpdate'])->name('studentProfile_update');
// Route::post('update-profile/{id}', [StudentController::class, 'UpdateProfile'])->name('update-profile');
Route::post('student_profile_update/{id}', [StudentController::class, 'Student_Profile_Update'])->name('student_profile_update');
Route::get('register_for_courses', [StudentController::class, 'RegisterForCourses'])->name('register_for_courses');
Route::post('register_store', [StudentController::class, 'Register'])->name('register.store');
Route::get('/students/{registration_number}/marks', [StudentController::class, 'ShowMarks'])
    ->where('registration_number', '[A-Za-z0-9\-\_\/]+')
    ->name('students.marks');


Route::get('code-generate', [LecturerController::class, 'codeGenerate'])->name('code-generate');
Route::post('otc-generate', [LecturerController::class, 'otcGenerate'])->name('otc-generate');
Route::get('/lectures/{lecture}/attendance-summary', [LecturerController::class, 'attendanceSummary'])->name('lectures.attendance-summary');
Route::get('/lectures/{lecture}/download-summary', [LecturerController::class, 'downloadSummary'])->name('lectures.download-summary');
Route::get('lecturerProfile_update/{id}', [LecturerController::class, 'LecturerProfileUpdate'])->name('lecturerProfile_update');
Route::post('update-profile/{id}', [LecturerController::class, 'UpdateProfile'])->name('update-profile');
Route::get('view_assigned_lectures/{id}', [LecturerController::class, 'ViewAssignedlectures'])->name('view_assigned_lectures');
Route::get('dashboard_attendance/{id}', [LecturerController::class, 'attendanceTrends'])->name('dashboard_attendance');
Route::get('video-call', [LecturerController::class, 'VideoCall'])->name('video-call');




Route::get('view-students', [AdminController::class, 'viewStudents'])->name('view-students');
Route::get('view-lecturers', [AdminController::class, 'viewlecturers'])->name('view-lecturers');
Route::get('admin-viewStudent/{id}', [AdminController::class, 'adminViewStudent'])->name('admin-viewStudent');
Route::get('admin_viewLecturer/{id}', [AdminController::class, 'adminViewLecturer'])->name('admin-viewLecturer');
Route::get('view-lectures', [AdminController::class, 'viewLectures'])->name('view-lectures');
Route::get('selectYear', [AdminController::class, 'selectYear'])->name('selectYear');
Route::get('add_newLecture', [AdminController::class, 'addNewLecture'])->name('add-newLecture');
Route::post('add_lecture', [AdminController::class, 'AddLecture'])->name('add_lecture');
Route::get('assign-lecturer/{id}', [AdminController::class, 'ShowAssignForm'])->name('assign-lecturer');
Route::post('assign-lecturer', [AdminController::class, 'AssignLecturer'])->name('assign-lecturer');
Route::get('view-lecture-info-/{code}', [AdminController::class, 'ViewLectureInfo'])->name('view-lecture-info-');
Route::get('delete-lecture/{id}', [AdminController::class, 'DeleteLecture'])->name('delete-lecture');
Route::get('add-marks', [AdminController::class, 'AddMarks'])->name('add-marks');
Route::post('import-marks', [AdminController::class, 'ImportMarks'])->name('import-marks');

