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
        $filters = $request->all();
        // dd($filters);
        return Job::query()->with([
            'company',
            'category',
            'recruiter',
        ])->when(!empty($filters['category']), function ($q) use ($filters) {
            $q->where('category_id', $filters['category']);
        })->when(!empty($filters['company']), function ($q) use ($filters) {
            $q->where('company_id', $filters['company']);
        })->when(!empty($filters['status']), function ($q) use ($filters) {
            $q->where('status', $filters['status']);
        })->when(!empty($filters['date']), function($q) use ($filters){
            if ($filters['date'] === 'today') {
                $q->where('created_at', '>=', now()->startOfDay());
            } elseif ($filters['date'] === 'week') {
                $q->where('created_at', '>=', now()->startOfWeek());
            } elseif ($filters['date'] === 'month') {
                $q->where('created_at', '>=', now()->startOfMonth());
            }
        })->when(!empty($filters['salary']), function ($q) use ($filters){
            [$minSalary, $maxSalary] = explode('-', $filters['salary']);

            $q->whereBetween('salary', [$minSalary, $maxSalary]);
        })->get();
    }

    public function sideFilter($request){
        dd($request->all());
    }
}