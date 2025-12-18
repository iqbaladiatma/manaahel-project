<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gallery;

class DebugVideoIssues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debug video playback issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎬 Video Debug Analysis');
        $this->newLine();

        // Get all videos
        $videos = Gallery::where('file_type', 'video')->get();
        
        if ($videos->isEmpty()) {
            $this->warn('No videos found in database');
            return 0;
        }

        $this->info("Found {$videos->count()} videos:");
        $this->newLine();

        foreach ($videos as $video) {
            $this->line("📹 {$video->title}");
            $this->line("   URL: {$video->file_path}");
            
            // Analyze URL
            $this->analyzeVideoUrl($video->file_path);
            $this->newLine();
        }

        // Recommendations
        $this->info('💡 Recommendations:');
        $this->line('1. Test videos manually: open URLs in browser');
        $this->line('2. Use debug page: debug-video.html');
        $this->line('3. Check browser console for errors');
        $this->line('4. Try different video formats');
        
        return 0;
    }

    private function analyzeVideoUrl($url)
    {
        // Check if URL is accessible
        if (empty($url)) {
            $this->line('   ❌ Empty URL');
            return;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->line('   ❌ Invalid URL format');
            return;
        }

        $this->line('   ✅ Valid URL format');

        // Check if Cloudinary
        if (str_contains($url, 'cloudinary.com')) {
            $this->line('   ✅ Cloudinary URL');
            
            // Check if video format
            if (str_contains($url, '/video/upload/')) {
                $this->line('   ✅ Video upload path');
            } else {
                $this->line('   ⚠️  Not video upload path');
            }
            
            // Extract file extension
            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
            if (in_array(strtolower($extension), ['mp4', 'webm', 'ogg', 'avi', 'mov'])) {
                $this->line("   ✅ Video extension: {$extension}");
            } else {
                $this->line("   ⚠️  Unknown extension: {$extension}");
            }
        } else {
            $this->line('   ⚠️  Not Cloudinary URL');
        }

        // Test URL accessibility (basic check)
        $this->line('   🔍 Testing URL accessibility...');
        
        try {
            $headers = get_headers($url, 1);
            if ($headers && strpos($headers[0], '200') !== false) {
                $this->line('   ✅ URL accessible (HTTP 200)');
            } else {
                $this->line('   ❌ URL not accessible: ' . ($headers[0] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            $this->line('   ⚠️  Cannot test URL: ' . $e->getMessage());
        }
    }
}
