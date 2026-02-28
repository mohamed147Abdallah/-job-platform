<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the role selection page (Founder / Freelancer).
     */
    public function chooseRole()
    {
        return view('auth.choose-role');
    }

    /**
     * Show the registration form for Founders.
     */
    public function showRegisterFounder()
    {
        return view('auth.register-founder');
    }

    /**
     * Show the registration form for Freelancers.
     */
    public function showRegisterFreelancer()
    {
        return view('auth.register-freelancer');
    }

    /**
     * Handle the registration request for new users.
     */
    public function register(Request $request)
    {
        // Validate the incoming registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:founder,freelancer',
        ]);

        // Create a new user record in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Automatically log in the user after successful registration
        Auth::login($user);

        // Redirect the user to the appropriate dashboard based on their role
        return $this->redirectUserByRole($user);
    }

    /**
     * Display the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            return $this->redirectUserByRole($user);
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Log out the user from the current guard
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the home/welcome page after logout
        return redirect()->route('welcome');
    }

    /**
     * Helper method to redirect users based on their specific role.
     */
    private function redirectUserByRole($user)
    {
        if ($user->role === 'founder') {
            return redirect()->route('founder.home');
        } elseif ($user->role === 'freelancer') {
            return redirect()->route('freelancer.dashboard');
        }

        return redirect('/');
    }
}