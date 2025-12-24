<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to modify the messages table.
     * Enhances the table by allowing null messages (for attachments), 
     * and adding columns for read status and file paths.
     */
    public function up(): void
    {
        // Check if the messages table exists before proceeding
        if (Schema::hasTable('messages')) {
            Schema::table('messages', function (Blueprint $table) {
                
                // 1. Modify the 'message' column to allow null values (required for file-only messages)
                if (Schema::hasColumn('messages', 'message')) {
                    $table->text('message')->nullable()->change();
                }

                // 2. Add the 'is_read' boolean column to track message status
                if (!Schema::hasColumn('messages', 'is_read')) {
                    $table->boolean('is_read')->default(false)->after('message');
                }

                // 3. Add the 'file_path' column to store attachment locations
                if (!Schema::hasColumn('messages', 'file_path')) {
                    $table->string('file_path')->nullable()->after('is_read');
                }
            });
        }
    }

    /**
     * Reverse the migrations by reverting column changes and dropping added columns.
     */
    public function down(): void
    {
        if (Schema::hasTable('messages')) {
            // Sanitize the data: replace null messages with empty strings before reverting nullability
            if (Schema::hasColumn('messages', 'message')) {
                DB::table('messages')->whereNull('message')->update(['message' => '']);
            }

            Schema::table('messages', function (Blueprint $table) {
                // Revert the message column to NOT NULL
                if (Schema::hasColumn('messages', 'message')) {
                    $table->text('message')->nullable(false)->change();
                }

                // Identify columns to drop
                $columnsToDrop = [];
                if (Schema::hasColumn('messages', 'is_read')) $columnsToDrop[] = 'is_read';
                if (Schema::hasColumn('messages', 'file_path')) $columnsToDrop[] = 'file_path';

                // Drop the columns if they exist
                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};