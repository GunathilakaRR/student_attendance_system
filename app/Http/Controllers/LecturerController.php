<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
