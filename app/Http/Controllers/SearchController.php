<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\ExperienceLevel;
use App\Models\Industry;
use App\Models\Job;
use App\Models\Skill;
use App\Models\UserApplication;
use App\Services\SearchServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SearchController extends Controller
{
    //

    public $searchService;

    public function __construct(SearchServices $searchServices)
    {
        $this->searchService = $searchServices;
    }

    public function index(Request $request){

        $result = $this->searchService->search($request);

        $job = Job::with([
            'company.jobs.company',
            'category',
            'recruiter',
            'experience',
            'skills',
        ])->get();

        return Inertia::render('Dashboard', [
            'jobs' => $job,
            'categories' => Category::all(),
            'companies' => Company::all(),
            'experiences' => ExperienceLevel::all(),
            'results' => $result,
            'no_of_jobs' => $result->count(),
        ]);
        
    }

    public function advancedSearch( Request $request) {

        $result = $this->searchService->advancedSearch($request);

        $job = Job::with([
            'company.jobs.company',
            'category',
            'recruiter',
            'experience',
            'skills',
        ])->get();

        return Inertia::render('Dashboard', [
            'jobs' => $job,
            'categories' => Category::all(),
            'companies' => Company::all(),
            'experiences' => ExperienceLevel::all(),
            'results' => $result,
            'no_of_jobs' => $result->count(),
        ]);
    }

    public function filter(Request $request){
        // dd($request->all());
        $result = $this->searchService->sideFilter($request);

        // dd($result);
        $job = Job::with([
            'company.jobs.company',
            'category',
            'recruiter',
            'experience',
            'skills',
        ])->get();

        return Inertia::render('Dashboard', [
            'jobs' => $job,
            'categories' => Category::all(),
            'companies' => Company::all(),
            'experiences' => ExperienceLevel::all(),
            'results' => $result,
            'no_of_jobs' => $result->count(),
        ]);
    }

    public function searchCompany (Request $request) {

        $result = $this->searchService->companySearch($request);

        $companies = Company::with(['jobs'])
            ->paginate(3);

        $featuredCompanies = Company::with(['jobs'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return Inertia::render('Companies', [
            'categoryCompany' => Industry::all(),
            'companies' => $companies,
            'results' => $result,
            'featuredCompanies' => $featuredCompanies,
        ]);
    }

    public function applicationFilter(Request $request)
    {
        $result = $this->searchService->filterApplication($request);

        $user = Auth::user();
        $user->load([
            'workExperiences',
            'educations',
            'skills.skill',
        ]);

        $job_applications = UserApplication::where('user_id', $user->id)
            ->with(['job.company', 'jobStatus'])
            ->get();
            
        return Inertia::render('Profile/Index', [
            'user' => $user,
            'results' => $result,
            'job_applications' => $job_applications,
            'skills' => Skill::all(),
        ]);
    }

}
