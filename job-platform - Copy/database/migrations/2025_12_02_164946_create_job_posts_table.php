<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create the job posts table.
     */
    public function up(): void
    {
        // Drop the existing table to ensure it is recreated with new columns (Development phase only)
        Schema::dropIfExists('job_posts');

        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            
            // Foreign key relationship to the users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->string('title');
            $table->text('description');
            $table->string('budget')->nullable();
            
            // Job classification (e.g., freelance, full-time)
            $table->string('type')->default('freelance'); 
            
            // Geographical location metadata
            $table->string('location_type')->default('remote'); // remote, on_site, hybrid
            $table->string('location')->nullable();      // City/Country name
            $table->string('map_link')->nullable();      // Google Maps URL
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude coordinate
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude coordinate

            // Current job availability status
            $table->enum('status', ['open', 'closed', 'in_progress'])->default('open');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};