<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\WorkRequest;

class Job extends Model
{
    /**
     * Explicitly define the table name as 'job_posts'.
     */
    protected $table = 'job_posts';

    /**
     * The attributes that are mass assignable.
     * Includes core job details and location-based metadata.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'budget',
        'status',
        'type',           // Job type (e.g., full_time, freelance)
        'location_type',  // (e.g., remote, on_site)
        'location',       // Physical location name
        'map_link',       // External map URL
        'latitude',       // GPS coordinates (Latitude)
        'longitude',      // GPS coordinates (Longitude)
    ];

    /**
     * Relationship: The user who posted the job (Job Owner).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: All work requests associated with this job.
     */
    public function requests()
    {
        return $this->hasMany(WorkRequest::class, 'job_id');
    }

    /**
     * Relationship: Only accepted work requests linked to this job.
     * Useful for displaying the current hired team or active status.
     */
    public function acceptedRequests()
    {
        return $this->requests()->where('status', 'accepted');
    }
}