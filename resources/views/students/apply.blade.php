@extends('layouts.master')

@section('title', 'Apply')

@section('content')
    <br/>
    <br/>
    <form method="post" action="/apply" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Application Form</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="col-form-label" for="fundType"><h6>Which type of fund do you seek?</h6></label>
                        <select class="form-control" name="aid_id" id="fundType" required>
                            <option selected>Select</option>
                            <option value="1">Accommodation</option>
                            <option value="2">Fees</option>
                            <option value="3">Stipend</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="appliedHelb"><h6>Have you applied for a HELB Loan?</h6>
                        </label>
                        <select class="form-control" id="appliedHelb" name="helb" required>
                            <option selected>Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div id="helbStatus" class="form-group" style="display: none;">
                        <label class="col-form-label" for="helbStatusSelect"><h6>Helb Status</h6></label>
                        <select id="helbStatusSelect" class="form-control" name="helb_status" required>
                            <option selected>Select</option>
                            <option value="1">Granted</option>
                            <option value="0">Not granted</option>
                        </select>
                    </div>
                    <div id="helbLetter" class="form-group" style="display: none;">
                        <label class="col-form-label"><h6>HELB letter</h6></label>
                        <div class="form-group">
                            <input type="file" class="form-control" id="helbUpload" aria-describedby="fileHelp"
                                   name="helb_upload"
                                   accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <small id="fileHelp" class="form-text text-muted">Upload your HELB letter here.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="appliedCrb"><h6>Have you applied for a CRB?</h6></label>
                        <select id="appliedCrb" required class="form-control" name="crb">
                            <option selected value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div id="crbStatus" class="form-group" style="display: none;">
                        <label class="col-form-label" for="crbStatusSelect"><h6>CRB Status</h6></label>
                        <select id="crbStatusSelect" class="form-control" name="crb_status" required>
                            <option selected value="">Select</option>
                            <option value="1">Granted</option>
                            <option value="0">Not granted</option>
                        </select>
                    </div>
                    <div id="crb_letter" class="form-group" style="display: none;">
                        <label class="col-form-label"><h6>CRB letter</h6></label>
                        <div class="form-group {{ $errors->has('crb_upload') ? 'has-error' : '' }}">
                            <input type="file" class="form-control" id="cbrUpload" aria-describedby="fileHelp"
                                   name="crb_upload"
                                   accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <small id="fileHelp" class="form-text text-muted">Upload your CRB letter here.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><h6>Upload Application</h6></label>
                        <div class="form-group {{ $errors->has('application_upload') }}">
                            <input required type="file" class="form-control" id="applicationUpload"
                                   aria-describedby="fileHelp" name="application_upload"
                                   accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <small id="fileHelp" class="form-text text-muted">Upload your application letter here.
                            </small>
                        </div>
                    </div>
                    @include('layouts.errors')
                </div>
                <div class="card-footer text-muted">
                    <div class="form-group row justify-content-end" style="margin-bottom: auto;">
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            // Get selected helb option
            $("#appliedHelb").change(function () {
//                find the value of selected option
                var val = $('#appliedHelb').find(":selected").val();
                if (val == 1) {
                    $('#helbStatus').show();
                    $('#helbStatusSelect').val();
                }
                else {
                    $('#helbStatus').show();
                    $('#helbStatusSelect').val('0');
                }
            });
            // if granted helb, attach proof.
            $("#helbStatusSelect").change(function () {
                var val = $("#helbStatusSelect").find(":selected").val();
                if (val == 1) {
                    $("#helbLetter").show();
                }
                else {
                    $("#helbLetter").hide();
                    $("#helbLetter").replaceWith($("#helbLetter").val('').clone(true));
                }
            });
            // Get selected crb option
            $("#crbStatusSelect").change(function () {
//                $('#crbStatusSelect').prop("disabled", false);
                var val = $('#crbStatusSelect').find(":selected").val();
                if (val == 1) {
                    $('#crbStatus').show();
                    $('#crbStatusSelect').val('null');
                }
                else {
                    $('#crbStatus').show();
                    $('#crbStatusSelect').val('0');
                }
            });
            // if granted crb, attach proof
            $("#crbStatusSelect").change(function () {
                var val = $("#crbStatusSelect").find(":selected").val();
                if (val == 1) {
                    $("#crb_letter").show();
                }
                else {
                    $("#crb_letter").attr('hidden', true);
                }
            });
        });
    </script>
@endsection