<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display the registration form for Founders.
     */
    public function showRegisterForm()
    {
        return view('auth.register-founder'); 
    }

    /**
     * Handle the registration process for both Founders and Freelancers.
     * Includes conditional validation: company name is required for founders, 
     * while specialization is required for freelancers.
     * @param Request $request
     */
    public function register(Request $request)
    {
        // 1. Data Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string|in:founder,freelancer',
            
            // Conditional validation based on role
            'company_name' => 'nullable|required_if:role,founder|string|max:255',
            'specialization' => 'nullable|required_if:role,freelancer|string|max:255',
        ]);

        // 2. User Creation
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_name' => $request->company_name ?? null, 
            'specialization' => $request->specialization ?? null,
        ]);

        // 3. Automatic Login after registration
        Auth::login($user);

        // 4. Redirection to the skills selection step
        return redirect()->route('register.skills');
    }

    /**
     * Display the skills selection form.
     */
    public function showSkillsForm()
    {
        $skills = ['Web Development', 'UI/UX', 'Marketing', 'Sales', 'Data Science', 'AI/ML', 'Finance'];
        return view('register.skills', compact('skills'));
    }

    /**
     * Save the selected skills to the authenticated user's profile.
     * Skills are stored as a JSON array in the database.
     * @param Request $request
     */
    public function saveSkills(Request $request)
    {
        $request->validate([
            'skills' => 'required|array|min:1',
        ]);

        $user = Auth::user();
        /** @var \App\Models\User $user */
        
        // Save skills as JSON (or array based on model casts)
        $user->skills = json_encode($request->skills);
        $user->save();

        // Redirect to the dashboard upon successful completion
        return redirect()->route('dashboard')->with('success', 'Skills saved successfully!');
    }
}