<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Project;

// Add this to routes/web.php temporarily
Route::get('/debug-storage', function() {
    $user = \App\Models\User::find(1);
    
    // Test different ways to get the URL
    $avatarPaths = [
        'storage_path' => $user->avatar_path,
        'storage_exists' => \Illuminate\Support\Facades\Storage::exists($user->avatar_path),
        'storage_url' => \Illuminate\Support\Facades\Storage::url($user->avatar_path),
        'asset_url' => asset('storage/' . str_replace('storage/', '', $user->avatar_path)),
        'avatar_url_attribute' => $user->avatar_url,
    ];
    
    $coverPaths = [
        'storage_path' => $user->cover_image,
        'storage_exists' => \Illuminate\Support\Facades\Storage::exists($user->cover_image),
        'storage_url' => \Illuminate\Support\Facades\Storage::url($user->cover_image),
        'asset_url' => asset('storage/' . str_replace('storage/', '', $user->cover_image)),
        'cover_url_attribute' => $user->cover_image_url,
    ];
    
    return response()->json([
        'user' => $user->name,
        'avatar' => $avatarPaths,
        'cover' => $coverPaths,
        'public_storage_link' => is_link(public_path('storage')),
        'public_storage_target' => readlink(public_path('storage')),
    ]);
});

/* --------------------------------------------------------------------------
 * Public Routes
 * -------------------------------------------------------------------------- */

// Home page
Route::get('/', [PageController::class, 'home'])->name('home');

// About page
Route::get('/about', [PageController::class, 'about'])->name('about');

// Contact page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'send'])->name('contact.send');

// Projects - PUBLIC VIEW (fetched from GitHub)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

/* --------------------------------------------------------------------------
 * CV Routes (Public)
 * -------------------------------------------------------------------------- */
Route::get('/cv/classic', function () {
    $projects = Project::featured()->active()->ordered()->get();
    return view('cv.classic', compact('projects'));
})->name('cv.classic');

Route::get('/cv/minimal', function () {
    $projects = Project::featured()->active()->ordered()->get();
    return view('cv.minimal', compact('projects'));
})->name('cv.minimal');

Route::get('/cv/download/{template?}', function ($template = 'classic') {
    if (!in_array($template, ['classic', 'minimal'])) {
        abort(404);
    }
    
    $projects = Project::featured()->active()->ordered()->get();
    $pdf = Pdf::loadView("cv.{$template}", compact('projects'));
    $pdf->setPaper('a4', 'portrait');
    
    $name = config('portfolio.name', 'developer');
    $filename = 'cv_' . strtolower(str_replace(' ', '_', $name)) . '_' . $template . '.pdf';
    
    return $pdf->download($filename);
})->name('cv.download');

/* --------------------------------------------------------------------------
 * Authenticated Routes
 * -------------------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/cover-image/upload', [ProfileController::class, 'uploadCoverImage'])
        ->name('profile.cover-image.upload');
    Route::delete('/profile/cover-image/delete', [ProfileController::class, 'deleteCoverImage'])
        ->name('profile.cover-image.delete');
});

/* --------------------------------------------------------------------------
 * Admin Routes
 * -------------------------------------------------------------------------- */
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CV Management
    Route::get('/cv', [CvController::class, 'index'])->name('cv.index');
    Route::post('/cv/upload', [CvController::class, 'upload'])->name('cv.upload');
    Route::post('/cv/generate', [CvController::class, 'generate'])->name('cv.generate');
    Route::delete('/cv/{cv}', [CvController::class, 'destroy'])->name('cv.destroy');
    Route::post('/cv/set-active', [CvController::class, 'setActive'])->name('cv.set-active');
});

require __DIR__.'/auth.php';