@extends('layouts.master')
@section('title', 'Application Review')
@section('styles')
    <style>
        .no-bottom-pad {
            padding-bottom: 0px;
        }
    </style>
@endsection
@section('content')
    <br>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Applicant's Information
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item no-bottom-pad"><h6>Student Name: <span class="badge badge-default"
                                                                              style="font-size: 14px;">{{$application->user->name}}</span>
                </h6></li>
            <li class="list-group-item no-bottom-pad"><h6>Student Email: <span class="badge badge-default"
                                                                               style="font-size: 14px;">{{$application->user->email}}</span>
                </h6></li>
            <li class="list-group-item no-bottom-pad"><h6>Requested Funds: <span class="badge badge-default"
                                                                                 style="font-size: 14px;">{{strtoupper($application->fund_type)}}</span>
                </h6></li>
        </ul>
    </div>
    <br>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Attachments
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item no-bottom-pad">
                <h6>Application Letter:
                    <a class="btn btn-primary btn-sm"
                       href="{{Storage::disk('local')->url($application->application_upload)}}">
                        <i class="fa fa-eye" aria-hidden="true"></i> Application
                    </a>
                </h6>
            </li>
            {{--ONLY SHOW LINK TO DOWNLOAD/VIEW HELB UPLOAD IF APPLICANT HAD APPLIED AND WAS GRANTED HELB--}}
            @if($application->helb && $application->helb_status)
                <li class="list-group-item no-bottom-pad">
                    <h6>HELB Letter:
                        <a class="btn btn-primary btn-sm"
                           href="{{Storage::disk('local')->url($application->helb_upload)}}">
                            <i class="fa fa-eye" aria-hidden="true"></i> HELB
                        </a></h6></li>
            @endif
            {{--ONLY SHOW LINK TO DOWNLOAD/VIEW CRB UPLOAD IF APPLICANT HAD APPLIED AND WAS GRANTED CRB--}}
            @if($application->crb && $application->crb_status)
                <li class="list-group-item no-bottom-pad">
                    <h6>CRB Letter:
                        <a class="btn btn-primary btn-sm"
                           href="{{Storage::disk('local')->url($application->crb_upload)}}">
                            <i class="fa fa-eye" aria-hidden="true"></i> CRB
                        </a>
                    </h6></li>
            @endif
        </ul>
    </div>
    <br>
    <!-- OFFICIAL USE SECTION -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            For Official Use
        </div>
        <div class="card-block">
            <form method="post" action="/application/review">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="commentArea"><h6>Comments on the application</h6></label>
                    <textarea id="commentArea" class="form-control" cols="50" rows="5" name="comments"></textarea>
                </div>
                <div class="form-group">
                    <label for="commentArea"><h6>Approval Status</h6></label>
                    {{--<br>--}}
                    {{--<label class="custom-control custom-radio">--}}
                        {{--<input id="radio1" name="status" type="radio" class="custom-control-input">--}}
                        {{--<span class="custom-control-indicator"></span>--}}
                        {{--<span class="custom-control-description">Accepted</span>--}}
                    {{--</label>--}}
                    {{--<label class="custom-control custom-radio">--}}
                        {{--<input id="radio2" name="status" type="radio" class="custom-control-input">--}}
                        {{--<span class="custom-control-indicator"></span>--}}
                        {{--<span class="custom-control-description">Rejected</span>--}}
                    {{--</label>--}}
                    <select name="status" id="" class="form-control">
                        <option selected>Select One</option>
                        <option value="accepted">Accept</option>
                        <option value="rejected">Reject</option>
                    </select>
                </div>
                <input type="hidden" value="{{$application->review->id}}" name="application_review_id">
                <button type="submit" class="btn btn-primary">Submit</button>
                @include('layouts.errors')
            </form>
        </div>
    </div>
    <!-- END OF OFFICIAL USE SECTION -->
    <form>
    </form>
@endsection