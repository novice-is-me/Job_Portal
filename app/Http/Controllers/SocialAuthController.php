<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterService;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
   
    public function index () {
        return Inertia::render('Auth/Login');
    }

    public function register(RegisterService $registerService){
        // Validate the request first
        $validatedData = $registerService->validated();

        // Create a new user
        if($validatedData){
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'user_type' => $validatedData['user_type'],
            ]);

            if($user){
                // Login the user first to authenticate and redirect to dashboard
                Auth::login($user);
                return redirect()->route('dashboard');
            }else{
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }

    public function login(LoginRequest $request){
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
