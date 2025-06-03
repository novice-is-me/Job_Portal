<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type)
    {
        // Call the user
        $user = Auth::user();

        if(!$user) {
            // If the user is not authenticated, redirect to login or handle accordingly
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }

        if ($user->user_type != $type) {
            return abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
