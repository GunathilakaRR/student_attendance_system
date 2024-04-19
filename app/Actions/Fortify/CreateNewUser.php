<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Admin;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'role' => ['required', 'integer', 'in:0,1,2'],
            'student_registration_number' => ($input['role'] == 0) ? ['required', 'string'] : '',
            'name1' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        $role = $input['role'];
        $email = $input['email'];
        $password = $input['password'];
        $userData = [
            'role' => $role,
            'email' => $email,
            'password' => Hash::make($input['password']),
        ];

        $user = User::create($userData);

        if ($role == 0) {
            Student::create([
                'user_id' => $user->id,
                'name1' => $input['name1'],
                'name2' => $input['name2'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'registration_number' => $input['student_registration_number'],
                // Add other student details here
            ]);
        } elseif ($role == 1) {
            Admin::create([
                'user_id' => $user->id,
                'name1' => $input['name1'],
                'name2' => $input['name2'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                // Add other admin details here
            ]);
        } elseif ($role == 2) {
            Lecturer::create([
                'user_id' => $user->id,
                'name1' => $input['name1'],
                'name2' => $input['name2'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                // Add other lecturer details here
            ]);
        }

        return $user;


    }



}
