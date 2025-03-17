<?php
namespace App\Services;

use App\Models\Job;

class SearchServices {
    public function search ($request){
        // dd($request->all());

        $job = $request->input('job');
        $city = $request->input('city');
        // dd($request->all());

        // Get the relationhsip first
        return Job::query()->with([
            'company',
            'category',
            'recruiter',
        ])->when($job, function($q, $job){
            $q->where('name', 'like', '%'.$job.'%');
        })->when($city, function($q, $city){
            $q->where('address', 'like', '%'.$city.'%');
        })->get();
    }

    public function advancedSearch($request) {
        dd($request->all());
    }
}