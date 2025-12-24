<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkRequest;
use App\Models\Conversation;

class JobController extends Controller
{
    /**
     * Display the job market.
     * Fetches all jobs with their posters, along with a list of founders and freelancers.
     */
    public function index()
    {
        $jobs = Job::with('user')->latest()->get();
        $founders = User::where('role', 'founder')->get();
        $freelancers = User::where('role', 'freelancer')->get();
        
        return view('freelancer.jobs', compact('jobs', 'founders', 'freelancers'));
    }

    /**
     * Show the form for creating a new job post.
     */
    public function create()
    {
        $freelancers = User::where('role', 'freelancer')->get();
        return view('founder.jobs', compact('freelancers'));
    }

    /**
     * Store a newly created job in the database.
     * Includes validation for location data and job specifics.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'nullable|string|max:255',
            'type' => 'required|string', 
            'location_type' => 'required|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'map_link' => 'nullable|url',
        ]);

        $validated['user_id'] = Auth::id();

        Job::create($validated);

        return redirect()->route('jobs.my')->with('success', 'Job posted successfully! 🚀');
    }

    /**
     * Display the specified job details.
     * Includes associated requests and their senders.
     */
    public function show($id)
    {
        $job = Job::with(['user', 'requests.sender', 'acceptedRequests.sender'])->findOrFail($id);
        $freelancers = User::where('role', 'freelancer')->get();

        return view('founder.show', compact('job', 'freelancers'));
    }
    
    /**
     * Display the profile and projects of a specific founder.
     */
    public function showFounder($id)
    {
        $founder = User::findOrFail($id);
        
        try {
            $founderProjects = Job::where('user_id', $id)->get();
        } catch (\Exception $e) {
            $founderProjects = []; 
        }

        $freelancers = User::where('role', 'freelancer')->get();

        return view('freelancer.founder-details', compact('founder', 'founderProjects', 'freelancers'));
    }

    /**
     * Display a list of jobs posted by the currently authenticated founder.
     */
    public function myJobs()
    {
        $jobs = Job::where('user_id', Auth::id())->latest()->get();
        $freelancers = User::where('role', 'freelancer')->get();

        return view('founder.my-jobs', compact('jobs', 'freelancers'));
    }

    /**
     * Display the list of applicants for a specific job.
     */
    public function showApplications($jobId)
    {
        $job = Job::where('user_id', Auth::id())
            ->with(['requests.sender'])
            ->findOrFail($jobId);
        
        return view('founder.job_applications', compact('job'));
    }
    
    /**
     * Accept a job application and initialize a conversation between the parties.
     */
    public function acceptApplication($applicationId)
    {
        // Retrieve the application and verify ownership of the associated job
        $request = WorkRequest::where('id', $applicationId)
            ->whereHas('job', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        // Update the application status to accepted
        $request->update(['status' => 'accepted']);

        // Create or retrieve a conversation between the founder and the freelancer
        $conversation = Conversation::firstOrCreate(
            [
                'job_id' => $request->job_id,
                'founder_id' => Auth::id(),
                'freelancer_id' => $request->sender_id,
            ]
        );

        // Redirect directly to the chat interface
        return redirect()
            ->route('chat.show', $conversation->id)
            ->with('success', 'The application has been approved successfully. You can now start the conversation 💬');
    }

    /**
     * Reject a job application.
     */
    public function rejectApplication($applicationId)
    {
        $request = WorkRequest::where('id', $applicationId)
            ->whereHas('job', function($q){ 
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();
        
        $request->update(['status' => 'declined']);

        return back()->with('success', 'The applicant has been successfully rejected.');
    }
}