<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
            'student_registration_number' => ($input['role'] == 0) ? ['required', 'string'] : '', // Validate student registration number if role is Student            'name1' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name1' => $input['name1'],
            'name2' => $input['name2'],
            'role' => $input['role'],
            'student_registration_number' => $input['student_registration_number'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }



}
