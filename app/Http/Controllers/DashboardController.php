<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\ExperienceLevel;
use App\Models\Industry;
use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    public function index(){

        $job = Job::with([
            'company.jobs.company',
            'category',
            'recruiter',
            'experience',
            'skills',
        ])->paginate(5);

        return Inertia::render('Dashboard', [
            'jobs' => $job,
            'categories' => Category::all(),
            'companies' => Company::all(),
            'experiences' => ExperienceLevel::all(),
            'no_of_jobs' => Job::count(),
        ]);
    }

    public function companies () {

        $companies = Company::with(['jobs'])
            ->paginate(3);

        $featuredCompanies = Company::with(['jobs'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return Inertia::render('Companies', [
            'categoryCompany' => Industry::all(),
            'companies' => $companies,
            'featuredCompanies' => $featuredCompanies,
        ]);
    }
}
