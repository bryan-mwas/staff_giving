@extends('layouts.master')

@section('title', 'Applications View')
@section('content')
    <br>
    {{--<div class="card">--}}
    {{--<div class="card-header">--}}
    {{--The Header--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
    {{--<div class="progress">--}}
    {{--<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Application Number: {{$current_application->id}}</h4>
            <h5 style="text-align: center">Application Review Progress:
                <span class="badge badge-primary">{{strtoupper($current_application->stage)}}</span>
            </h5>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                     aria-valuemin="0" aria-valuemax="100">25%
                </div>
            </div>
            {{--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item no-bottom-pad" style="padding-bottom: 0px;">
                <h6>Aid Request:
                    <span class="badge badge-primary"
                          style="font-size: 14px;">{{ucfirst($current_application->financial_aid_type->name)}}</span>
                </h6>
            </li>
            <li class="list-group-item no-bottom-pad" style="padding-bottom: 0px;">
                <h6>Application Letter:
                    <a class="btn btn-primary btn-sm"
                       href="{{Storage::disk('local')->url($current_application->application_letter)}}">
                        <i class="fa fa-eye" aria-hidden="true"></i> Application
                    </a>
                </h6>
            </li>
            @foreach($previous_applications as $previous)
                <li class="list-group-item no-bottom-pad" style="padding-bottom: 0px;">
                    <h6>{{ucfirst($previous->application_type->name)}} Letter:
                        <a class="btn btn-primary btn-sm"
                           href="{{Storage::disk('local')->url($previous->upload_path)}}">
                            <i class="fa fa-eye" aria-hidden="true"></i> Letter
                        </a>
                    </h6>
                </li>
            @endforeach
        </ul>
        <div class="card-body">
            {{--<div class="row">--}}
                {{--<div class="col">--}}
                    {{--{{$current_application->stage}}--}}
                {{--</div>--}}
                {{--<div class="col">--}}
                    {{----}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection