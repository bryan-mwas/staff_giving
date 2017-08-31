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
        @foreach($current_application as $app)
            <h5 class="card-header bg-primary text-white">Application Number: {{$app->id}}</h5>
            {{-- TODO: Configure this progress bar --}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"--}}
            {{--aria-valuemin="0" aria-valuemax="100">25%--}}
            {{--</div>--}}
            {{--</div>--}}

            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="padding-bottom: 0px;">
                    <h5>Application Review Progress:
                        <span class="badge badge-success">{{strtoupper($app->stage)}}</span>
                    </h5>
                </li>
                <li class="list-group-item no-bottom-pad" style="padding-bottom: 0px;">
                    <h6>Aid Request:
                        <span class="badge badge-primary"
                              style="font-size: 16px;">{{ucfirst($app->financial_aid_type->name)}}</span>
                    </h6>
                </li>
                <li class="list-group-item no-bottom-pad" style="padding-bottom: 0px;">
                    <h6>Application Letter:
                        <a class="btn btn-primary btn-sm"
                           href="{{Storage::disk('local')->url($app->application_letter)}}">
                            <i class="fa fa-eye" aria-hidden="true"></i> Application
                        </a>
                    </h6>
                </li>
                @endforeach
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
    </div>
    <hr>
    <div class="row">
        <a href="/applications/create" class="mx-auto btn btn-info">New Application</a>
    </div>
@endsection