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
}
