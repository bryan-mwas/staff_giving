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
                <th>HELB</th>
                <th>HELB status</th>
                <th>HELB letter</th>
                <th>CRB</th>
                <th>CRB status</th>
                <th>CRB letter</th>
                <th>Application letter</th>
                <th>Action</th>
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
                        <td align="center"><a role="button" class="btn btn-primary btn-sm"
                                              href="{{Storage::disk('local')->url($application->helb_upload)}}"><i
                                        class="fa fa-eye" aria-hidden="true"></i> HELB</a></td>
                    @else
                        <td align="center" class="bg-faded">n/a</td>
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
                        <td align="center"><a role="button" class="btn btn-primary btn-sm"
                                              href="{{Storage::disk('local')->url($application->crb_upload)}}"><i
                                        class="fa fa-eye" aria-hidden="true"></i> CBR</a></td>
                    @else
                        <td align="center" class="bg-faded">n/a</td>
                    @endif
                    @if($application->application_upload !== null)
                        <td align="center"><a role="button" class="btn btn-primary btn-sm"
                                              href="{{Storage::disk('local')->url($application->application_upload)}}"><i
                                        class="fa fa-eye" aria-hidden="true"></i> Application</a></td>
                    @else
                        <td align="center" class="bg-faded">n/a</td>
                    @endif
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#assessment_modal{{$application->id}}">
                            Assess
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="assessment_modal{{$application->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="assessmentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="assessmentModalLabel">Assessment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col form-inline">
                                                    <label for="example-text-input" class="mr-sm-2">Student Name</label>
                                                    <input class="form-control" type="text"
                                                           value="{{$application->user->name}}" id="stud_name" readonly>
                                                </div>
                                                <div class="col form-inline">
                                                    <label for="example-text-input" class="mr-sm-2">Requested
                                                        Aid</label>
                                                    <input class="form-control" type="text"
                                                           value="{{$application->fund_type}}" id="stud_" readonly>
                                                </div>
                                            </div>
                                            <hr>
                                            <!--TODO: Review this modal layout -->
                                            <form method="post" action="/approve">
                                                <div class="row">
                                                    <div class="col-md-11 form-group">
                                                        <label for="background_history">Background Information</label>
                                                        <textarea type="text" class="form-control" name="background"
                                                                  id="background_history" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-11 form-group">
                                                        <label for="">Approval</label>
                                                        <select class="form-control" name="status" id="">
                                                            <option selected>Choose one</option>
                                                            <option value="accepted">Accept</option>
                                                            <option value="pending">Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
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