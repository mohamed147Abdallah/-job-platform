<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Conversation;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     * Includes metadata for attachments and message read status.
     */
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'file_path',
        'is_read',
    ];

    /**
     * Relationship: The user who sent this specific message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relationship: The conversation this message belongs to.
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}