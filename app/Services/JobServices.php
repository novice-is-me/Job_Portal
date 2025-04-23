<?php
namespace App\Services;

use App\Models\UserApplication;

class JobServices {
    
    public function apply($request){

        $user_id = auth()->user()->id;
        
        if ($request){

            // Check if the user has already applied for the job
            $existingApplication = UserApplication::where('job_id', $request->job_id)
                ->where('user_id', $user_id)
                ->first();

            if ($existingApplication) {
                return redirect()->back()->with('error', 'You have already applied for this job.');
            } else {
                UserApplication::create([
                    'job_id' => $request->job_id,
                    'user_id' => $user_id,
                    'is_applied' => 1,
                    'status' => 1,
                ]);
            }

        } else {
            return redirect()->back()->with('error', 'Failed to submit application. Please try again.');
        }
    }
}