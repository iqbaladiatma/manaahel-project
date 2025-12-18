<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Program routes
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

// Manaahel Academy routes
Route::get('/academy', [\App\Http\Controllers\AcademyController::class, 'index'])->name('academy.index');
Route::get('/academy/{slug}', [\App\Http\Controllers\AcademyController::class, 'show'])->name('academy.show');
Route::post('/academy/{slug}/register', [\App\Http\Controllers\AcademyController::class, 'register'])->name('academy.register');
Route::get('/academy-success/{registration}', [\App\Http\Controllers\AcademyController::class, 'success'])->name('academy.success');

// Article routes
Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Map routes
Route::get('/map', [\App\Http\Controllers\MapController::class, 'index'])->name('map.index');
Route::get('/api/map/locations', [\App\Http\Controllers\MapController::class, 'getMemberLocations'])->name('map.locations');



// Gallery routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');
    
    // Member Angkatan can upload to gallery
    Route::get('/gallery/upload', [\App\Http\Controllers\GalleryUploadController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/upload', [\App\Http\Controllers\GalleryUploadController::class, 'store'])->name('gallery.store');
    
    // Admin can add Cloudinary media
    Route::get('/gallery/cloudinary/add', [\App\Http\Controllers\CloudinaryGalleryController::class, 'create'])->name('gallery.cloudinary.create');
    Route::post('/gallery/cloudinary/add', [\App\Http\Controllers\CloudinaryGalleryController::class, 'store'])->name('gallery.cloudinary.store');
    Route::get('/gallery/cloudinary/bulk', [\App\Http\Controllers\CloudinaryGalleryController::class, 'bulkCreate'])->name('gallery.cloudinary.bulk');
    Route::post('/gallery/cloudinary/bulk', [\App\Http\Controllers\CloudinaryGalleryController::class, 'bulkStore'])->name('gallery.cloudinary.bulk-store');
    
    // Bulk import Cloudinary
    Route::get('/gallery/bulk-import', function() { return view('gallery.bulk-import-cloudinary'); })->name('gallery.bulk-import');
    Route::post('/gallery/cloudinary/auto-import', [\App\Http\Controllers\CloudinaryGalleryController::class, 'autoImport'])->name('gallery.cloudinary.auto-import');
    Route::get('/gallery/url-generator', function() { return view('gallery.cloudinary-url-generator'); })->name('gallery.url-generator');
    Route::get('/debug-bulk-import', function() { return view('debug-bulk-import'); })->name('debug.bulk-import');
    
    // Bulk actions for gallery
    Route::post('/gallery/make-all-public', function() {
        $updated = \App\Models\Gallery::where('visibility', 'member_only')->update(['visibility' => 'public']);
        return response()->json(['success' => true, 'message' => "Made {$updated} items public"]);
    })->name('gallery.make-all-public');
    
    Route::post('/gallery/make-public/{id}', function($id) {
        $item = \App\Models\Gallery::findOrFail($id);
        $item->update(['visibility' => 'public']);
        return response()->json(['success' => true, 'message' => 'Item made public']);
    })->name('gallery.make-public');
    
    Route::delete('/gallery/delete/{id}', function($id) {
        $item = \App\Models\Gallery::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true, 'message' => 'Item deleted']);
    })->name('gallery.delete');
    
    Route::delete('/gallery/delete-recent', function() {
        $deleted = \App\Models\Gallery::where('created_at', '>', now()->subHour())->delete();
        return response()->json(['success' => true, 'message' => "Deleted {$deleted} recent items"]);
    })->name('gallery.delete-recent');
    
    // Folder Management (Admin only)
    Route::prefix('admin/folders')->name('admin.folders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\FolderController::class, 'index'])->name('index');
        Route::post('/', [\App\Http\Controllers\FolderController::class, 'store'])->name('store');
        Route::delete('/', [\App\Http\Controllers\FolderController::class, 'destroy'])->name('destroy');
        Route::post('/move-files', [\App\Http\Controllers\FolderController::class, 'moveFiles'])->name('move-files');
        Route::post('/remove-from-folder', [\App\Http\Controllers\FolderController::class, 'removeFromFolder'])->name('remove-from-folder');
    });
});

