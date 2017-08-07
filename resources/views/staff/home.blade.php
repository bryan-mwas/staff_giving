@extends('layouts.master')

@section('title', 'Applications View')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
@section('content')
    <br>
    <br>
    <fieldset>
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
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
                <tr>
                    <td>{{$application->user_id}}</td>
                    <td>{{$application->user->name}}</td>
                    <td>{{$application->fund_type}}</td>
                    <td><a class="btn btn-primary btn-sm" href="{{url('applications/review/'.$application->id)}}">Assess</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </fieldset>
@endsection
@section('footer')
    <script type="application/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
@endsection