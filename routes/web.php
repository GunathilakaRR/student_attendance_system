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
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('generate-cv', [CVController::class, 'cvGenerate'])->name('generate.cv');

Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('student-cvbuilder', [StudentController::class, 'CvBilder'])->name('student-cvbuilder');
Route::get('student-attendance', [StudentController::class, 'StudentAttendance'])->name('student-attendance');
Route::post('attendance_mark', [StudentController::class, 'AttendanceMark'])->name('attendance_mark');
Route::get('studentProfile_update/{id}', [StudentController::class, 'StudentProfileUpdate'])->name('studentProfile_update');
Route::post('update-profile/{id}', [StudentController::class, 'UpdateProfile'])->name('update-profile');



Route::get('code-generate', [LecturerController::class, 'codeGenerate'])->name('code-generate');
Route::post('otc-generate', [LecturerController::class, 'otcGenerate'])->name('otc-generate');



Route::get('view-students', [AdminController::class, 'viewStudents'])->name('view-students');
Route::get('view-lecturers', [AdminController::class, 'viewlecturers'])->name('view-lecturers');
Route::get('admin-viewStudent/{id}', [AdminController::class, 'adminViewStudent'])->name('admin-viewStudent');
Route::get('admin_viewLecturer/{id}', [AdminController::class, 'adminViewLecturer'])->name('admin-viewLecturer');
Route::get('selectYear', [AdminController::class, 'selectYear'])->name('selectYear');

