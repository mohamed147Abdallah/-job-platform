<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to create skills and their associated pivot tables.
     */
    public function up(): void
    {
        // Table for storing unique skills and their optional descriptions
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable(); 
            $table->timestamps();
        });

        // Pivot table for the many-to-many relationship between specializations and skills
        Schema::create('skill_specialization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialization_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table for the many-to-many relationship between users and their chosen skills
        Schema::create('skill_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations by dropping the tables in correct order.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_user');
        Schema::dropIfExists('skill_specialization');
        Schema::dropIfExists('skills');
    }
};