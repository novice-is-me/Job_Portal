<?php
namespace App\Services;

use App\Models\Job;

class SearchServices {

    // This is the base query for the job with the relationships
    private function jobQuery(){
        return Job::query()->with([
            'company',
            'category',
            'recruiter',
        ]);
    }

    public function search ($request){

        $job = $request->input('job');
        $city = $request->input('city');

        return $this->jobQuery()
            ->when($job, function($q, $job){
                $q->where('name', 'like', '%'.$job.'%');
            })->when($city, function($q, $city){
                $q->where('address', 'like', '%'.$city.'%');
            })->get();
    }

    public function advancedSearch($request) {

        $filters = $request->all();
      
        return $this->jobQuery()
        ->when(!empty($filters['category']), function ($q) use ($filters) {
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

        // dd($request->all());
        $filters = $request->all();

        return $this->jobQuery()
        ->when(!empty($filters['job_type']), function($q) use ($filters){
            $q->whereIn('type', $filters['job_type']);
        })->when(!empty($filters['experience']), function($q) use ($filters){
            $q->whereIn('experience_id', $filters['experience']);
        })->when(!empty($filters['location_type']), function($q) use ($filters){
            $q->whereIn('work_setup', $filters['location_type']);
        })->get();
    }
}