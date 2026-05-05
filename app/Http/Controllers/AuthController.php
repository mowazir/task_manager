<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

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

    public function login(LoginRequest $request)
    {
        //Authentication logic..
        if(Auth::attempt($request->only('email', 'password'), $request->boolean('remember') )) {
            $request->session()->regenerate();

            return redirect()->intended( route('dashboard', absolute:false) );

        }

        return redirect()->back()->withInput()->withErrors([
            'email' => 'These credentials do not match our records'
        ]);

    }

    
    

    

}
