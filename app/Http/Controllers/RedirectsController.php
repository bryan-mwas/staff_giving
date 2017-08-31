<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectsController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        // redirects a user to a specific view based on the role
        if ($user->role->name == 'student') {
            if (Auth::user()->application != null) {
                $app_attempt = Auth::user()->application->where('user_id', Auth::id())->count();
                // If you've made an attempt. Show previous application details.
                if ($app_attempt > 0) {
                    return redirect('/applications/' . Auth::id());
                }
            }
            return redirect('applications/create');
        } else {
            return redirect('applications');
        }
    }
}
