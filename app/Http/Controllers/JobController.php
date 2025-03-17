<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    //
    public function index($id){
        // dd($id);
        $job = Job::find($id);
        // dd($job);

        return Inertia::render('Job/Index', [
            'job' => $job,
        ]);
    }
}
