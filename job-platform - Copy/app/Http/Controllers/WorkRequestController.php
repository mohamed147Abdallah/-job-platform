<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WorkRequest; 
use App\Models\Job; 
use Illuminate\Support\Facades\Auth;

class WorkRequestController extends Controller
{
    /**
     * Handle sending a work request (Application from a freelancer to a founder via a specific job).
     * Validates that the user hasn't already applied for the same position.
     * @param int $jobId
     */
    public function sendRequest($jobId)
    {
        $job = Job::findOrFail($jobId);
        $founder = $job->user; // The founder is the owner of the job

        // Prevent duplicate applications (check for existing pending or accepted requests)
        $exists = WorkRequest::where('sender_id', Auth::id())
                              ->where('job_id', $jobId) 
                              ->whereIn('status', ['pending', 'accepted'])
                              ->exists();

        if ($exists) {
            return back()->with('error', 'You have already applied for this position or your application has already been accepted.');
        }

        WorkRequest::create([
            'job_id' => $jobId, // Links the request to the specific job
            'sender_id' => Auth::id(), // Authenticated freelancer
            'receiver_id' => $founder->id, // Targeted founder
            'type' => 'application', 
            'status' => 'pending'
        ]);

        return back()->with('success', 'Your application for the "' . $job->title . '" position has been submitted successfully! 🚀');
    }

    /**
     * Handle sending a direct invitation (From a founder to a freelancer).
     * Includes security checks to prevent users from inviting themselves.
     * @param int $freelancerId
     */
    public function sendInvitation($freelancerId)
    {
        $freelancer = User::findOrFail($freelancerId);
        
        // Security: Prevent users from sending an invitation to themselves
        if ($freelancer->id == Auth::id()) {
            return back()->with('error', 'You cannot invite yourself.');
        }

        // Check for existing pending or accepted invitations
        $exists = WorkRequest::where('sender_id', Auth::id())
                              ->where('receiver_id', $freelancerId)
                              ->where('type', 'invitation')
                              ->whereIn('status', ['pending', 'accepted'])
                              ->exists();

        if ($exists) {
            return back()->with('error', 'An invitation has already been sent to this freelancer.');
        }

        WorkRequest::create([
            'job_id' => null, // General invitation not tied to a specific job record
            'sender_id' => Auth::id(), // Authenticated founder
            'receiver_id' => $freelancerId, // Targeted freelancer
            'type' => 'invitation',
            'status' => 'pending'
        ]);

        return back()->with('success', 'The invitation has been successfully sent to ' . $freelancer->name . '!');
    }

    /**
     * Display the list of incoming pending requests for the authenticated user.
     * Loads associated sender and job data for the view.
     */
    public function showRequests()
    {
        $user = Auth::user();

        // Retrieve all pending requests where the user is the receiver
        $requests = WorkRequest::where('receiver_id', $user->id)
                                ->where('status', 'pending')
                                ->with(['sender', 'job']) 
                                ->latest()
                                ->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * Accept an incoming work request or invitation.
     * Verifies that the user is the authorized receiver of the request.
     * @param int $id
     */
    public function acceptRequest($id)
    {
        $request = WorkRequest::findOrFail($id);
        
        // Security: Ensure the current user is the intended recipient
        if ($request->receiver_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to perform this action.');
        }

        $request->update(['status' => 'accepted']);
        return back()->with('success', 'The invitation has been accepted! 🎉');
    }

    /**
     * Decline an incoming work request or invitation.
     * @param int $id
     */
    public function declineRequest($id)
    {
        $request = WorkRequest::findOrFail($id);
        
        if ($request->receiver_id !== Auth::id()) {
            return back()->with('error','You are not authorized to perform this action.');
        }

        $request->update(['status' => 'declined']);
        return back()->with('success', 'The invitation was declined.');
    }
}