<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add custom profile fields to the users table.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Company name column (primarily for Founders)
            if (!Schema::hasColumn('users', 'company_name')) {
                $table->string('company_name')->nullable();
            }

            // 2. Specialization column (primarily for Freelancers)
            if (!Schema::hasColumn('users', 'specialization')) {
                $table->string('specialization')->nullable();
            }

            // 3. Skills column stored as JSON
            if (!Schema::hasColumn('users', 'skills')) {
                $table->json('skills')->nullable();
            }

            // 4. Profile image path column
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations safely.
     * Safeguards the rollback process to prevent "Column not found" errors.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Collect columns to drop and verify their existence first
            $columnsToDrop = [];
            
            if (Schema::hasColumn('users', 'company_name')) {
                $columnsToDrop[] = 'company_name';
            }
            if (Schema::hasColumn('users', 'specialization')) {
                $columnsToDrop[] = 'specialization';
            }
            if (Schema::hasColumn('users', 'skills')) {
                $columnsToDrop[] = 'skills';
            }
            if (Schema::hasColumn('users', 'profile_image')) {
                $columnsToDrop[] = 'profile_image';
            }

            // Drop only the columns that actually exist in the table
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};