<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Updated to be "self-healing": creates the table if missing, or modifies it if it exists.
     */
    public function up(): void
    {
        // 1. If the table does not exist at all, create it with the complete schema
        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->foreignId('conversation_id')->constrained()->cascadeOnDelete();
                $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
                $table->text('message')->nullable(); // Nullable to allow sending attachments/images without text
                $table->boolean('is_read')->default(false);
                $table->string('file_path')->nullable();
                $table->timestamps();
            });
        } 
        // 2. If the table exists, add missing columns and modify attributes
        else {
            Schema::table('messages', function (Blueprint $table) {
                // Modify 'message' column to allow NULL values
                if (Schema::hasColumn('messages', 'message')) {
                    $table->text('message')->nullable()->change();
                }

                // Add 'is_read' column if it doesn't exist
                if (!Schema::hasColumn('messages', 'is_read')) {
                    $table->boolean('is_read')->default(false)->after('message');
                }

                // Add 'file_path' column if it doesn't exist
                if (!Schema::hasColumn('messages', 'file_path')) {
                    $table->string('file_path')->nullable()->after('is_read');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     * Secured to prevent "Data truncated" errors by sanitizing NULL values before reverting nullability.
     */
    public function down(): void
    {
        if (Schema::hasTable('messages')) {
            
            // Crucial: Convert any existing NULL values to empty strings before making the column NOT NULL
            if (Schema::hasColumn('messages', 'message')) {
                DB::table('messages')->whereNull('message')->update(['message' => '']);
                
                Schema::table('messages', function (Blueprint $table) {
                    $table->text('message')->nullable(false)->change();
                });
            }

            // Drop columns added by this migration if they exist
            Schema::table('messages', function (Blueprint $table) {
                $columnsToDrop = [];
                if (Schema::hasColumn('messages', 'is_read')) $columnsToDrop[] = 'is_read';
                if (Schema::hasColumn('messages', 'file_path')) $columnsToDrop[] = 'file_path';

                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};