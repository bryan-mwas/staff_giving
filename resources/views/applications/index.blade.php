@extends('layouts.master')

@section('title', 'Applications View')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
@section('styles')
    <style>
        .tab-btm-margin {
            margin-bottom: 20px;
        }
    </style>
@endsection
@section('content')
    <br>

    <div id="accordion">
        @if(Auth::user()->role->name == 'staff')
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accepted
                        </a>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne"
                     data-parent="#accordion">
                    <div class="card-body">
                        <table id="tbl-new-applications" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student name</th>
                                <th>Request</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                @if($application->stage == 'submitted')
                                    <tr>
                                        <td>{{$application->user->id}}</td>
                                        <td>{{$application->user->name}}</td>
                                        <td>{{$application->financial_aid_type->name}}</td>
                                        <td><a class="btn btn-primary btn-sm"
                                               href="{{url('/financial-aid/recommend/'.$application->id)}}">Assess</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->role->name == 'admin')
            <div class="card">
                <div class="card-header" role="tab" id="headingTwo">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            New Applications
                        </a>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo"
                     data-parent="#accordion">
                    <div class="card-body">
                        <table id="tbl-unseen-applications" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student name</th>
                                <th>Request</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                @if($application->stage == 'review')
                                    <tr>
                                        <td>{{$application->user->id}}</td>
                                        <td>{{$application->user->name}}</td>
                                        <td>{{$application->financial_aid_type->name}}</td>
                                        <td><a class="btn btn-primary btn-sm"
                                               href="{{url('/committee/recommend/'.$application->id)}}">Assess</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingThree">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseThree" aria-expanded="true"
                           aria-controls="collapseThree">
                            Accepted Applications
                        </a>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse show" role="tabpanel" aria-labelledby="headingThree"
                     data-parent="#accordion">
                    <div class="card-body">
                        <table id="tbl-unseen-applications" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student name</th>
                                <th>Request</th>
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                @if($application->stage == 'complete' && $application->staff_committee_recommendation->recommendation == 'accepted')
                                    <tr>
                                        <td>{{$application->user->id}}</td>
                                        <td>{{$application->user->name}}</td>
                                        <td>{{$application->financial_aid_type->name}}</td>
                                        {{--<td><a class="btn btn-primary btn-sm"--}}
                                        {{--href="{{url('/committee/recommend/'.$application->id)}}">Assess</a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header" role="tab" id="headingFour">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#collapseFour" aria-expanded="true"
                           aria-controls="collapseFour">
                            Rejected Applications
                        </a>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse show" role="tabpanel" aria-labelledby="headingFour"
                     data-parent="#accordion">
                    <div class="card-body">
                        <table id="tbl-unseen-applications" class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student name</th>
                                <th>Request</th>
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $application)
                                @if($application->stage == 'complete' && $application->staff_committee_recommendation->recommendation == 'accepted')
                                    <tr>
                                        <td>{{$application->user->id}}</td>
                                        <td>{{$application->user->name}}</td>
                                        <td>{{$application->financial_aid_type->name}}</td>
                                        {{--<td><a class="btn btn-primary btn-sm"--}}
                                        {{--href="{{url('/committee/recommend/'.$application->id)}}">Assess</a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
@section('footer')
    <script type="application/javascript"
            src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tbl-new-applications').DataTable({
                responsive: true
            });
            $('#tbl-accepted-applications').DataTable({
                responsive: true
            });
            $('#tbl-rejected-applications').DataTable({
                responsive: true
            });
            $('#tbl-unseen-applications').DataTable({
                responsive: true
            });
        });
    </script>
@endsection