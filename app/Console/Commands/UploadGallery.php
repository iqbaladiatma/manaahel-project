<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UploadGallery extends Command
{
    protected $signature = 'gallery:upload {user_id} {image_path} {title} {--description=}';
    protected $description = 'Upload gallery image for a user';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $imagePath = $this->argument('image_path');
        $title = $this->argument('title');
        $description = $this->option('description');

        // Check if user exists
        $user = User::find($userId);
        if (!$user) {
            $this->error("User with ID {$userId} not found!");
            return 1;
        }

        // Check if image file exists
        if (!File::exists($imagePath)) {
            $this->error("Image file not found: {$imagePath}");
            return 1;
        }

        // Generate unique filename
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $filename = Str::ulid() . '.' . $extension;
        $destination = storage_path('app/public/gallery/' . $filename);

        // Copy file
        File::copy($imagePath, $destination);

        // Create gallery record
        $gallery = Gallery::create([
            'user_id' => $user->id,
            'title' => [
                'id' => $title,
                'en' => $title,
            ],
            'description' => $description,
            'file_path' => 'gallery/' . $filename,
            'batch_filter' => $user->batch_year,
            'visibility' => 'public',
        ]);

        $this->info("Gallery uploaded successfully!");
        $this->info("Gallery ID: {$gallery->id}");
        $this->info("File: {$filename}");

        return 0;
    }
}
