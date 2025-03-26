<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Search
    Route::get('/dashboard/search', [SearchController::class, 'index'])->name('dashboard.search');
    Route::get('/dashboard/advanced-search', [SearchController::class, 'advancedSearch'])->name('dashboard.advanced-search');
    route::get('/dashboard/filter', [SearchController::class, 'filter'])->name('dashboard.filter');

    // Job Details
    Route::get('/dashboard/job/{job}', [JobController::class, 'index'])->name('job.index');

    // Profile
    // Route::get(('/profile'), [UserController::class, 'index'])->name('profile.index');

});

require __DIR__.'/auth.php';
