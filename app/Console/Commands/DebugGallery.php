<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gallery;
use App\Models\User;

class DebugGallery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gallery:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug gallery system and show current status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Gallery System Debug');
        $this->newLine();

        // Check database
        $this->info('📊 Database Status:');
        $galleryCount = Gallery::count();
        $this->line("  ✓ Total gallery items: {$galleryCount}");
        
        $adminCount = User::where('role', 'admin')->count();
        $this->line("  ✓ Admin users: {$adminCount}");
        
        $memberCount = User::where('role', 'member_angkatan')->count();
        $this->line("  ✓ Member angkatan: {$memberCount}");
        
        $this->newLine();

        // Show recent gallery items
        $this->info('📸 Recent Gallery Items:');
        $recentItems = Gallery::orderBy('created_at', 'desc')->take(5)->get();
        
        if ($recentItems->isEmpty()) {
            $this->line("  ⚠ No gallery items found");
        } else {
            foreach ($recentItems as $item) {
                $type = $item->file_type ?? 'unknown';
                $visibility = $item->visibility ?? 'unknown';
                $url = strlen($item->file_path) > 50 ? substr($item->file_path, 0, 50) . '...' : $item->file_path;
                $this->line("  • [{$type}] {$item->title} ({$visibility}) - {$url}");
            }
        }
        
        $this->newLine();

        // Check routes
        $this->info('🛣 Routes Status:');
        $routes = [
            'gallery.index' => '/gallery',
            'gallery.cloudinary.create' => '/gallery/cloudinary/add',
            'gallery.cloudinary.store' => 'POST /gallery/cloudinary/add',
            'gallery.cloudinary.bulk' => '/gallery/cloudinary/bulk',
        ];
        
        foreach ($routes as $name => $path) {
            try {
                $url = route($name);
                $this->line("  ✓ {$name}: {$path}");
            } catch (\Exception $e) {
                $this->line("  ✗ {$name}: ERROR - {$e->getMessage()}");
            }
        }
        
        $this->newLine();

        // Test URL validation
        $this->info('🔗 URL Validation Test:');
        $testUrls = [
            'https://res.cloudinary.com/demo/image/upload/sample.jpg',
            'https://res.cloudinary.com/demo/video/upload/sample.mp4',
            'invalid-url',
            'http://example.com/image.jpg'
        ];
        
        foreach ($testUrls as $url) {
            $isValid = filter_var($url, FILTER_VALIDATE_URL) !== false;
            $isCloudinary = str_contains($url, 'cloudinary.com');
            $status = $isValid ? ($isCloudinary ? '✓ Valid Cloudinary' : '⚠ Valid but not Cloudinary') : '✗ Invalid';
            $this->line("  {$status}: {$url}");
        }
        
        $this->newLine();

        // Show admin users
        $this->info('👤 Admin Users:');
        $admins = User::where('role', 'admin')->get();
        if ($admins->isEmpty()) {
            $this->line("  ⚠ No admin users found!");
            $this->line("  💡 Create admin user: php artisan make:filament-user");
        } else {
            foreach ($admins as $admin) {
                $this->line("  • {$admin->name} ({$admin->email})");
            }
        }
        
        $this->newLine();

        // Quick test
        $this->info('🧪 Quick Test:');
        $this->line("  1. Login as admin: " . ($adminCount > 0 ? "✓ Available" : "✗ No admin users"));
        $this->line("  2. Visit gallery: http://localhost:8000/gallery");
        $this->line("  3. Look for '+ Cloudinary' button (orange)");
        $this->line("  4. Test URL: https://res.cloudinary.com/demo/image/upload/sample.jpg");
        
        $this->newLine();
        $this->info('🎯 Next Steps:');
        $this->line("  • Make sure you're logged in as admin");
        $this->line("  • Use a valid Cloudinary URL");
        $this->line("  • Check browser console for JavaScript errors");
        $this->line("  • Check Laravel logs: storage/logs/laravel.log");
        
        return 0;
    }
}
