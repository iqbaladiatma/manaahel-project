<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Gallery;
use App\Services\CloudinaryService;

class ImportCloudinaryMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudinary:import {--folder=manaahel/gallery : Folder path in Cloudinary} {--limit=100 : Maximum number of files to import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import existing media from Cloudinary to gallery';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folder = $this->option('folder');
        $limit = (int) $this->option('limit');
        
        $this->info("Importing media from Cloudinary folder: {$folder}");
        $this->info("Limit: {$limit} files");
        $this->newLine();

        try {
            // For demo purposes, we'll use sample URLs since Cloudinary API requires setup
            // In production, you would use the actual Cloudinary API calls
            
            $this->info('🔍 Scanning for Cloudinary media...');
            
            // Sample media for demo - replace with actual Cloudinary API calls
            $sampleMedia = [
                [
                    'public_id' => 'sample_1',
                    'secure_url' => 'https://res.cloudinary.com/demo/image/upload/sample.jpg',
                    'resource_type' => 'image',
                    'created_at' => now()->toISOString(),
                ],
                [
                    'public_id' => 'woman_1', 
                    'secure_url' => 'https://res.cloudinary.com/demo/image/upload/woman.jpg',
                    'resource_type' => 'image',
                    'created_at' => now()->toISOString(),
                ],
                [
                    'public_id' => 'sample_video',
                    'secure_url' => 'https://res.cloudinary.com/demo/video/upload/sample.mp4',
                    'resource_type' => 'video',
                    'created_at' => now()->toISOString(),
                ],
            ];
            
            // Filter by limit
            $allMedia = array_slice($sampleMedia, 0, $limit);
            
            if (empty($allMedia)) {
                $this->warn('No media found. In production, this would connect to your Cloudinary account.');
                $this->info('To use real Cloudinary API:');
                $this->info('1. Set up CLOUDINARY_* environment variables');
                $this->info('2. Uncomment the actual API calls in this command');
                return 0;
            }

            $this->info('Found ' . count($allMedia) . ' media files (demo data)');
            $this->newLine();

            $imported = 0;
            $skipped = 0;

            foreach ($allMedia as $media) {
                $publicId = $media['public_id'];
                
                // Check if already exists in database
                $existing = Gallery::where('cloudinary_public_id', $publicId)->first();
                if ($existing) {
                    $this->line("Skipped: {$publicId} (already exists)");
                    $skipped++;
                    continue;
                }

                // Determine file type
                $fileType = $media['resource_type'] === 'video' ? 'video' : 'image';
                
                // Generate title from filename
                $filename = basename($publicId);
                $title = $this->generateTitleFromFilename($filename);
                
                // Create gallery entry
                Gallery::create([
                    'user_id' => null,
                    'title' => $title,
                    'description' => 'Imported from Cloudinary',
                    'file_path' => $media['secure_url'],
                    'cloudinary_public_id' => $publicId,
                    'file_type' => $fileType,
                    'batch_filter' => null,
                    'visibility' => 'public',
                    'created_at' => isset($media['created_at']) ? 
                        \Carbon\Carbon::parse($media['created_at']) : now(),
                ]);

                $this->info("✓ Imported: {$title} ({$fileType})");
                $imported++;
            }

            $this->newLine();
            $this->info("Import completed!");
            $this->info("✓ Imported: {$imported} files");
            $this->info("⚠ Skipped: {$skipped} files (already exist)");

            if ($imported > 0) {
                $this->info("Visit your gallery to see the imported media: " . url('/gallery'));
            }
            
            $this->newLine();
            $this->comment('💡 Note: This is demo data. For production:');
            $this->comment('1. Configure Cloudinary API credentials');
            $this->comment('2. Enable real API calls in ImportCloudinaryMedia command');

        } catch (\Exception $e) {
            $this->error('Error importing from Cloudinary: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Generate a readable title from filename
     */
    private function generateTitleFromFilename($filename)
    {
        // Remove extension
        $title = pathinfo($filename, PATHINFO_FILENAME);
        
        // Replace underscores and hyphens with spaces
        $title = str_replace(['_', '-'], ' ', $title);
        
        // Remove common prefixes like "gallery_", "IMG_", etc.
        $title = preg_replace('/^(gallery|img|photo|video|pic)[\s_-]*/i', '', $title);
        
        // Remove timestamps and random strings
        $title = preg_replace('/\d{10,}/', '', $title);
        $title = preg_replace('/[a-f0-9]{8,}/', '', $title);
        
        // Clean up extra spaces
        $title = trim(preg_replace('/\s+/', ' ', $title));
        
        // Capitalize first letter of each word
        $title = ucwords(strtolower($title));
        
        // If title is empty or too short, use a default
        if (empty($title) || strlen($title) < 3) {
            $title = 'Media Gallery';
        }
        
        return $title;
    }
}
