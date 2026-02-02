<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Models\Project;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cv/classic', function () {
    return view('cv.classic', [
        'user' => User::first(),
        'projects' => Project::with('tags')->get(),
    ]);
});

Route::get('/cv/minimal', function () {
    return view('cv.minimal', [
        'user' => User::first(),
        'projects' => Project::with('tags')->get(),
    ]);
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::view('/projects', 'admin.projects');
});

require __DIR__.'/auth.php';
