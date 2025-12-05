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
            $table->json('name'); // Translatable field
            $table->string('slug')->unique();
            $table->enum('type', ['academy', 'competition']);
            $table->enum('delivery_type', ['online_zoom', 'online_course'])->default('online_course');
            $table->boolean('status')->default(true); // true = active, false = closed
            $table->json('description'); // Translatable field
            $table->json('syllabus')->nullable(); // Translatable syllabus content
            $table->string('meeting_link')->nullable();
            $table->decimal('fees', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('slug');
            $table->index('status');
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
