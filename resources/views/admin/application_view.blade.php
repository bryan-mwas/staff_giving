@extends('layouts.admin')
@section('content')
    <br>
    <br>
    <fieldset>
        <table id="example" class="table table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Student ID</th>
                <th>Student name</th>
                <th>Request</th>
                <th>HELB</th>
                <th>HELB status</th>
                <th>HELB letter</th>
                <th>CRB</th>
                <th>CRB status</th>
                <th>CRB letter</th>
                <th>Application letter</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $application)
                <tr>
                    <td>{{$application->user_id}}</td>
                    <td>{{$application->user->name}}</td>
                    <td>{{$application->fund_type}}</td>
                    @if($application->helb)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    @if($application->helb_status)
                        <td>Granted</td>
                    @else
                        <td>Not Granted</td>
                    @endif
                    @if($application->helb_upload !== null)
                        <td><a href="{{Storage::disk('local')->url($application->helb_upload)}}">View HELB</a></td>
                    @else
                        <td>n/a</td>
                    @endif
                    @if($application->crb)
                        <td>Yes</td>
                    @else
                        <td>No</td>
                    @endif
                    @if($application->crb_status)
                        <td>Granted</td>
                    @else
                        <td>Not Granted</td>
                    @endif

                    @if($application->crb_upload !== null)
                        <td><a href="{{Storage::disk('local')->url($application->crb_upload)}}">View CBR</a></td>
                    @else
                        <td>n/a</td>
                    @endif
                    @if($application->application_upload !== null)
                        <td><a href="{{Storage::disk('local')->url($application->application_upload)}}">View Application</a></td>
                    @else
                        <td>n/a</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </fieldset>
@endsection
@section('footer')
    <script type="application/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection