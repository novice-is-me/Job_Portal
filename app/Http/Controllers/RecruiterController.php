<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyRecruiter;
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
}
