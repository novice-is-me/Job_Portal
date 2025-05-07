<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyValue;

class RecruiterServices{

    public function updateRecruiter($request){
        // dd($request->all());

        $user = auth()->user();

        if($user){
            $user->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type' => 3,
            ]);
        }

        $user->companiesRecruiter()->sync([
            // We only sync the selected company id, becs in the relationship in the model, we have the company_id as the foreign key and the recruiter_id as the local key
            $request->selectedCompany['id']
        ]);
    }

    public function updateValues($request){

        $company = Company::find($request['company_id']);

        // Delete old values
        $company->values()->delete();
        // Create new values
        foreach($request['company_values'] as $value){
            $company->values()->create([
                'company_id' => $company->id,
                'name' => $value['name'],
                'description' => $value['description'],
            ]);
        }
    }

    public function updateBenefits($request){

        $company = Company::find($request['company_id']);

        // Delete old values
        $company->benefits()->delete();
        // Create new values
        foreach($request['company_benefits'] as $benefit){
            $company->benefits()->create([
                'company_id' => $company->id,
                'name' => $benefit['name'],
                'description' => $benefit['description'],
            ]);
        }
    }

    public function jobSearch($request, $jobs)
    {
        $job = $request->input('jobs');
        $status = $request->input('status');

        return $jobs
            ->when(!empty($job), function($q) use ($job){
                $q->where('name', 'like', '%'.$job.'%');
            })
            ->when(!empty($status), function($q) use ($status){
                if($status === 'Active'){
                    $q->where('status', 'Active');
                } elseif ($status === 'Urgent'){
                    $q->where('status', 'Urgent');
                }
            })
            ->get(); 
    }
}