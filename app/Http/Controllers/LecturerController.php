<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


class LecturerController extends Controller
{


    public function codeGenerate(){
        // $lectures = Lecture::all();
        $lecturer = Auth::user()->lecturer;
        $lectures = $lecturer->lectures;
        return view('lecturer.lecturer-code-generate', compact('lectures'));
    }



    public function otcGenerate(Request $request){


        $request->validate([
            'course_id' => 'required|exists:lectures,id',
        ]);

        $lecture = Lecture::findOrFail($request->course_id);

        $oneTimeCode = $lecture->code . Str::random(4);
        $expiration = now()->addSeconds(30)->timestamp;;


        return redirect()->back()->with([
            'success' => 'One-time code generated successfully.',
            'one_time_code' => $oneTimeCode,
            'expiration' => $expiration,
        ]);


    }


    public function LecturerProfileUpdate($id){

        $lecturers = Lecturer::find($id);
        return view('lecturer.lecturer-update', compact('lecturers'));
    }



    public function UpdateProfile(Request $request, $id){
        //dd($request);

        $validatedData = $request->validate([
            'name1' => 'required|string|max:255',
            'name2' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_pic'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lecturer = Lecturer::find($id);

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $validatedData['image'] = $path;
        }

        $lecturer->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function ViewAssignedlectures($id){

        $lecturer = Lecturer::with('lectures.schedules')->findOrFail($id);
        return view('lecturer.lecturer-viewAssigned-lectures', compact('lecturer'));
    }






}
