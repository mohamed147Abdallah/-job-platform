<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FounderProjectController extends Controller
{
    /**
     * Helper method to retrieve projects for the authenticated user.
     * Used across multiple methods to ensure consistent data for layouts/sidebars.
     */
    private function getProjects()
    {
        return Project::where('user_id', Auth::id())->latest()->get();
    }

    /**
     * Display a listing of the user's projects.
     */
    public function index()
    {
        $projects = $this->getProjects();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        // Projects list is passed to support sidebar/layout requirements
        $projects = $this->getProjects();
        return view('projects.create', compact('projects'));
    }

    /**
     * Store a newly created project in storage.
     * Validates input before persisting data to the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'nullable|numeric',
        ]);

        Project::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
            'status' => 'open',
        ]);

        return redirect()->route('projects')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified project details.
     * Includes the full projects list for navigation purposes.
     * * @param int $id
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $projects = $this->getProjects();
        
        return view('projects.show', compact('project', 'projects'));
    }

    /**
     * Show the form for editing the specified project.
     * * @param int $id
     */
    public function edit($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $projects = $this->getProjects();
        
        return view('projects.edit', compact('project', 'projects'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project->update($request->all());

        return redirect()->route('projects')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $project->delete();

        return redirect()->route('projects')->with('success', 'Project deleted successfully!');
    }
}