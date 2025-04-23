<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserApplication;
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

        $user = Auth::user();

        $user->load([
            'workExperiences',
            'educations',
            'skills.skill',
        ]);

        $job_applications = UserApplication::where('user_id', Auth::user()->id)
            ->with(['job.company'])
            ->get();

        return Inertia::render('Profile/Index', [
            'user' => Auth::user(),
            'job_applications' => $job_applications,
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
            'skills'
        ])
        ->where('id', Auth::id())
        ->get();

        // $skills = Skill::all();
        // dd($skills);
        // dd($user);
        return Inertia::render('Profile/Edit', [
            'user' => $user,
            'skills' => Skill::all(),
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

    public function updateSkills(Request $request, $id){
        \Log::info('updateSkills called', [
            'user_id' => Auth::user()->id,
            'data' => $request->all(),
        ]);
            
        // Get the skills from the request, defaulting to an empty array if not present
        $skills = $request->input('skills', []);

        if (empty($skills)) {
            return response()->json(['error' => 'No skills provided'], 400);
        }

        try {
            // Pass the array of skill IDs to the service method
            $this->userService->updateSkills($skills, Auth::user()->id);
            return response()->json(['message' => 'Skills updated successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error updating skills', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update skills'], 500);
        }
    }

    public function addSkill(Request $request){
        \Log::info('addSkill called', [
            'data' => $request->all(),
        ]);

        $new_skills = $request->input('name', []);

        try {
            // Pass the array of skill IDs to the service method
            $this->userService->addSkill($new_skills);
            return response()->json(['message' => 'Skills added successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error adding skills', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to add skills'], 500);
        }
    }

    public function addDocuments(Request $request){
        \Log::info('addDocuments called', [
            'data' => $request->all(),
        ]);

        try {
            $this->userService->addDocuments($request, Auth::user()->id);
            return response()->json(['message' => 'Documents added successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error('Error adding documents', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to add documents'], 500);
        }
    }

    public function updateSocial(Request $request){
        // dd($request->all());

        try {
            $this->userService->updateSocial($request, Auth::user()->id);
            return redirect()->back()->with('message', 'Social links updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating social links', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to update social links');
        }
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
