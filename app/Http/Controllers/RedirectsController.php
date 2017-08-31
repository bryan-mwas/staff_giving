<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectsController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        // redirects a user to a specific view based on the role
        if($user->role->name == 'student'){
            return redirect('applications\create');
        }
        else{
            return redirect('applications');
        }
    }
}
