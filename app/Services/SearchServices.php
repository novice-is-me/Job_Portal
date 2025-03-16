<?php
namespace App\Services;

use App\Models\Job;

class SearchServices {
    public function search ($request){
        // dd($request->all());

        $job = $request->input('job');
        $city = $request->input('city');

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

        // Apply the filters

        // $query->when($job, function($q, $job){
        //     $q->where('name', 'like', '%'.$job.'%');
        // });

        // $query->when($city, function($q, $city){
        //     $q->where('address', 'like', '%'.$city.'%');
        // });
    }
}