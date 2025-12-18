<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gallery;

class CleanGalleryData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gallery:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean gallery data - convert JSON titles to string';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Cleaning gallery data...');
        
        $galleries = Gallery::all();
        $updated = 0;
        
        foreach ($galleries as $gallery) {
            $originalTitle = $gallery->title;
            
            // Check if title is JSON/array format
            if (is_string($originalTitle) && $this->isJson($originalTitle)) {
                $titleArray = json_decode($originalTitle, true);
                $newTitle = $titleArray['id'] ?? $titleArray['en'] ?? $titleArray['ar'] ?? 'Untitled';
                
                $gallery->title = $newTitle;
                $gallery->save();
                
                $this->line("✓ Updated: {$originalTitle} → {$newTitle}");
                $updated++;
            } elseif (is_array($originalTitle)) {
                $newTitle = $originalTitle['id'] ?? $originalTitle['en'] ?? $originalTitle['ar'] ?? 'Untitled';
                
                $gallery->title = $newTitle;
                $gallery->save();
                
                $this->line("✓ Updated array title → {$newTitle}");
                $updated++;
            } else {
                $this->line("- Skipped: {$originalTitle} (already string)");
            }
        }
        
        $this->newLine();
        $this->info("✅ Cleaned {$updated} gallery items");
        $this->info("📊 Total galleries: " . $galleries->count());
        
        return 0;
    }
    
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
