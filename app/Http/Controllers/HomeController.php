<?php

namespace App\Http\Controllers;
use APP\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard(){
        $role = Auth::user()->role;

        if($role == '1'){
            return view('admin.admin-dashboard');
        }elseif($role == '2'){
            return view('lecturer.lecturer-dashboard');
        }
        else{
            return view('student.student-dashboard');
        }
    }
}
