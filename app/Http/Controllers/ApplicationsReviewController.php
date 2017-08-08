<?php

namespace App\Http\Controllers;

use App\Application;
use App\ApplicationReview;
use Illuminate\Http\Request;

class ApplicationsReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::all();
        $data = $applications->load('user', 'review');    // Get the applicant and review of each application
        return View('staff.home', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve a model by its primary key...
        $application = Application::findOrFail($id);
        return View('staff.review', compact('application'));
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
        $this->validate($request, [
            'comments' => 'required',
            'status' => 'required'
        ]);

        $application_review = ApplicationReview::findOrFail($request->application_review_id);

        $application_review->comments = $request->comments;
        $application_review->status = $request->status;
        $application_review->stage = 'review';
//        TODO: Determine where to place the date of effectivity
//        $application->effective_date = $request->effective_date;
//        $application->expiry_date = $request->expiry_date;

        $application_review->save();

        $request->session()->flash('success_message', 'The application review was successful');

        return redirect('/applications');
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
