<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\User;


class LecturerController extends Controller
{


    public function codeGenerate(){

        return view('lecturer.lecturer-code-generate');
    }


    public function otcGenerate(Request $request){

        {
            $request->validate([
                'lecture_code' => 'required|string',
            ]);

            // Generate random 4-digit string
            $randomString = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

            // Concatenate lecture code with random string to create one-time code
            $oneTimeCode = $request->lecture_code . $randomString;

            // Store code in session
            $request->session()->put('one_time_code', $oneTimeCode);

            return redirect()->back()->with('success', 'One-time code generated successfully.');
        }

        // dd($request);
        // $lectureCode = $request->input('lec-code');

        // return view('lecturer.lecturer-code-generate');
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









}
