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
        // Add composite index for registrations by user and status
        Schema::table('registrations', function (Blueprint $table) {
            $table->index(['user_id', 'status'], 'registrations_user_status_index');
            $table->index(['program_id', 'status'], 'registrations_program_status_index');
        });

        // Add composite index for articles by category and featured status
        Schema::table('articles', function (Blueprint $table) {
            $table->index(['category_id', 'is_featured'], 'articles_category_featured_index');
            $table->index(['is_featured', 'created_at'], 'articles_featured_created_index');
        });

        // Add index for galleries by visibility and batch
        Schema::table('galleries', function (Blueprint $table) {
            $table->index(['visibility', 'batch_filter'], 'galleries_visibility_batch_index');
        });

        // Add index for programs by status and type
        Schema::table('programs', function (Blueprint $table) {
            $table->index(['status', 'type'], 'programs_status_type_index');
        });

        // Add index for users with location data
        Schema::table('users', function (Blueprint $table) {
            $table->index(['role', 'batch_year'], 'users_role_batch_index');
        });

        // Add index for courses by program
        Schema::table('courses', function (Blueprint $table) {
            $table->index(['program_id', 'created_at'], 'courses_program_created_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropIndex('registrations_user_status_index');
            $table->dropIndex('registrations_program_status_index');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('articles_category_featured_index');
            $table->dropIndex('articles_featured_created_index');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex('galleries_visibility_batch_index');
        });

        Schema::table('programs', function (Blueprint $table) {
            $table->dropIndex('programs_status_type_index');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_role_batch_index');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropIndex('courses_program_created_index');
        });
    }
};
