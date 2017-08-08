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
    <!-- Nav tabs -->
    <ul class="nav nav-tabs tab-btm-margin" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#new_applications" role="tab">New Applications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#accepted_applications" role="tab">Accepted</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pending_applications" role="tab">Rejected</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="new_applications" role="tabpanel">
            {{--<fieldset style="margin-top: 20px; padding: 0px;">--}}
                <table id="tbl-applications" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student name</th>
                        <th>Request</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $application)
                        @if($application->review->stage == 'submitted')
                        <tr>
                            <td>{{$application->user_id}}</td>
                            <td>{{$application->user->name}}</td>
                            <td>{{$application->fund_type}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{url('applications/review/'.$application->id)}}">Assess</a></td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            {{--</fieldset>--}}
        </div>
        <div class="tab-pane" id="accepted_applications" role="tabpanel">
            <table id="tbl-accepted" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student name</th>
                    <th>Request</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $application)
                    @if($application->review->status == 'accepted')
                        <tr>
                            <td>{{$application->user_id}}</td>
                            <td>{{$application->user->name}}</td>
                            <td>{{$application->fund_type}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{url('applications/review/'.$application->id)}}">Assess</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="pending_applications" role="tabpanel">
            <table id="tbl-pending" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student name</th>
                    <th>Request</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $application)
                    @if($application->review->status == 'rejected')
                        <tr>
                            <td>{{$application->user_id}}</td>
                            <td>{{$application->user->name}}</td>
                            <td>{{$application->fund_type}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{url('applications/review/'.$application->id)}}">Assess</a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    <script type="application/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tbl-applications').DataTable({
                responsive: true
            });
            $('#tbl-accepted').DataTable({
                responsive: true
            });
            $('#tbl-pending').DataTable({
                responsive: true
            });
        });
    </script>
@endsection