<?php

namespace App\Services;

use App\Mail\InterviewEmail;
use App\Mail\RejectionEmail;
use App\Models\Company;
use App\Models\CompanyValue;
use App\Models\Job;
use App\Models\UserApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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

    public function addJobs($request){

        $companyId = $request->input('company_id');

        $company = Company::find($companyId);

        $company->jobs()->create([
            'name' => $request->input('job_title'),
            'content' => $request->input('description'),
            'category_id' => $request->input('category')['id'],
            'address' => $request->input('address'),
            'status' => $request->input('status')['name'],
            'salary' => $request->input('salary'),
            'type' => $request->input('type')['name'],
        ]);
    }

    public function deleteJob($request){
        $job = Job::find($request->input('job_id'));
        $job->delete();
    }

    public function updateJob($request){
        $job = Job::find($request->input('job_id'));
        
        $job->update([
            'name' => $request->input('job_title'),
            'content' => $request->input('description'),
            'category_id' => $request->input('category')['id'],
            'address' => $request->input('address'),
            'status' => $request->input('status')['name'],
            'salary' => $request->input('salary'),
            'type' => $request->input('type')['name'],
        ]);
    }

    public function setInterview($request){

        $applicant = $request->input('applicant_id');
        $job = $request->input('job_id');
        // dd($applicant);

        $job = UserApplication::where('user_id', $applicant)
            ->where('job_id', $job)
            ->first();
           
        try {
            $job->update([
                'interview_at' => Carbon::parse($request->input('dateTime24h')),
                'status' => 4,
            ]);

            // First get the email of the applicant
            $applicantEmail = $job->user->email;

            // Get the name of applicant
            $applicantName = $job->user->name;
            // Get the date of interview
            $interviewDate = Carbon::parse($request->input('dateTime24h'))->format('d M Y');
            // Get the name of the job
            $jobName = $job->job->name;
            // Then send an email to the applicant about the interview
           Mail::to($applicantEmail)->send(new InterviewEmail(
                $applicantName,
                $interviewDate,
                $jobName
            ));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }

    public function rejectCandidate ($request){
        $applicant = $request->input('applicant_id');
        $job = $request->input('job_id');
        // dd($applicant);

        $job = UserApplication::where('user_id', $applicant)
            ->where('job_id', $job)
            ->first();
           
        try {
            $job->update([
                'status' => 3,
            ]);

             // First get the email of the applicant
            $applicantEmail = $job->user->email;

            // Get the name of applicant
            $applicantName = $job->user->name;
            // Get the date of interview
            $interviewDate = Carbon::parse($request->input('dateTime24h'))->format('d M Y');
            // Get the name of the job
            $jobName = $job->job->name;
            // Then send an email to the applicant about the interview
           Mail::to($applicantEmail)->send(new RejectionEmail(
                $applicantName,
                $interviewDate,
                $jobName
            ));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }

   // RecruiterService.php or wherever your service is defined
    public function updateJobStatus($request)
    {
        $data = $request->input('data');

        $job = UserApplication::find($data['id']); 

        if (!$job) {
            return response()->json(['error' => 'Job application not found'], 404);
        }

        $job->update([
            'status' => $job->status == 1 ? 2 : $job->status,
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $job->status
        ]);
    }

}