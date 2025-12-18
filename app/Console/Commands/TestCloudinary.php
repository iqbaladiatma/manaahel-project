<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TestCloudinary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudinary:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Cloudinary connection and configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Cloudinary connection...');
        
        try {
            // Test basic configuration
            $cloudName = config('cloudinary.cloud_url');
            if (empty($cloudName)) {
                $this->error('Cloudinary configuration not found in .env file');
                $this->info('Please set CLOUDINARY_CLOUD_NAME, CLOUDINARY_API_KEY, and CLOUDINARY_API_SECRET');
                return 1;
            }
            
            $this->info('✓ Cloudinary configuration found');
            
            // Test connection
            $result = Cloudinary::admin()->ping();
            
            if (isset($result['status']) && $result['status'] === 'ok') {
                $this->info('✓ Cloudinary connection successful!');
                
                // Get account info
                $usage = Cloudinary::admin()->usage();
                if (isset($usage['plan'])) {
                    $this->info("✓ Account Plan: " . $usage['plan']);
                    $this->info("✓ Storage Used: " . number_format($usage['storage']['usage'] / 1024 / 1024, 2) . " MB");
                    $this->info("✓ Bandwidth Used: " . number_format($usage['bandwidth']['usage'] / 1024 / 1024, 2) . " MB");
                }
                
                $this->info('');
                $this->info('Cloudinary is ready to use! 🎉');
                $this->info('You can now upload images and videos to the gallery.');
                
                return 0;
            } else {
                $this->error('✗ Cloudinary connection failed');
                return 1;
            }
            
        } catch (\Exception $e) {
            $this->error('✗ Cloudinary connection error: ' . $e->getMessage());
            $this->info('');
            $this->info('Please check your Cloudinary credentials in .env file:');
            $this->info('- CLOUDINARY_CLOUD_NAME');
            $this->info('- CLOUDINARY_API_KEY');
            $this->info('- CLOUDINARY_API_SECRET');
            $this->info('- CLOUDINARY_URL');
            
            return 1;
        }
    }
}
