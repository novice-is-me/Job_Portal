<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
    Route::get('/profile/application/filter', [SearchController::class, 'applicationFilter'])->name('profile.application.filter');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Search
    Route::get('/dashboard/search', [SearchController::class, 'index'])->name('dashboard.search');
    Route::get('/dashboard/advanced-search', [SearchController::class, 'advancedSearch'])->name('dashboard.advanced-search');
    route::get('/dashboard/filter', [SearchController::class, 'filter'])->name('dashboard.filter');

    // Search (Company page)
    Route::get('/dashboard/search/company', [SearchController::class, 'searchCompany'])->name('dashboard.search.company');

    // Job Details
    Route::get('/dashboard/job/{job}', [JobController::class, 'index'])->name('job.index');

    // Apply
    Route::post('/dashboard/job/{job}/apply', [JobController::class, 'apply'])->name('job.apply');

    // Companies dahsboard
    Route::get('companies', [DashboardController::class, 'companies'])->name('companies');
    Route::get('company/{id}', [CompanyController::class, 'index'])->name('company.index');

    // Email
    Route::post('/email/subscribe/{id}', [EmailController::class, 'subscribe'])->name('email.subscribe');

    // Recruiter routes
    Route::get('/recruiter', [RecruiterController::class, 'index'])->name('recruiter.index');
    Route::post('/recruiter/submit', [RecruiterController::class, 'submit'])->name('recruiter.submit');
    Route::get('dashboard/recuiter', [RecruiterController::class, 'show'])->name('dashboard.recruiter');

    // Recruiter Dashboard Tabs
    Route::prefix('dashboard/recruiter')->name('dashboard.recruiter.')->group(function () {
        Route::get('/', [RecruiterController::class, 'show'])->name('company');
        Route::get('/jobs', [RecruiterController::class, 'jobs'])->name('jobs');
        Route::get('/candidates', [RecruiterController::class, 'candidates'])->name('candidates');
        Route::get('/analytics', [RecruiterController::class, 'analytics'])->name('analytics');
        Route::get('/jobs/search', [RecruiterController::class, 'searchJobs'])->name('jobs.search');

        // Post routed
        Route::post('values', [RecruiterController::class, 'submitValues'])->name('submit.values');
        Route::post('benefits', [RecruiterController::class, 'submitBenefits'])->name('submit.benefits');
        Route::post('add-jobs', [RecruiterController::class, 'addJobs'])->name('submit.add-jobs');
        Route::delete('delete-job/', [RecruiterController::class, 'deleteJob'])->name('delete.job');
        Route::post('update-job', [RecruiterController::class, 'updateJob'])->name('update.job');
        Route::post('update-status', [RecruiterController::class, 'updateJobStatus'])->name('update.status');
        Route::post('set-interview', [RecruiterController::class, 'submitInterview'])->name('submit.interview');
        Route::post('reject-candidate', [RecruiterController::class, 'rejectCandidate'])->name('reject.candidate');
    });

});

require __DIR__.'/auth.php';
