<?php

namespace App\Http\Controllers;

use App\Application;
use App\FinancialAidType;
use App\StaffCommitteeRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffCommitteeRecommendationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::all();
//        $data = $applications->load('user', 'review');    // Get the applicant and review of each application

        return View('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'comments' => 'required',
        ]);

        $application_review = new StaffCommitteeRecommendation;
        $financial_aid_type = FinancialAidType::findOrFail($request->financial_aid_type_id);

        $application_review->comments = $request->comments;
        $application_review->recommendation = $request->recommendation;
        $application_review->application_id = $request->application_id;
        $application_review->user_id = Auth::id();

        // The date of effectivity is done programmatically.
//        $application_review->effective_date = Carbon::now()->addWeek()->toDateString();
//        $application_review->expiry_date = Carbon::now()->addMonths($financial_aid_type->months_valid)->toDateString();

        $application_review->save();

        $request->session()->flash('success_message', 'The recommendation has been saved successfully');

        return redirect()->to('/applications');
    }

    /**
     * Display the specified resource.
     *
     * @param Application $application
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Application $application)
    {

        $previous_applications = $application->user->auxiliary_application;

        return View('recommendations.staff_committee.create', compact('application', 'previous_applications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
