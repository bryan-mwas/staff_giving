@extends('layouts.master')

@section('title', 'Apply')

@section('content')
<br/>
<br/>
<div class="form-group row">
  <label for="aid_type" class="col-2 col-form-label">Type of Funds</label>
  <div class="col-5">
    <select class="form-control" name="aid_type" id="aid_type">
      <option selected>Choose One</option>
      <option value="fees">School Fees</option>
      <option value="stipend">Stipend</option>
      <option value="accomodation">Accomodation</option>
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="amount" class="col-2 col-form-label">Amount</label>
  <div class="col-5">
    <input class="form-control" type="text" value="" name="amount">
  </div>
</div>
<div class="form-group row">
  <label for="aid_other" class="col-2 col-form-label">Other type of Aid</label>
  <div class="col-5">
    <input class="form-control" type="text" value="" name="aid_other" id="aid_other">
  </div>
</div>
<div class="form-group row">
  <label for="example-search-input" class="col-2 col-form-label">Search</label>
  <div class="col-5">
    <select class="form-control" name="aid_type" id="aid_type">
      <option selected>Choose One</option>
      <option value="1">On going</option>
      <option value="0">Complete</option>
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="upload" class="col-2 col-form-label">Upload file</label>
  <div class="col-5">
    <input class="form-control" type="file" value="" name="" id="upload">
  </div>
</div>
@endsection