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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name', 255);
            $table->string('slug')->unique();
            $table->enum('type', ['academy', 'competition']);
            $table->enum('delivery_type', ['online_zoom', 'online_course'])->default('online_course');
            $table->boolean('status')->default(true);
            $table->text('description');
            $table->text('syllabus')->nullable();
            $table->string('meeting_link')->nullable();
            $table->decimal('fees', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('creator_id');
            $table->index('slug');
            $table->index('status');
            $table->index(['status', 'type'], 'programs_status_type_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
