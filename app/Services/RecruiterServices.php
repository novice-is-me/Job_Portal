<?php

namespace App\Services;


class RecruiterServices{

    public function updateRecruiter($request){
        dd($request->all());

        $user = auth()->user();

        if($user){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type' => 3,
            ]);
        }
    }
}