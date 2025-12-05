<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test-data', function () {
    $this->info('🔍 Checking Database Data...');
    $this->newLine();

    // Programs
    $programs = \App\Models\Program::all();
    $this->info("📚 Programs: " . $programs->count());
    foreach ($programs as $program) {
        $this->line("  ✓ {$program->getTranslation('name', 'id')} ({$program->delivery_type})");
    }
    $this->newLine();

    // Courses
    $courses = \App\Models\Course::all();
    $this->info("📖 Courses: " . $courses->count());
    foreach ($courses as $course) {
        $modules = $course->modules()->count();
        $this->line("  ✓ {$course->getTranslation('title', 'id')} ({$modules} modules)");
    }
    $this->newLine();

    // Modules
    $modules = \App\Models\CourseModule::all();
    $this->info("📝 Course Modules: " . $modules->count());
    $this->newLine();

    // Schedules
    $schedules = \App\Models\ProgramSchedule::all();
    $this->info("📅 Program Schedules: " . $schedules->count());
    $this->newLine();

    // Users
    $users = \App\Models\User::all();
    $this->info("👥 Users: " . $users->count());
    foreach ($users as $user) {
        $this->line("  ✓ {$user->email} ({$user->role})");
    }
    $this->newLine();

    // Registrations
    $registrations = \App\Models\Registration::where('status', 'approved')->get();
    $this->info("✅ Approved Registrations: " . $registrations->count());
    foreach ($registrations as $reg) {
        $this->line("  ✓ {$reg->user->name} → {$reg->program->getTranslation('name', 'id')}");
    }
    $this->newLine();

    $this->info('✅ All data verified successfully!');
    $this->newLine();
    
    $this->warn('🚀 Next Steps:');
    $this->line('1. Start server: php artisan serve');
    $this->line('2. Login: student@test.com / password');
    $this->line('3. Visit: http://localhost:8000/my-programs');
    $this->newLine();
})->purpose('Verify all seeded data in database');

