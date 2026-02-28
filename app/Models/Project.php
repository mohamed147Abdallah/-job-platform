<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Includes 'user_id' to associate the project with its creator.
     */
    protected $fillable = [
        'user_id', 
        'title',
        'description',
        'link',
    ];

    /**
     * Relationship: The user (Founder or Freelancer) who owns this project.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}