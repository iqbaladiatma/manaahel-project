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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->json('title'); // Translatable field
            $table->json('description')->nullable(); // Translatable field
            $table->string('slug');
            $table->integer('order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('program_id');
            $table->index('order');
            $table->unique(['program_id', 'slug']); // Unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
