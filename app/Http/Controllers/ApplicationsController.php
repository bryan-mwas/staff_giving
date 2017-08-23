<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationType;
use App\AuxiliaryApplication;
use App\FinancialAidType;
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
        $applications = Application::all();
        $data = $applications->load('user', 'review');    // Get the applicant and review of each application
        return View('applications.index', compact('data'));
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
//        Validate the form fields
//        $this->validate($request, [
//            'aid_id' => 'required',
//            'helb' => 'required',
//            'helb_status' => 'required',
//            'crb' => 'required',
//            'crb_status' => 'required',
//            'application_upload' => 'required',
//        ]);

//        $application = new Application;
        $auth_user = Auth::user();
//
//        $helb_path = null;
//        $crb_path = null;
//        $application_path = null;
//
//        if ($request->hasFile('helb_upload')) {
//            $helb = $request->file('helb_upload');
//            $helb_ext = $helb->getClientOriginalExtension();    // Safe type value. Extracted from the request from which the file's uploaded
//            $helb_path = $helb->storeAs('/uploads/helb', $auth_user->id . '-helb.' . $helb_ext);
//        }
//
//        if ($request->hasFile('crb_upload')) {
//            $crb = $request->file('crb_upload');
//            $crb_ext = $crb->getClientOriginalExtension();
//            $crb_path = $crb->storeAs('uploads/crb', $auth_user->id . '-crb.' . $crb_ext);
//        }
//
//
//        if ($request->hasFile('application_upload')) {
//            $application_file = $request->file('application_upload');
//            $application_ext = $application_file->getClientOriginalExtension();
//            $application_path = $application_file->storeAs('uploads/application', $auth_user->id . '-application.' . $application_ext);
//        }
//
//
//        $application->user_id = $auth_user->id;
//        $application->aid_id = $request->aid_id;
//        $application->helb = $request->helb;
//        $application->helb_status = $request->helb_status;
//        $application->helb_upload = $helb_path;
//        $application->crb = $request->crb;
//        $application->crb_status = $request->crb_status;
//        $application->crb_upload = $crb_path;
//        $application->application_upload = $application_path;
//
//        $application->save();
//
//        $request->session()->flash('success_message', 'The application was successful!');
//
//        return redirect('applications');
//
//        foreach($request->all() as $key => $value) {
//            echo $key.' ';
////                if(substr($key,0,-7) == substr($key,3)) {
////                    echo 'Aye';
////                }
//        }
//
//        foreach ($app_type as $type) {
//            echo $type->name;
//        }
//        $length = count($app_type);
//        for ($i = 0; $i < $length; $i++) {
//            echo $app_type->name;
//        }
//        return $request->all();
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
                        $application_path = $application_file->storeAs('uploads/'.$type->name, $type->name.'-'.$auth_user->id.'.'. $application_ext); // Tested - It works: 23-08-2017 12:27 pm

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
//                return $request->$path;
            }
        }

        $application_path = null;
        $application = new Application;
        $application->user_id = $auth_user->id;
        $application->request_type = $request->aid_id;
        if ($request->hasFile('application_upload')) {
            $application_file = $request->file('application_upload');
            $application_ext = $application_file->getClientOriginalExtension();
            $application_path = $application_file->storeAs('uploads/application', 'application-'.$auth_user->id.'.'. $application_ext);
        }

        $application->application_letter = $application_path;
        $application->save();

        $request->session()->flash('success_message', 'The application was successful!');

        return redirect()->back();

//        if(array_key_exists('is_crb', $request->all())) {
//            //key exists, do stuff
//            print 'Kuna kitu';
//        }
//        if(array_key_exists('is_helb', $request->all())) {
//            print "\n"."Yeah";
//        }
//
//        foreach( $request->all() as $key => $value) {
//            echo $key. " => ". $value. "" ;
//        }
//        echo substr('crb_upload',0,-7);
    }
}
