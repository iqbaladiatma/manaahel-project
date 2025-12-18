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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('cloudinary_public_id')->nullable();
            $table->enum('file_type', ['image', 'video'])->default('image');
            $table->string('folder')->nullable(); // Only folder, no category
            $table->string('batch_filter')->nullable();
            $table->enum('visibility', ['public', 'member_only'])->default('public');
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('folder');
            $table->index('visibility');
            $table->index('batch_filter');
            $table->index(['visibility', 'batch_filter'], 'galleries_visibility_batch_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};