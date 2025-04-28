<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\JobServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{

    public $jobService;
    
    public function __construct(JobServices $jobServices)
    {
        $this->jobService = $jobServices;

    }
    public function index($id){
        
        $job = Job::with([
            'company.benefits',
            'category',
            'recruiter',
            'experience',
            'skills',
            'responsibilities',
            'requirements',
        ])->find($id);

        // Get all related jobs, but excluding the current job
        $related_jobs = $job->company->jobs->where('id', '!=', $job->id);

        // Get the user_application status
        $job_application = $job->applications->where('user_id', auth()->user()->id)->first();

        // dd($related_jobs);
        return Inertia::render('Job/Index', [
            'job' => $job,
            'related_jobs' => $related_jobs,
            'job_application' => $job_application,
            'no_of_applicants' => $job->applications->count(),
        ]);
    }
    
    public function apply(Request $request){
        
        try {
            $this->jobService->apply($request);
            return redirect()->back()->with('success', 'Application submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit application. Please try again.');
        }

    }
}
