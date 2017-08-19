<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
    // One has to be logged in.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return View('students.apply', compact('apps'));
    }

    /**
     * Save items to database
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
//        TODO: Shorten the length pdf/docx validation rule
//        Validate the form fields
        $this->validate($request, [
            'aid_id' => 'required',
            'helb' => 'required',
            'helb_status' => 'required',
            'crb' => 'required',
            'crb_status' => 'required',
            'application_upload' => 'required',
        ]);

        $application = new Application;
        $auth_user = Auth::user();

        $helb_path = null;
        $crb_path = null;
        $application_path = null;

        if ($request->hasFile('helb_upload')) {
            $helb = $request->file('helb_upload');
            $helb_ext = $helb->getClientOriginalExtension();    // Safe type value. Extracted from the request from which the file's uploaded
            $helb_path = $helb->storeAs('/uploads/helb', $auth_user->id . '-helb.' . $helb_ext);
        }

        if ($request->hasFile('crb_upload')) {
            $crb = $request->file('crb_upload');
            $crb_ext = $crb->getClientOriginalExtension();
            $crb_path = $crb->storeAs('uploads/crb', $auth_user->id . '-crb.' . $crb_ext);
        }


        if ($request->hasFile('application_upload')) {
            $application_file = $request->file('application_upload');
            $application_ext = $application_file->getClientOriginalExtension();
            $application_path = $application_file->storeAs('uploads/application', $auth_user->id . '-application.' . $application_ext);
        }


        $application->user_id = $auth_user->id;
        $application->aid_id = $request->aid_id;
        $application->helb = $request->helb;
        $application->helb_status = $request->helb_status;
        $application->helb_upload = $helb_path;
        $application->crb = $request->crb;
        $application->crb_status = $request->crb_status;
        $application->crb_upload = $crb_path;
        $application->application_upload = $application_path;

        $application->save();

        $request->session()->flash('success_message', 'The application was successful!');

        return redirect('applications');
    }
}
