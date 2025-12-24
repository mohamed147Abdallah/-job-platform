<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    /**
     * Display the list of conversations (Inbox).
     * Conversations are ordered so that the most recently updated ones appear first.
     */
    public function index()
    {
        $userId = Auth::id();

        $conversations = Conversation::where('founder_id', $userId)
            ->orWhere('freelancer_id', $userId)
            ->with(['job', 'founder', 'freelancer', 'messages' => function($q) {
                $q->latest()->limit(1); // Fetch only the latest message for preview in the list
            }])
            ->orderBy('updated_at', 'desc') 
            ->get();

        return view('chat.index', compact('conversations'));
    }

    /**
     * Display a specific conversation and mark incoming messages as "read".
     */
    public function show($id)
    {
        $conversation = Conversation::with(['messages.sender', 'founder', 'freelancer', 'job'])
            ->findOrFail($id);

        // Security: Ensure the user is a participant in this conversation
        abort_unless(
            $conversation->founder_id === Auth::id() ||
            $conversation->freelancer_id === Auth::id(),
            403,
            'You are not authorized to view this chat.'
        );

        // Mark received messages as read immediately upon viewing
        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('chat.show', compact('conversation'));
    }

    /**
     * Start a new conversation or retrieve an existing one when clicking "Message".
     */
    public function startWithUser($userId)
    {
        $myId = Auth::id();
        
        // Security: Prevent users from starting a chat with themselves
        if ((int)$myId === (int)$userId) {
            return back()->with('error', 'You cannot start a chat with yourself.');
        }

        $otherUser = User::findOrFail($userId);

        // Determine roles to ensure IDs are stored in the correct columns
        $founderId = Auth::user()->role === 'founder' ? $myId : $userId;
        $freelancerId = Auth::user()->role === 'freelancer' ? $myId : $userId;

        // Check if a conversation already exists between the two parties
        $conversation = Conversation::where('founder_id', $founderId)
            ->where('freelancer_id', $freelancerId)
            ->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = Conversation::create([
                'founder_id' => $founderId,
                'freelancer_id' => $freelancerId,
                'job_id' => null, // General conversation
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    /**
     * Send a new message (text and/or attachment).
     */
    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string|max:5000',
            'attachment' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,pdf,zip,doc,docx', 
        ]);

        $conversation = Conversation::findOrFail($id);
        
        $filePath = null;

        // Process attachment if present (stored in public disk)
        if ($request->hasFile('attachment')) {
            $filePath = $request->file('attachment')->store('chat_attachments', 'public');
        }

        // Clean up message content: ensure it is not just whitespace
        $messageContent = $request->filled('message') ? trim($request->message) : null;

        // Prevent sending an entirely empty record (no text and no file)
        if (is_null($messageContent) && is_null($filePath)) {
            return back()->with('error', 'Message cannot be empty.');
        }

        // Create the message in the database
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $messageContent,
            'file_path' => $filePath,
            'is_read' => false,
        ]);

        // Update conversation timestamp to move it to the top of the inbox
        $conversation->touch();

        return back();
    }

    /**
     * Optional Feature: Delete a specific message.
     */
    public function destroyMessage($messageId)
    {
        $message = Message::where('id', $messageId)
            ->where('sender_id', Auth::id()) // Users can only delete their own messages
            ->firstOrFail();

        // Remove the file from storage if it exists
        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }

        $message->delete();

        return back()->with('success', 'Message deleted.');
    }
}