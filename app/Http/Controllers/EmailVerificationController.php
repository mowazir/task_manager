<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    //
    public function index(Request $request) : View|RedirectResponse
    {
        if($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute:false));
        }

        return view('auth.verify-email');

    }

    

}
