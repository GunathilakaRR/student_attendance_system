<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\AdminController;





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

Route::get('view-students', [AdminController::class, 'viewStudents'])->name('view-students');
Route::get('view-lecturers', [AdminController::class, 'viewlecturers'])->name('view-lecturers');
