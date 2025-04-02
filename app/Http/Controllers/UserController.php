<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;


class UserController extends Controller
{
    //

    public $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Response
    {

        return Inertia::render('Profile/Index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function edit(): Response
    {

        $user = User::with([
            'workExperiences',
            'educations',
        ])
        ->where('id', Auth::id())
        ->get();

        // dd($user);
        return Inertia::render('Profile/Edit', [
            'user' => $user,
        ]);
    }

    public function updateBasicInformation(ProfileUpdateRequest $request)
    {
        $validatedData = $request->all();

        $this->userService->updateUser($validatedData, Auth::user()->id);
    }

    public function updateWorkExp(Request $request){

        $this->userService->updateWorkExp($request, Auth::user()->id);
    }

    public function updateEducation(Request $request){
        $this->userService->updateEducation($request, Auth::user()->id);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
