<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\User;
use App\Models\UserSkill;
use Exception;
use Illuminate\Support\Facades\Log;

class UserServices {

    public function updateUser ($request, $id) {
        try {
            // Find the user
            $user = User::find($id);

            $user_profile = null;
            
            if($request['profile_icon']){

                $user_profile = $this->storeImageIcon($request['profile_icon'], $id, 'profile');
            }

            // Update the user
            if($user){
                 $send = $user->update([
                    'name' => $request['full_name'],
                    'age' => $request['age'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'introduction' => $request['summary'],
                    'headline' => $request['profession'],
                    'address' => $request['location'],
                    'profile_picture' => $user_profile ?? $user->profile_picture,
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

    public function updateInformation ($request, $id){

        try {
            $user = User::find($id);

            if($user){
                $user->update([
                    'name' => $request['name'],
                    'headline' => $request['title'],
                    'address' => $request['location']
                ]);
            
            } 
        } catch (Exception $e) {
            Log::error('Error updating user information: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong, please try again']);
        }
    }

    public function updateWorkExp ($request, $id) {

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

    public function updateSkills($skills, $id)
    {
        // Find the user
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Delete existing skills for the user
        $user->skills()->delete();

        // Add the new skills (IDs) to the user's skill relationship
        foreach ($skills as $skillId) {
            $user->skills()->create([
                'user_id' => $id,
                'skill_id' => $skillId, 
            ]);
        }

        return response()->json(['message' => 'User skill updated successfully']);
    }

    public function addSkill($request){
        
        // Adding new skills
        if($request){
            Skill::create([
                'name' => $request,
            ]);
        }

        return response()->json(['message' => 'New Skills added successfully']);
    }

    public function addDocuments($request, $id)
    {
        // Destructure the request
        $resume = $request->file('resume');
        $cover_letter = $request->file('coverLetter');
        
        $resumePath = null;
        $coverLetterPath = null;

        // dd($resume, $cover_letter);
        if ($resume) {
            // Store the resume in the specified folder
            $resumePath = $this->storeFile( $resume, $id, 'resume' );
        }

        if ($cover_letter) {
            // Store the cover letter in the specified folder
            $coverLetterPath = $this->storeFile($cover_letter, $id, 'cover_letter' );
        }

        // Find the user
        $user = User::find($id);

        $user->update([
            'resume' => $resumePath ?? $user->resume ,
            'cover_letter' => $coverLetterPath ?? $user->cover_letter,
        ]);

        return response()->json(['message' => 'Documents added successfully']);
    }


    private function storeFile($file, $id, $folder)
    {
        // Get the file's extension
        $extension = $file->getClientOriginalExtension();
        
        // Generate a unique file name using the userId, file type, and the current timestamp
        $fileName = $file->getClientOriginalName();
        
        // Store the file in the specified folder within the 'public' disk
        $filePath = $file->storeAs("{$id}/{$folder}", $fileName, 'public');
        // dd($filePath);
        // // Return the file path
        return $filePath;
    }

    public function storeImageIcon($file, $id, $folder){
            
            // Get the file's extension
            $extension = $file->getClientOriginalExtension();
            
            // Generate a unique file name using the userId, file type, and the current timestamp
            $fileName = $file->getClientOriginalName();
            
            // Store the file in the specified folder within the 'public' disk
            $filePath = $file->storeAs("{$id}/{$folder}", $fileName, 'public');
            
            // Return the file path
            return $filePath;
    }

    public function updateSocial($request, $id){

        try {
            $user = User::find($id);

            if ($user){
                $user->update([
                    'website' => $request['personal_website'],
                    'github' => $request['github'],
                    'linkedin' => $request['linkedin'],
                    'portfolio' => $request['portfolio'],
                ]);
            }

            redirect()->back()->with('message', 'Social links updated w!');
        } catch (Exception $e) {
            Log::error('Error updating social links: ' . $e->getMessage());
            redirect()->back()->with('error', 'Failed to update social links');
        }
    }


}
