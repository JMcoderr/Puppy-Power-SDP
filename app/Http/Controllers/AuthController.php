<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// handles login and logout for the application
class AuthController extends Controller
{
    // show the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validate that both fields are present before attempting login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // attempt login; the remember flag keeps the session alive longer
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            // attach the error to the email field so the form can highlight it
            return back()->withErrors([
                'email' => 'Inloggegevens kloppen niet.',
            ])->onlyInput('email');
        }

        // regenerate session ID after login to prevent session fixation
        $request->session()->regenerate();

        // redirect admins to beheer, regular users to training content
        if ($request->user()->is_admin) {
            return redirect()->route('beheer.index');
        }

        return redirect()->route('training.content');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // destroy the session and issue a fresh CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
