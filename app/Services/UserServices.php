<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UserServices {

    public function updateUser ($request, $id) {
        
        try {
            // Find the user
            $user = User::find($id);
            
            // Update the user
            if($user){
                 $send = $user->update([
                    'name' => $request['full_name'],
                    'age' => $request['age'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'introduction' => $request['summary'],
                    'headline' => $request['profession'],
                    'address' => $request['location']
                ]);

                if(!$send){
                    Log::error("Update failed for user ID: $id", $request->all());
                }

                return response()->json(['message' => 'Profile Updated Succesfully']);
            }else{
                return response()->json(['error' => 'user not foun']);
            }
        } catch ( Exception $e){
            Log::error('Error updating user' . $e->getMessage());

            return response()->json(['error' => 'Something went wrong please try again']);
        }
    }

    public function updateWorkExp ($request, $id) {
        // dd($request->all());

        // Find the user
        $user = User::find($id);

        // Delete existing work experiences
        $user->workExperiences()->delete();

        foreach($request['work_experiences'] as $work){
            // Create new data for user work exp
            $user->workExperiences()->create([
                'user_id' =>$id,
                'name' => $work['name'],
                'company' => $work['company'],
                'address' => $work['address'],
                'start_date' => $work['start_date'],
                'end_date' => $work['end_date'],
                'is_current_job' => $work['is_current_job'] ? 1 : 0,
            ]);
        }
    }

    public function updateEducation ($request, $id){
        // dd($request->all());

        $user = User::find($id);

        // Delete existing educations
        $user->educations()->delete();

        foreach($request['educations'] as $education){
            // Create new data for user education
            $user->educations()->create([
                'user_id' => $id,
                'school' => $education['school'],
                'degree' => $education['degree'],
                'address' => $education['address'],
                'start_date' => $education['start_date'],
                'end_date' => $education['end_date'],
            ]);
        }
    }
}
