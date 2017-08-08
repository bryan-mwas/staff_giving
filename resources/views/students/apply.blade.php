@extends('layouts.master')

@section('title', 'Apply')

@section('content')
<br/>
<br/>
<form method="post" action="/apply" enctype="multipart/form-data">
    {{ csrf_field() }}
  <fieldset class="col-md-8 offset-md-2 justify-content-center">
      <div class="card">
          <div class="card-header text-center">
              <h5>Application Form</h5>
          </div>
          <div class="card-block">
              <div class="form-group">
                  <label class="col-form-label" for="fundType">Which type of fund do you seek?</label>
                  <select class="form-control" name="aid_id" id="fundType" required>
                      <option selected value="">Select</option>
                      <option value="1">Accommodation</option>
                      <option value="2">Fees</option>
                      <option value="3">Stipend</option>
                  </select>
              </div>
              <div class="form-group">
                  <label class="col-form-label" for="applied_helb">Have you applied for a HELB Loan?</label>
                  <select class="form-control" name="helb" id="applied_helb" required>
                      <option selected value="">Select</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
              </div>
              <div id="helbStatus" class="form-group" hidden>
                  <label class="col-form-label" for="status_helb">Helb Status</label>
                  <select class="form-control" name="helb_status" id="status_helb" required>
                      <option selected value="">Select</option>
                      <option value="1">Granted</option>
                      <option value="0">Not granted</option>
                  </select>
              </div>
              <div id="helb_letter" class="form-group" hidden>
                  <label class="col-form-label">HELB letter</label>
                  <div class="form-group">
                      <input type="file" class="form-control" id="helbUpload" aria-describedby="fileHelp" name="helb_upload">
                      <small id="fileHelp" class="form-text text-muted">Upload your HELB letter here.</small>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-form-label" for="crb">Have you applied for a CRB?</label>
                  <select required class="form-control" name="crb" id="applied_crb">
                      <option selected value="">Select</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
              </div>
              <div id="crbStatus" class="form-group" hidden>
                  <label class="col-form-label" for="crb_status">CRB Status</label>
                  <select class="form-control" name="crb_status" id="status_crb" required>
                      <option selected value="">Select</option>
                      <option value="1">Granted</option>
                      <option value="0">Not granted</option>
                  </select>
              </div>
              <div id="crb_letter" class="form-group" hidden>
                  <label class="col-form-label">CRB letter</label>
                  <div class="form-group">
                      <input type="file" class="form-control" id="cbrUpload" aria-describedby="fileHelp" name="crb_upload">
                      <small id="fileHelp" class="form-text text-muted">Upload your CRB letter here.</small>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-form-label">Upload Application</label>
                  <div class="form-group">
                      <input required type="file" class="form-control" id="applicationUpload" aria-describedby="fileHelp" name="application_upload">
                      <small id="fileHelp" class="form-text text-muted">Upload your application letter here.</small>
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
        $(document).ready(function(){
            // Get selected helb option
            $( "#applied_helb" ).change(function() {
//                find the value of selected option
                $('#status_helb').prop("disabled", false);
                var val = $('#applied_helb').find(":selected").val();
                if(val == 1) {
                    $('#helbStatus').removeAttr('hidden');
                    $('#status_helb').val('null');
                }
                else {
                    $('#helbStatus').removeAttr('hidden');
                    $('#status_helb').val('0');
                }
            });
            // Get selected crb option
            $("#applied_crb").change(function () {
                $('#status_crb').prop("disabled", false);
                var val = $('#applied_crb').find(":selected").val();
                if(val == 1) {
                    $('#crbStatus').removeAttr('hidden');
                    $('#status_crb').val('null');
                }
                else {
                    $('#crbStatus').removeAttr('hidden');
                    $('#status_crb').val('0');
                }
            });
            // if granted helb, attach proof.
            $("#status_helb").change(function () {
                var val = $("#status_helb").find(":selected").val();
                if(val == 1) {
                    $("#helb_letter").removeAttr('hidden');
                }
                else {
                    $("#helb_letter").attr('hidden',true);
                }
            });
            // if granted crb, attach proof
            $("#status_crb").change(function () {
                var val = $("#status_crb").find(":selected").val();
                if(val == 1) {
                    $("#crb_letter").removeAttr('hidden');
                }
                else {
                    $("#crb_letter").attr('hidden',true);
                }
            });
        });
    </script>
@endsection