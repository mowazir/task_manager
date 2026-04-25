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
        
        $throttleKey = strtolower($request->input('email')) . '|' . $request->ip() ;

        if(RateLimiter::tooManyAttempts($throttleKey, 5)){
            throw ValidationException::withMessages([
                'email' => 'Too many login attempt, try after 30 seconds'
            ]) ;
        }

        //Authentication logic..
        if(Auth::attempt($request->only('email', 'password'), $request->boolean('remember') )) {
            $request->session()->regenerate();

            RateLimiter::clear($throttleKey);

            return redirect()->intended( route('dashboard', absolute:false) );

        }

        RateLimiter::hit($throttleKey);

        throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records'
            ]);

    }




}
