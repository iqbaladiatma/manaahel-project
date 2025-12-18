<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ListCloudinaryMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudinary:list {--folder= : Specific folder to list} {--limit=50 : Maximum number of files to show}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all media files in Cloudinary';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folder = $this->option('folder');
        $limit = (int) $this->option('limit');
        
        $this->info('Listing media from Cloudinary...');
        if ($folder) {
            $this->info("Folder: {$folder}");
        }
        $this->info("Limit: {$limit}");
        $this->newLine();

        try {
            // Get images
            $this->info('📸 IMAGES:');
            $images = Cloudinary::admin()->assets([
                'type' => 'upload',
                'prefix' => $folder,
                'resource_type' => 'image',
                'max_results' => $limit
            ]);

            if (!empty($images['resources'])) {
                foreach ($images['resources'] as $image) {
                    $size = isset($image['bytes']) ? $this->formatBytes($image['bytes']) : 'Unknown';
                    $created = isset($image['created_at']) ? 
                        \Carbon\Carbon::parse($image['created_at'])->format('Y-m-d H:i') : 'Unknown';
                    
                    $this->line("  ✓ {$image['public_id']} ({$size}) - {$created}");
                }
            } else {
                $this->line("  No images found");
            }

            $this->newLine();

            // Get videos
            $this->info('🎥 VIDEOS:');
            $videos = Cloudinary::admin()->assets([
                'type' => 'upload',
                'prefix' => $folder,
                'resource_type' => 'video',
                'max_results' => $limit
            ]);

            if (!empty($videos['resources'])) {
                foreach ($videos['resources'] as $video) {
                    $size = isset($video['bytes']) ? $this->formatBytes($video['bytes']) : 'Unknown';
                    $duration = isset($video['duration']) ? 
                        gmdate("H:i:s", $video['duration']) : 'Unknown';
                    $created = isset($video['created_at']) ? 
                        \Carbon\Carbon::parse($video['created_at'])->format('Y-m-d H:i') : 'Unknown';
                    
                    $this->line("  ✓ {$video['public_id']} ({$size}, {$duration}) - {$created}");
                }
            } else {
                $this->line("  No videos found");
            }

            $this->newLine();
            
            $totalImages = count($images['resources'] ?? []);
            $totalVideos = count($videos['resources'] ?? []);
            $total = $totalImages + $totalVideos;
            
            $this->info("Total: {$total} files ({$totalImages} images, {$totalVideos} videos)");
            
            if ($total > 0) {
                $this->newLine();
                $this->info("To import these files to your gallery, run:");
                if ($folder) {
                    $this->line("php artisan cloudinary:import --folder={$folder}");
                } else {
                    $this->line("php artisan cloudinary:import");
                }
            }

        } catch (\Exception $e) {
            $this->error('Error listing Cloudinary media: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}