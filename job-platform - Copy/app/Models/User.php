<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Includes profile information, role-specific fields, and skill sets.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
        'specialization',
        'skills',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Modern Laravel approach for attribute casting.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Automatically handles password hashing
            'skills' => 'array',    // Automatically converts JSON skills to a PHP array
        ];
    }

    /**
     * Custom Accessor to retrieve the full profile image URL.
     * Returns a default placeholder if no image is uploaded.
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }

        // Default placeholder image
        return asset('images/default-profile.png');
    }
}