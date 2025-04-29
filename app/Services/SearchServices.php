<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Job;
use App\Models\UserApplication;

class SearchServices {

    // This is the base query for the job with the relationships
    private function jobQuery(){
        return Job::query()->with([
            'company',
            'category',
            'recruiter',
        ]);
    }

    public function search ($request, $paginate = 5){

        $job = $request->input('job');
        $city = $request->input('city');

        return $this->jobQuery()
            ->when($job, function($q, $job){
                $q->where('name', 'like', '%'.$job.'%');
            })->when($city, function($q, $city){
                $q->where('address', 'like', '%'.$city.'%');
            })->paginate($paginate)
            ->appends($request->only('job', 'city'));
    }

    public function advancedSearch($request, $paginate = 5) {

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
        })->paginate($paginate)
        ->appends($filters);
    }

    public function sideFilter($request, $paginate = 5){

        $filters = $request->all();

        return $this->jobQuery()
        ->when(!empty($filters['job_type']), function($q) use ($filters){
            $q->whereIn('type', $filters['job_type']);
        })->when(!empty($filters['experience']), function($q) use ($filters){
            $q->whereIn('experience_id', $filters['experience']);
        })->when(!empty($filters['location_type']), function($q) use ($filters){
            $q->whereIn('work_setup', $filters['location_type']);
        })->paginate($paginate)
        ->appends($filters);
    }

    public function companySearch ($request, $paginate = 3){
        // dd($request->all());

        $company = $request->input('company');
        $industry = $request->input('industry');

        return Company::query()
            ->when(!empty($company), function($q) use ($company){
                $q->where('name', 'like', '%'.$company.'%');
            })
            ->when(!empty($industry), function($q) use ($industry){
                $q->where('industry', 'like', '%'.$industry.'%');
            })
            ->paginate($paginate)
            ->appends($request->only('company'));
    }

    public function filterApplication($request){
        // dd($request->all());

        $date = $request->input('date');
        $job_type = $request->input('jobType');
        $job_status = $request->input('jobStatus');

        return UserApplication::query()
        ->with(['job.company', 'jobStatus'])
        ->when(!empty($date), function($q) use ($date){
            if( $date === 'Today'){
                $q->where('created_at', '>=', now()->startOfDay());
            } elseif ( $date === 'Past Week'){
                $q->where('created_at', '>=', now()->startOfWeek());
            } elseif ( $date === 'Past Month'){
                $q->where('created_at', '>=', now()->startOfMonth());
            }
        })
        ->when(!empty($job_type), function ($q) use ($job_type){
            $q->whereHas('job', function($q) use ($job_type){
                $q->where('type', $job_type);
            });
        })
        ->when(!empty($job_status), function ($q) use ($job_status){
            $q->whereHas('job', function($q) use ($job_status){
                $q->where('status', $job_status);
            });
        })
        ->get();
        
    }
}