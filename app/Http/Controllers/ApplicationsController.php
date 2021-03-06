<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationType;
use App\AuxiliaryApplication;
use App\FinancialAidType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
    // One has to be logged in.
    public function __construct()
    {
        $this->middleware('auth');
        // Only admins and staff can access this controller
        $this->middleware(function ($request, $next) {
            if (Auth::user() && (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'staff')) {
                return $next($request);
            }

            return redirect('/');
        })->except(['create', 'store', 'show']);
    }

    public function index()
    {
        $applications = Application::all();
//        return $applications;
        return View('applications.index', compact('applications'));
    }

    public function show(User $user)
    {
        $current_application = $user->application;
        $previous_applications = $user->auxiliary_application;
//        return $previous_applications;
//        $applications = Application::all();
//        $data = $applications->load('user', 'review');    // Get the applicant and review of each application
        return View('applications.show', compact('current_application', 'previous_applications'));
    }

    public function create()
    {
        $financial_aid_types = FinancialAidType::all();
        $application_types = ApplicationType::all();
        return View('applications.create', compact('financial_aid_types', 'application_types'));
    }

    /**
     * Save items to database
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
//        TODO: Shorten the length pdf/docx validation rule
        $auth_user = Auth::user();

        $app_type = ApplicationType::all();
        foreach ($app_type as $type) {
            // append the name of application type.
            $application_type = "is_" . join([$type->name]);
            $path = $type->name . join(["_upload"]);
//            print $path;
            // check if it exists in the request.
            if (array_key_exists($application_type, $request->all()) || array_key_exists($path, $request->all())) {
                //key exists, do stuff
//                echo "Application: " . $application_type . " Path: " . $path;
                // so far, so good. Now check if the value is null.
                if (($request->$application_type !== null) && ($request->$path !== null)) {
                    // If there exists both auxiliary type id and the path. Store in the auxiliary table.
                    // check if there's a file upload.
                    if ($request->hasFile($path)) {
                        $application_file = $request->file($path);
                        $application_ext = $application_file->getClientOriginalExtension();
                        $application_path = $application_file
                            ->storeAs('uploads/' . $type->name, $type->name . '-' . $auth_user->id . '.' . $application_ext);// Tested - It works: 23-08-2017 12:27 pm

                        // create a new instance of the Auxiliary Applications
                        $auxiliary_application = new AuxiliaryApplication;
                        $auxiliary_application->user_id = $auth_user->id;
                        $auxiliary_application->application_type_id = $request->$application_type;
                        $auxiliary_application->upload_path = $application_path;
                        $auxiliary_application->save();
                    }
                } else {
                    echo "NULL: " . $application_type;
                }
            }
        }

        $application_path = null;
        $application = new Application;
        $application->user_id = $auth_user->id;
        $application->request_type = $request->aid_id;
        if ($request->hasFile('application_upload')) {
            $application_file = $request->file('application_upload');
            $application_ext = $application_file->getClientOriginalExtension();
            $application_path = $application_file->storeAs('uploads/application', 'application-' . $auth_user->id . '.' . $application_ext);
        }

        $application->application_letter = $application_path;
        $application->save();

        $request->session()->flash('success_message', 'The application was successful!');

        return redirect('/applications/' . Auth::id());
    }
}
