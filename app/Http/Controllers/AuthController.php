<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// handles login and logout for the application
class AuthController extends Controller
{
    // show the login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // show the registration form for new users
    public function showRegister()
    {
        return view('auth.register');
    }

    // create a new user account and log the user in right away
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'is_admin' => false,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('training.content');
    }

    // show the request form where a user can start a password reset
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // create a reset token and redirect straight to the reset form
    public function sendResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Er is geen account gevonden met dit e-mailadres.',
            ])->onlyInput('email');
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $validated['email']],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        return redirect()->route('password.reset.form', [
            'token' => $token,
            'email' => $validated['email'],
        ])->with('status', 'Je kunt hieronder direct een nieuw wachtwoord instellen.');
    }

    // show the actual reset form with token + email already filled in
    public function showResetPassword(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => (string) $request->query('email', ''),
        ]);
    }

    // update the password if the email + token match
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $resetRow = DB::table('password_reset_tokens')
            ->where('email', $validated['email'])
            ->where('token', $validated['token'])
            ->first();

        if (! $resetRow) {
            return back()->withErrors([
                'email' => 'De resetlink is ongeldig of verlopen.',
            ])->onlyInput('email');
        }

        $user = User::query()->where('email', $validated['email'])->firstOrFail();
        $user->update([
            'password' => $validated['password'],
        ]);

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect()->route('login')->with('status', 'Je wachtwoord is bijgewerkt. Log nu in met je nieuwe wachtwoord.');
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
