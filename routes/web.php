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

// Language Switcher
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar', 'id'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
});

// Program routes
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

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
