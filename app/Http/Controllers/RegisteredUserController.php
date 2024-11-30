<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Password;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'confirmed'], //looks for email_confirmation
            'password' => ['required', Password::min(6), 'confirmed'], //looks for password_confirmation
        ]);

        $user = User::create($attributes);

        Auth::login($user);
    }

}
