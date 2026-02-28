<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Project;

class ProfileController extends Controller
{
    /**
     * Display a directory of all registered freelancers.
     */
    public function allFreelancers()
    {
        $freelancers = User::where('role', 'freelancer')->latest()->get();
        
        return view('freelancer.index', compact('freelancers'));
    }

    /**
     * Display a specific freelancer's public profile.
     * Includes a security check to ensure the user is actually a freelancer.
     * @param int $id
     */
    public function showFreelancer($id)
    {
        $freelancer = User::findOrFail($id);
        
        // Security: Ensure the user being viewed has the freelancer role
        if ($freelancer->role !== 'freelancer') {
            abort(404);
        }

        $projects = Project::where('user_id', $id)->latest()->get();

        return view('freelancer.show', compact('freelancer', 'projects'));
    }

    /**
     * Display the authenticated user's profile for editing.
     */
    public function show()
    {
        $user = Auth::user();
        return view('freelancer.profile', compact('user'));
    }

    /**
     * Update the authenticated user's profile information.
     * Handles image uploads, password hashing, and role-specific field validation.
     * @param Request $request
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6',
            'skills' => 'nullable|string', 
            'company_name' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
        ]);

        // Filter out null or empty values from the validated data
        $data = array_filter($validated, fn($v) => $v !== null && $v !== '');

        // Handle profile image upload and delete old image if it exists
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profiles', 'public');
            $data['profile_image'] = $path;
        }

        // Handle password hashing if a new password is provided
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Convert comma-separated skills string into an array
        if (isset($data['skills'])) {
            $skillsArray = $data['skills'] ? array_map('trim', explode(',', $data['skills'])) : [];
            $data['skills'] = $skillsArray; 
        }

        // Ensure role-specific fields are only populated for the relevant roles
        if ($user->role === 'founder') {
            $data['specialization'] = null;
        } elseif ($user->role === 'freelancer') {
            $data['company_name'] = null;
        }

        $user->fill($data)->save();

        return back()->with('success', '✅ Profile updated successfully');
    }

    /**
     * Delete the authenticated user's account and associated storage files.
     */
    public function destroy()
    {
        $user = Auth::user();
        
        // Remove profile image from storage before deleting the account
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully ❌');
    }
}