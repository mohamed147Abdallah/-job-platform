<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_requests', function (Blueprint $table) {
            $table->id();
            
            // ✅ FIX: إضافة job_id لربط الطلب بالوظيفة (يشير إلى job_posts)
            // استخدام nullable يسمح بوجود طلبات لا ترتبط بوظيفة محددة (مثل طلب تواصل عام)
            $table->foreignId('job_id')->nullable()->constrained('job_posts')->onDelete('cascade'); 
            
            // المرسل (ممكن يكون فاوندر أو فريلانسر)
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            // المستقبل
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            
            // نوع الطلب (دعوة للعمل، أو طلب تواصل)
            $table->string('type')->default('invitation'); // invitation, connection
            
            // حالة الطلب
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_requests');
    }
};