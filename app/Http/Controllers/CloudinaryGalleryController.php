<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class CloudinaryGalleryController extends Controller
{
    /**
     * Show form to add Cloudinary media
     */
    public function create()
    {
        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only Admin can add Cloudinary media.');
        }

        return view('gallery.cloudinary-create');
    }

    /**
     * Store Cloudinary media
     */
    public function store(Request $request)
    {
        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only Admin can add Cloudinary media.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'cloudinary_url' => 'required|url',
            'file_type' => 'required|in:image,video',
            'cloudinary_public_id' => 'nullable|string|max:255',
            'member_id' => 'nullable|exists:users,id',
            'visibility' => 'required|in:public,member_only',
            'batch_filter' => 'nullable|integer|min:2020|max:2030',
        ]);

        // Determine user_id
        $userId = $request->filled('member_id') ? $validated['member_id'] : null;

        // Create gallery entry
        Gallery::create([
            'user_id' => $userId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $validated['cloudinary_url'],
            'cloudinary_public_id' => $validated['cloudinary_public_id'],
            'file_type' => $validated['file_type'],
            'batch_filter' => $validated['batch_filter'],
            'visibility' => $validated['visibility'],
        ]);

        return redirect()->route('gallery.index')
            ->with('success', 'Media Cloudinary berhasil ditambahkan ke galeri!');
    }

    /**
     * Bulk import from Cloudinary URLs
     */
    public function bulkCreate()
    {
        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only Admin can bulk import Cloudinary media.');
        }

        return view('gallery.cloudinary-bulk');
    }

    /**
     * Store bulk Cloudinary media
     */
    public function bulkStore(Request $request)
    {
        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only Admin can bulk import Cloudinary media.');
        }

        $validated = $request->validate([
            'media_list' => 'required|string',
            'default_visibility' => 'required|in:public,member_only',
            'default_batch_filter' => 'nullable|integer|min:2020|max:2030',
        ]);

        $mediaList = $validated['media_list'];
        $lines = explode("\n", $mediaList);
        $imported = 0;
        $errors = [];

        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Parse line: URL|title|description|type
            $parts = explode('|', $line);
            if (count($parts) < 2) {
                $errors[] = "Baris " . ($lineNumber + 1) . ": Format tidak valid";
                continue;
            }

            $url = trim($parts[0]);
            $title = trim($parts[1]);
            $description = isset($parts[2]) ? trim($parts[2]) : '';
            $type = isset($parts[3]) ? trim($parts[3]) : 'image';

            // Validate URL
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $errors[] = "Baris " . ($lineNumber + 1) . ": URL tidak valid";
                continue;
            }

            // Extract public_id from Cloudinary URL if possible
            $publicId = $this->extractPublicIdFromUrl($url);

            try {
                Gallery::create([
                    'user_id' => null,
                    'title' => $title,
                    'description' => $description,
                    'file_path' => $url,
                    'cloudinary_public_id' => $publicId,
                    'file_type' => in_array($type, ['image', 'video']) ? $type : 'image',
                    'batch_filter' => $validated['default_batch_filter'],
                    'visibility' => $validated['default_visibility'],
                ]);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Baris " . ($lineNumber + 1) . ": " . $e->getMessage();
            }
        }

        $message = "Berhasil import {$imported} media.";
        if (!empty($errors)) {
            $message .= " Errors: " . implode(', ', $errors);
        }

        return redirect()->route('gallery.index')->with('success', $message);
    }

    /**
     * Auto import from Cloudinary API
     */
    public function autoImport(Request $request)
    {
        // Check if user is admin
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only Admin can auto import Cloudinary media.');
        }

        $validated = $request->validate([
            'folder' => 'nullable|string|max:500',
            'limit' => 'required|integer|min:1|max:1000',
            'visibility' => 'required|in:public,member_only',
            'batch_filter' => 'nullable|integer|min:2020|max:2030',
            'target_folder' => 'nullable|string|max:100',
            'create_new_folder' => 'nullable|boolean',
            'new_folder_name' => 'nullable|string|max:100',
            'new_folder_description' => 'nullable|string|max:255',
        ]);

        // Handle folder creation if needed
        $targetFolder = $validated['target_folder'];
        
        if ($validated['create_new_folder'] && $validated['new_folder_name']) {
            $targetFolder = $validated['new_folder_name'];
            
            // Create new folder if it doesn't exist
            $folderExists = \App\Models\GalleryFolder::where('folder', $targetFolder)->exists();
                
            if (!$folderExists) {
                \App\Models\GalleryFolder::create([
                    'folder' => $targetFolder,
                    'description' => $validated['new_folder_description'] ?? 'Auto-created during import',
                    'created_by' => Auth::id()
                ]);
            }
        }

        // Extract folder name from Cloudinary URL if provided
        $folderName = $this->extractFolderFromUrl($validated['folder'] ?? '');

        try {
            // This would require Cloudinary API setup
            // For now, we'll create a simple version that works with manual URLs
            
            $imported = 0;
            $errors = [];
            
            // Sample implementation - in real scenario, you'd use Cloudinary API
            // For now, let's create a demo with some sample URLs
            $samplePhotos = [
                'https://res.cloudinary.com/demo/image/upload/sample.jpg',
                'https://res.cloudinary.com/demo/image/upload/woman.jpg', 
                'https://res.cloudinary.com/demo/image/upload/man.jpg',
                'https://res.cloudinary.com/demo/image/upload/couple.jpg',
                'https://res.cloudinary.com/demo/image/upload/family.jpg',
            ];
            
            foreach ($samplePhotos as $index => $url) {
                if ($imported >= $validated['limit']) break;
                
                // Check if already exists
                $existing = Gallery::where('file_path', $url)->first();
                if ($existing) continue;
                
                try {
                    Gallery::create([
                        'user_id' => null,
                        'title' => 'Auto Import ' . ($index + 1),
                        'description' => 'Imported automatically from Cloudinary',
                        'file_path' => $url,
                        'cloudinary_public_id' => $this->extractPublicIdFromUrl($url),
                        'file_type' => 'image',
                        'folder' => $targetFolder,
                        'batch_filter' => $validated['batch_filter'],
                        'visibility' => $validated['visibility'],
                    ]);
                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Failed to import: {$url}";
                }
            }
            
            $message = "Auto import completed! Imported {$imported} photos.";
            if (!empty($errors)) {
                $message .= " Errors: " . count($errors);
            }
            
            return redirect()->route('gallery.index')->with('success', $message);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Auto import failed: ' . $e->getMessage());
        }
    }

    /**
     * Extract folder name from Cloudinary console URL or return as-is
     */
    private function extractFolderFromUrl($input)
    {
        if (empty($input)) {
            return '';
        }
        
        // If it's a Cloudinary console URL, extract folder name
        // Example: https://console.cloudinary.com/console/c-xxx/media_library/folders/gallery
        if (preg_match('/cloudinary\.com.*\/folders\/(.+?)(?:\/|$)/', $input, $matches)) {
            return $matches[1];
        }
        
        // If it's already just a folder name, return as-is
        return trim($input);
    }

    /**
     * Extract public_id from Cloudinary URL
     */
    private function extractPublicIdFromUrl($url)
    {
        // Try to extract public_id from Cloudinary URL
        // Example: https://res.cloudinary.com/demo/image/upload/v1234567890/sample.jpg
        if (preg_match('/cloudinary\.com\/[^\/]+\/[^\/]+\/[^\/]+\/(?:v\d+\/)?(.+?)(?:\.[^.]+)?$/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
