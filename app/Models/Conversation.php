<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\User;
use App\Models\Message;

class Conversation extends Model
{
    /**
     * Explicitly define the table name if it differs from the default plural form.
     */
    protected $table = 'conversations';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'job_id',
        'founder_id',
        'freelancer_id',
    ];

    /**
     * Relationship: The founder (job owner) participating in the conversation.
     */
    public function founder()
    {
        return $this->belongsTo(User::class, 'founder_id');
    }

    /**
     * Relationship: The freelancer participating in the conversation.
     */
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    /**
     * Relationship: The job linked to this specific chat.
     * Laravel will automatically use the job_id foreign key.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Relationship: All messages linked to this conversation.
     * Assumes the messages table contains a conversation_id foreign key.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}