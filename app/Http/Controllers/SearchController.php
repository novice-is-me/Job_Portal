<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\ExperienceLevel;
use App\Models\Job;
use App\Services\SearchServices;
use Illuminate\Http\Request;
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
        ]);
    }
}
