<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    //

    public function index($id)
    {
        // Get the company with its jobs
        $company = Company::with(['jobs', 'industry', 'values', 'benefits'])
            ->where('id', $id)
            ->first();

        $industry = $company->industry;

        $similarCompanies = Company::with(['jobs', 'industry', 'values', 'benefits'])
            ->where('industry', $industry)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->get();

        return Inertia::render('Company/Index', [
            'company' => $company,
            'similarCompanies' => $similarCompanies,    
        ]);
    }
}
