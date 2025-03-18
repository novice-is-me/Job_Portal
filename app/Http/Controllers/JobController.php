<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    //
    public function index($id){
        
        $job = Job::with([
            'company.jobs.company',
            'category',
            'recruiter',
            'experience',
            'skills',
        ])->find($id);

        // Get all related jobs, but excluding the current job
        $related_jobs = $job->company->jobs->where('id', '!=', $job->id);

        // dd($related_jobs);
        return Inertia::render('Job/Index', [
            'job' => $job,
            'related_jobs' => $related_jobs,
        ]);
    }
}
