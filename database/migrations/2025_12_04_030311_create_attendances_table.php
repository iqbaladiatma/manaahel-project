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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_schedule_id')->constrained()->onDelete('cascade');
            $table->timestamp('attended_at')->nullable();
            $table->string('status')->default('present'); // present, absent
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'program_schedule_id']);
            $table->unique(['user_id', 'program_schedule_id']); // One attendance per user per schedule
        });

        // Add attendance_enabled to program_schedules
        Schema::table('program_schedules', function (Blueprint $table) {
            $table->boolean('attendance_enabled')->default(false)->after('duration_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
        
        Schema::table('program_schedules', function (Blueprint $table) {
            $table->dropColumn('attendance_enabled');
        });
    }
};
