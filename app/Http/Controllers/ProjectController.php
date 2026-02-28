<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects belonging only to the authenticated user.
     */
    public function index()
    {
        // Retrieve projects associated with the logged-in user
        $projects = Project::where('user_id', Auth::id())->latest()->get();
        return view('founder.projects', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('founder.create');
    }

    /**
     * Store a newly created project in the database.
     * Manually assigns the user ID to the validated data before persisting.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'link' => 'nullable|url'
        ]);

        // Manually inject the authenticated user's ID
        $validated['user_id'] = Auth::id();

        Project::create($validated);

        return redirect()->route('projects')->with('success', 'Project Launched Successfully!');
    }

    /**
     * Display the specified project details.
     * Includes a security check to ensure the project belongs to the user.
     */
    public function show($id)
    {
        // Verify ownership before displaying details
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        return view('founder.project-details', compact('project'));
    }

    /**
     * Show the form for editing a specific project.
     * Includes an ownership protection check.
     */
    public function edit($id)
    {
        // Protect the edit route by checking the user_id
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        return view('founder.edit', compact('project'));
    }

    /**
     * Update the specified project in the database.
     * Validates both ownership and input data.
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'link' => 'nullable|url'
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $id)->with('success', 'System Configuration Updated Successfully!');
    }

    /**
     * Remove the specified project from the database.
     * Ensures only the owner can terminate the project.
     */
    public function destroy($id)
    {
        // Verify ownership before deletion
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $project->delete();

        return redirect()->route('projects')->with('success', 'Project Terminated Successfully.');
    }
}