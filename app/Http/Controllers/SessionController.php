<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $loggedIn = Auth::attempt($attributes);
        if(!$loggedIn) throw ValidationException::withMessages([
            'email'=>'Sorry, those credentials do not match!'
        ]);

        $request->session()->regenerate();
    }

    public function destroy(Request $request)
    {
        Auth::logout();
    }
}
