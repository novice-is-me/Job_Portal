<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyRecruiter;
use App\Models\UserApplication;
use App\Services\RecruiterServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecruiterController extends Controller
{
    //

    public $recruiterService;
    public function __construct(RecruiterServices $recruiterService){
        $this->recruiterService = $recruiterService;

    }
    public function index(){
        $companies = Company::with(['industry'])->get();
        $user = auth()->user();
        $recruiterCompany = CompanyRecruiter::where('recruiter_id', $user->id)->first();

        return Inertia::render('Recruiter/Index', [
            'companies' => $companies,
            'user' => $user,
            'recruiterCompany' => $recruiterCompany,
        ]);
    }

    public function submit(Request $request){

        $this->recruiterService->updateRecruiter($request);
    }

    public function show($id){

        $company = Company::with(['industry', 'benefits', 'values'])->where('id', $id)->first();
        
        $active_jobs = $company->jobs()->count();
        $total_applicants = UserApplication::whereIn('job_id', $company->jobs->pluck('id'))->count();

        return Inertia::render('Recruiter/Company', [
            'user' => auth()->user(),
            'company' => $company,
            'active_jobs' => $active_jobs,
            'total_applicants' => $total_applicants,
        ]);
    }

    public function jobs(){
        return Inertia::render('Recruiter/Jobs', [
            'user' => auth()->user(),
        ]);
    }

    public function submitValues(Request $request){
        try{
            $this->recruiterService->updateValues($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }

    }

    public function submitBenefits(Request $request){
        try{
            $this->recruiterService->updateBenefits($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }
}
