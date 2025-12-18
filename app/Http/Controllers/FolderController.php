<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    /**
     * Display folder management page
     */
    public function index()
    {
        // Only admin can manage folders
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only admin can manage folders.');
        }

        // Get all registered folders
        $folders = GalleryFolder::with('creator')->get()->groupBy('category');

        // Get folder statistics from actual gallery files
        $folderStats = Gallery::select('folder')
            ->selectRaw('COUNT(*) as count')
            ->whereNotNull('folder')
            ->groupBy('folder')
            ->get()
            ->keyBy('folder');

        // Get unorganized files (files without folder)
        $unorganizedFiles = Gallery::whereNull('folder')
            ->orWhere('folder', '')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.folders.index', compact('folders', 'folderStats', 'unorganizedFiles'));
    }

    /**
     * Create new folder
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only admin can create folders.');
        }

        $validated = $request->validate([
            'folder' => 'required|string|max:100|unique:gallery_folders,folder',
            'description' => 'nullable|string|max:255'
        ]);

        // Create folder entry
        GalleryFolder::create([
            'folder' => $validated['folder'],
            'description' => $validated['description'],
            'created_by' => Auth::id()
        ]);

        return back()->with('success', 'Folder berhasil dibuat!');
    }

    /**
     * Delete folder (and all its contents)
     */
    public function destroy(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only admin can delete folders.');
        }

        $validated = $request->validate([
            'folder' => 'required|string'
        ]);

        // Delete folder entry
        GalleryFolder::where('folder', $validated['folder'])->delete();

        // Delete all gallery files in this folder
        $deleted = Gallery::where('folder', $validated['folder'])->delete();

        return back()->with('success', "Folder '{$validated['folder']}' dan {$deleted} file berhasil dihapus!");
    }

    /**
     * Move selected files to a folder
     */
    public function moveFiles(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only admin can move files.');
        }

        $validated = $request->validate([
            'file_ids' => 'required|array',
            'file_ids.*' => 'exists:galleries,id',
            'target_folder' => 'required|string|max:100',
        ]);

        // Check if target folder exists, create if not
        $folderExists = GalleryFolder::where('folder', $validated['target_folder'])->exists();

        if (!$folderExists) {
            GalleryFolder::create([
                'folder' => $validated['target_folder'],
                'description' => 'Auto-created during file move',
                'created_by' => Auth::id()
            ]);
        }

        // Move files to target folder
        $moved = Gallery::whereIn('id', $validated['file_ids'])
            ->update([
                'folder' => $validated['target_folder']
            ]);

        return response()->json([
            'success' => true,
            'message' => "Berhasil memindahkan {$moved} file ke folder '{$validated['target_folder']}'"
        ]);
    }

    /**
     * Remove files from folder (move to global)
     */
    public function removeFromFolder(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only admin can remove files from folder.');
        }

        $validated = $request->validate([
            'file_ids' => 'required|array',
            'file_ids.*' => 'exists:galleries,id',
        ]);

        // Remove files from folder (set folder to null)
        $moved = Gallery::whereIn('id', $validated['file_ids'])
            ->update([
                'folder' => null
            ]);

        return response()->json([
            'success' => true,
            'message' => "Berhasil memindahkan {$moved} file ke global (tanpa folder)"
        ]);
    }
}