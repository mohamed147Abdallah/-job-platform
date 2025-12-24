<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkRequest extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'work_requests';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'job_id',
        'type',
        'status',
    ];

    /**
     * Relationship: The user who initiated the request.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Relationship: The user who is the recipient of the request.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Relationship: The specific job or position associated with this request.
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}