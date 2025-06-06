<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyRecruiter;
use App\Models\UserApplication;
use App\Services\RecruiterServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function show(){

        $user = auth()->user();
        $recruiterCompany = CompanyRecruiter::where('recruiter_id', $user->id)->first();

        if (!$recruiterCompany) {
            abort(404, 'Recruiter company not found');
        }
    
        $company = Company::with(['industry', 'benefits', 'values', 'jobs'])
            ->where('id', $recruiterCompany->company_id)
            ->first();
    
        $active_jobs = $company->jobs()->count();
        $total_applicants = UserApplication::whereIn('job_id', $company->jobs->pluck('id'))->count();
        $total_interviews = UserApplication::whereIn('job_id', $company->jobs->pluck('id'))
            ->where('status', 4)
            ->count();
    
        return Inertia::render('Recruiter/Company', [
            'user' => $user,
            'company' => $company,
            'active_jobs' => $active_jobs,
            'total_applicants' => $total_applicants,
            'total_interviews' => $total_interviews,
        ]);
    }

    public function jobs(){

        $user = auth()->user(); 
        $recruiterCompany = CompanyRecruiter::where('recruiter_id', $user->id)->first();

        $company = Company::with(['industry', 'benefits', 'values', 'jobs'])
            ->where('id', $recruiterCompany->company_id)
            ->first();
        $jobs = $company->jobs()->with(['category', 'applications', 'experience', 'recruiter'])
        ->get();

        return Inertia::render('Recruiter/Jobs', [
            'company' => $company,
            'jobs' => $jobs,
            'categories' => Category::all(),
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

    public function searchJobs(Request $request){

        $user = auth()->user(); 
        $recruiterCompany = CompanyRecruiter::where('recruiter_id', $user->id)->first();

        $company = Company::with(['industry', 'benefits', 'values', 'jobs'])
            ->where('id', $recruiterCompany->company_id)
            ->first();
        $jobs = $company->jobs()->get();
        $jobQuery = $company->jobs();

        $result = $this->recruiterService->jobSearch($request, $jobQuery);

        return Inertia::render('Recruiter/Jobs', [
            'company' => $company,
            'jobs' => $jobs,
            'results' => $result,
            'categories' => Category::all(),
        ]);
    }

    public function addJobs(Request $request){
        try{
            $this->recruiterService->addJobs($request);
        } catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteJob(Request $request){
        try{
            $this->recruiterService->deleteJob($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }

    public function updateJob(Request $request){
        try{
            $this->recruiterService->updateJob($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    } 

    public function updateJobStatus(Request $request){
        try{
            $this->recruiterService->updateJobStatus($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }

    public function candidates(){

        $user = auth()->user(); 
        $recruiterCompany = CompanyRecruiter::where('recruiter_id', $user->id)->first();

        $company = Company::with(['industry', 'benefits', 'values', 'jobs'])
            ->where('id', $recruiterCompany->company_id)
            ->first();

        $applicants = UserApplication::with(['user.workExperiences.user', 'job', 'jobStatus', 'user.educations', 'user.skills.skill'])
            ->whereIn('job_id', $company->jobs->pluck('id'))
            ->get();

        return Inertia::render('Recruiter/Candidates', [
            'applicants' => $applicants,
        ]);
    }

    public function submitInterview(Request $request){
        try{
            $this->recruiterService->setInterview($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }

    public function rejectCandidate(Request $request){
        try{
            $this->recruiterService->rejectCandidate($request);
        } catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong please try again']);
        }

    }

    public function analytics (){

        $user = auth()->user(); 
        $recruiterCompany = CompanyRecruiter::where('recruiter_id', $user->id)->first();
        // Need the job name for the company
        $company = Company::with(['jobs'])
            ->where('id', $recruiterCompany->company_id)
            ->first(); 
        
        // Need the total number of applicants per job in company
        $applicants = UserApplication::with(['user.workExperiences.user', 'job', 'jobStatus', 'user.educations', 'user.skills.skill'])
            ->whereIn('job_id', $company->jobs->pluck('id'))
            ->get();

        // Optional: count applicants per job
        $applicantsPerJob = $applicants->groupBy('job_id')->map->count();

        $applicantsPerJobMonthly = UserApplication::selectRaw('job_id, MONTHNAME(created_at) as month, COUNT(*) as total')
            ->whereIn('job_id', $company->jobs->pluck('id'))
            ->groupBy('job_id', DB::raw('MONTHNAME(created_at)'))
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $applicantsPerStatus = UserApplication::selectRaw('job_id, status, COUNT(*) as total')
            ->whereIn('job_id', $company->jobs->pluck('id'))
            ->groupBy('job_id', 'status')
            ->get();


        return Inertia::render('Recruiter/Analytics', [
            'user' => auth()->user(),
            'jobs' => $company->jobs,
            'applicantsPerJob' => $applicantsPerJob,
            'applicantsPerJobMonthly' => $applicantsPerJobMonthly,
            'applicantsPerStatus' => $applicantsPerStatus,
        ]);
    }
}
