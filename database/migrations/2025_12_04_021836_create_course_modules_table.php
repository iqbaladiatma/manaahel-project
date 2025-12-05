<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->json('title'); // Translatable field
            $table->json('description')->nullable(); // Translatable field
            $table->string('video_url')->nullable();
            $table->json('content')->nullable(); // Translatable field
            $table->integer('order')->default(0);
            $table->integer('duration_minutes')->nullable(); // Duration in minutes
            $table->boolean('is_published')->default(true);
            $table->enum('delivery_type', ['online_course', 'live_session'])->default('online_course');
            $table->string('meeting_link')->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('course_id');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_modules');
    }
};
