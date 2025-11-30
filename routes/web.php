<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Program routes
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

// Article routes
Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Map routes
Route::get('/map', [\App\Http\Controllers\MapController::class, 'index'])->name('map.index');
Route::get('/api/map/locations', [\App\Http\Controllers\MapController::class, 'getMemberLocations'])->name('map.locations');

// Gallery routes
Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Registration routes (requires authentication)
    Route::get('/registrations/create', [\App\Http\Controllers\RegistrationController::class, 'create'])->name('registrations.create');
    Route::post('/registrations', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('registrations.store');
    
    // Course routes (requires authentication)
    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
});

require __DIR__.'/auth.php';
