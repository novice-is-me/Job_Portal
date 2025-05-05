<?php

namespace App\Http\Controllers;

use App\Models\Company;
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

        return Inertia::render('Recruiter/Index', [
            'companies' => $companies,
            'user' => $user,
        ]);
    }

    public function submit(Request $request){

        $this->recruiterService->updateRecruiter($request);
    }
}
