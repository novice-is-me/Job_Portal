<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
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
    // Profile Update in diff fields
    Route::post('/profile/update', [UserController::class, 'updateBasicInformation'])->name('profile.updateBasicInformation');
    Route::post('/profile/edit/work', [UserController::class, 'updateWorkExp'])->name('profile.updateWorkExp');
    Route::post('/profile/edit/education', [UserController::class, 'updateEducation'])->name('profile.updateEducation');
    Route::post('/profile/edit/skills/{id}', [UserController::class, 'updateSkills'])->name('profile.updateSkills');
    Route::post('/profile/edit/add-skill', [UserController::class, 'addSkill'])->name('profile.addSkill');
    Route::post('/profile/edit/documents', [UserController::class, 'addDocuments'])->name('profile.addDocuments');
    Route::get('/download/{id}/{type}/{filename}', [FileController::class, 'download'])->name('download');
    Route::delete('/profile/delete/documents/{id}', [FileController::class, 'delete'])->name('profile.deleteDocuments');
    Route::post('profile/edit/social', [UserController::class, 'updateSocial'])->name('profile.updateSocial');
    Route::post('[profile/update/information]', [UserController::class, 'updateInformation'])->name('profile.updateInformation');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Search
    Route::get('/dashboard/search', [SearchController::class, 'index'])->name('dashboard.search');
    Route::get('/dashboard/advanced-search', [SearchController::class, 'advancedSearch'])->name('dashboard.advanced-search');
    route::get('/dashboard/filter', [SearchController::class, 'filter'])->name('dashboard.filter');

    // Search (Company page)
    Route::get('/dashboard/search/company', [SearchController::class, 'searchCompany'])->name('dashboard.search.company');
    Route::get('/dashboard/advanced-search/company', [SearchController::class, 'advancedSearchCompany'])->name('dashboard.advanced-search.company');

    // Job Details
    Route::get('/dashboard/job/{job}', [JobController::class, 'index'])->name('job.index');

    // Apply
    Route::post('/dashboard/job/{job}/apply', [JobController::class, 'apply'])->name('job.apply');

    // Companies dahsboard
    Route::get('companies', [DashboardController::class, 'companies'])->name('companies');

});

require __DIR__.'/auth.php';
