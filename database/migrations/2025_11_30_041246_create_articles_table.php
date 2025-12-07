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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->longText('content');
            $table->string('image_url')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->string('slug')->unique();
            $table->timestamps();
            
            // Indexes
            $table->index('category_id');
            $table->index('author_id');
            $table->index('is_featured');
            $table->index(['category_id', 'is_featured'], 'articles_category_featured_index');
            $table->index(['is_featured', 'created_at'], 'articles_featured_created_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
