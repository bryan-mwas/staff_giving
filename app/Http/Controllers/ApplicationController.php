<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // One has to be logged in.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {    
        return View('application.index',compact('apps'));
    }

    /**
     * Save items to database
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fund_type' => 'required',
            'helb' => 'required',
            'helb_status' => 'required',
            'crb' => 'required',
            'crb_status' => 'required'
        ]);
        $application = new Application;
        $auth_user = Auth::user();

        $helb_path = null;
        $crb_path = null;
        $application_path = null;

        if($request->hasFile('helb_upload')) {
            $helb = $request->file('helb_upload');
            $helb_ext = $helb->guessClientExtension();
            $helb_path = $helb->storeAs('uploads/'.$auth_user->id, 'helb.'.$helb_ext);
        }

        if($request->hasFile('crb_upload')) {
            $crb = $request->file('crb_upload');
            $crb_ext = $crb->guessClientExtension();
            $crb_path = $crb->storeAs('uploads/'.$auth_user->id, 'crb.'.$crb_ext);
        }


        if($request->hasFile('application_upload')){
            $application_file = $request->file('application_upload');
            $application_ext = $application_file->guessClientExtension();
            $application_path = $application_file->storeAs('uploads/'.$auth_user->id, 'application.'.$application_ext);
        }

        $application->user_id = $auth_user->id;
        $application->fund_type = $request->fund_type;
        $application->helb = $request->helb;
        $application->helb_status = $request->helb_status;
        $application->helb_upload = $helb_path;
        $application->crb = $request->crb;
        $application->crb_status = $request->crb_status;
        $application->crb_upload = $crb_path;
        $application->application_upload = $application_path;

        $request->session()->flash('success_message', 'The application was successful!');

        $application->save();

        return back();
    }
}