// Members Directory routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/members', [\App\Http\Controllers\MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{member}', [\App\Http\Controllers\MemberController::class, 'show'])->name('members.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Profile Completion for Academy
    Route::get('/profile/complete', [\App\Http\Controllers\ProfileCompletionController::class, 'show'])->name('profile.complete');
    Route::post('/profile/complete', [\App\Http\Controllers\ProfileCompletionController::class, 'update'])->name('profile.complete.update');
    
    // Registration routes (requires authentication)
    Route::get('/registrations/create', [\App\Http\Controllers\RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/registrations', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('registrations.store');
    
    // Enrolled Programs (for users who have registered and been approved)
    Route::prefix('my-programs')->name('enrolled.')->group(function () {
        Route::get('/', [\App\Http\Controllers\EnrolledProgramController::class, 'index'])->name('index');
        Route::get('/{program:slug}', [\App\Http\Controllers\EnrolledProgramController::class, 'show'])->name('show');
        Route::get('/{program:slug}/courses/{course:slug}/modules/{module}', [\App\Http\Controllers\EnrolledProgramController::class, 'showModule'])->name('module.show');
        Route::post('/{program:slug}/courses/{course:slug}/modules/{module}/complete', [\App\Http\Controllers\EnrolledProgramController::class, 'completeModule'])->name('module.complete');
        Route::post('/{program:slug}/courses/{course:slug}/modules/{module}/uncomplete', [\App\Http\Controllers\EnrolledProgramController::class, 'uncompleteModule'])->name('module.uncomplete');
        Route::post('/{program:slug}/attendance/{schedule}', [\App\Http\Controllers\EnrolledProgramController::class, 'markAttendance'])->name('attendance.mark');
    });
    

});

require __DIR__.'/auth.php';

// Video proxy routes
Route::get('/video-proxy', [\App\Http\Controllers\VideoProxyController::class, 'proxy'])->name('video.proxy');
Route::get('/video-stream', [\App\Http\Controllers\VideoProxyController::class, 'stream'])->name('video.stream');

// Debug routes (only in development)
if (app()->environment('local')) {
    Route::get('/debug/gallery', [\App\Http\Controllers\DebugController::class, 'gallery'])->name('debug.gallery');
    Route::post('/debug/test-cloudinary', [\App\Http\Controllers\DebugController::class, 'testCloudinary'])->name('debug.test-cloudinary');
    Route::get('/test-video', function() { return view('test-video'); })->name('test.video');
    Route::get('/test-video-simple', function() { return view('gallery.video-test-simple'); })->name('test.video.simple');
    Route::get('/debug-video-fix', function() {
        $videos = \App\Models\Gallery::where('file_type', 'video')->get();
        return view('debug-video-fix', compact('videos'));
    })->name('debug.video.fix');
    Route::get('/test-video-proxy', function() { return view('test-video-proxy'); })->name('test.video.proxy');
    Route::get('/test-video-sizing', function() { return view('test-video-sizing'); })->name('test.video.sizing');
    Route::get('/test-gallery-layout', function() { return view('test-gallery-layout'); })->name('test.gallery.layout');
    
    // Test folder view
    Route::get('/test-folder-view', function() {
        $folders = \App\Models\GalleryFolder::with('creator')->get();
        $folderStats = collect();
        $globalFiles = \App\Models\Gallery::paginate(12);
        
        return view('gallery.folder-view', [
            'folders' => $folders,
            'folderStats' => $folderStats,
            'globalFiles' => $globalFiles,
            'currentCategory' => null,
        ]);
    })->name('test.folder.view');
}
