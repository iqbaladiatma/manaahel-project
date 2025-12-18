<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryFolder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display galleries visible to the current user.
     * Shows folder view if no specific folder is selected, otherwise shows files in folder.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $folder = $request->get('folder');
        
        // If specific folder is selected, show folder contents
        if ($folder) {
            return $this->showFolderContents($request, $user, $folder);
        }
        
        // Build query with filters
        $query = Gallery::visibleForUser($user);
        
        // Get galleries with pagination
        $galleries = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Preserve query parameters in pagination links
        $galleries->appends($request->query());
        
        // Get folders for display
        $folders = GalleryFolder::with('creator')->get();
        
        // Get folder statistics
        $folderStats = Gallery::visibleForUser($user)
            ->select('folder')
            ->selectRaw('COUNT(*) as count')
            ->whereNotNull('folder')
            ->groupBy('folder')
            ->get()
            ->keyBy('folder');
        
        return view('gallery.index', [
            'galleries' => $galleries,
            'folders' => $folders,
            'folderStats' => $folderStats,
            'currentFolder' => $folder,
        ]);
    }
    
    /**
     * Show folder view (like Google Drive main view)
     */
    private function showFolderView(Request $request, $user, $category): View
    {
        try {
            // Get all folders for the category (or all if no category)
            $foldersQuery = GalleryFolder::with('creator');
            
            if ($category) {
                $foldersQuery->where('category', $category);
            }
            
            $folders = $foldersQuery->get();
            
            // Get folder statistics (file counts)
            $folderStats = Gallery::visibleForUser($user)
                ->select('category', 'folder')
                ->selectRaw('COUNT(*) as count')
                ->whereNotNull('folder')
                ->when($category, function($query) use ($category) {
                    return $query->where('category', $category);
                })
                ->groupBy('category', 'folder')
                ->get()
                ->keyBy(function($item) {
                    return $item->category . '|' . $item->folder;
                });
            
            // Get files without folder (global view)
            $globalFiles = Gallery::visibleForUser($user)
                ->whereNull('folder')
                ->when($category, function($query) use ($category) {
                    return $query->where('category', $category);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(12);
            
            $globalFiles->appends($request->query());
            
            return view('gallery.folder-view', [
                'folders' => $folders,
                'folderStats' => $folderStats,
                'globalFiles' => $globalFiles,
                'currentCategory' => $category,
            ]);
        } catch (\Exception $e) {
            // Fallback to original gallery view if there's an error
            \Log::error('Error in showFolderView: ' . $e->getMessage());
            
            // Build query with filters (fallback to original logic)
            $query = Gallery::visibleForUser($user);
            
            // Filter by category if provided
            if ($category) {
                $query->where('category', $category);
            }
            
            // Get galleries with pagination
            $galleries = $query->orderBy('created_at', 'desc')->paginate(12);
            
            // Preserve query parameters in pagination links
            $galleries->appends($request->query());
            
            return view('gallery.index', [
                'galleries' => $galleries,
            ]);
        }
    }
    
    /**
     * Show contents of a specific folder
     */
    private function showFolderContents(Request $request, $user, $folder): View
    {
        // Get folder info
        $folderInfo = GalleryFolder::where('folder', $folder)
            ->with('creator')
            ->first();
        
        // Build query for files in this folder
        $query = Gallery::visibleForUser($user)
            ->where('folder', $folder);
        
        // Get galleries with pagination
        $galleries = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Preserve query parameters in pagination links
        $galleries->appends($request->query());
        
        return view('gallery.folder-contents', [
            'galleries' => $galleries,
            'folderInfo' => $folderInfo,
            'currentFolder' => $folder,
        ]);
    }
}
