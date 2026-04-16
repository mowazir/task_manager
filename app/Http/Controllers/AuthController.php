<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {

        $validatedResultData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'boolean'],
        ],
        [
            'email.required' => 'Please enter email',
            'email.email' => 'Email entered not valid',
            'password.required' => 'At least 3 digit'
        ]
        );

        //Authentication logic..
        if(Auth::attempt($request->only('email', 'password'), $request->boolean('remember') )){

        }

    }



}
