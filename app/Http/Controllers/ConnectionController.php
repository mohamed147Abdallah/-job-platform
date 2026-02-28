<?php

namespace App\Http\Controllers;

use App\Models\WorkRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    /**
     * Display a list of all accepted work requests (connections) for the current user.
     * This includes requests where the user is either the sender or the receiver.
     */
    public function index()
    {
        $userId = Auth::id();

        // Retrieve all accepted requests associated with the authenticated user
        $connections = WorkRequest::where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->with(['sender', 'receiver', 'job'])
            ->latest()
            ->get();

        return view('connections.index', compact('connections'));
    }

    /**
     * Remove a specific connection (team member) from the user's list.
     * Validates that the user is a participant in the connection before deletion.
     */
    public function destroy($id)
    {
        // Find the request and verify the user is a participant
        $connection = WorkRequest::where('id', $id)
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                      ->orWhere('receiver_id', Auth::id());
            })
            ->firstOrFail();

        // Delete the relationship record
        $connection->delete();

        return back()->with('success', 'The team member has been removed successfully.');
    }
}