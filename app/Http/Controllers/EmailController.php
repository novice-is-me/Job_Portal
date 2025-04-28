<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    
    public function subscribe(Request $request, $id){
        
        $recipient_email = $request->input('email');

        $name = User::find($id)->name;

        Mail::to($recipient_email)->send(new SubscribeEmail( $name));

    }
}
