<?php

namespace App\Services;


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
}