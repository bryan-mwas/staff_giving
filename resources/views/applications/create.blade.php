@extends('layouts.master')

@section('title', 'Apply')

@section('content')
    <br/>
    <br/>
    <form method="post" action="/applications" enctype="multipart/form-data">
        {{ csrf_field() }}
        <fieldset class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header text-center">
                    <h5>Application Form</h5>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label class="col-form-label" for="fundType">
                            <h6>Which type of fund do you seek?</h6>
                        </label>
                        <select class="form-control" name="aid_id" id="fundType" required>
                            <option selected>Select</option>
                            @foreach($financial_aid_types as $request)
                                <option value="{{$request->id}}">{{$request->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="fundType">
                            <h6>Have you applied for any kind of financial aid before? <i>(Optional)</i></h6>
                        </label>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <th>Name</th>
                                <th>Granted</th>
                                <th>Upload Attachment</th>
                            </thead>
                            @foreach($application_types as $previous)
                            <tr>
                                <td>{{ucfirst($previous->name)}}</td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="{{'is_'.$previous->name}}" id="inlineRadio1" value="{{$previous->id}}"> Yes
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="{{'is_'.$previous->name}}" id="inlineRadio2" value=""> No
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <input required type="file" class="form-control" id="{{$previous->name}}_upload"
                                               aria-describedby="fileHelp" name="{{$previous->name.'_upload'}}"
                                               accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document" disabled>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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

            function clearFileInput(id)
            {
                var oldInput = document.getElementById(id);

                var newInput = document.createElement("input");

                newInput.type = "file";
                newInput.id = oldInput.id;
                newInput.name = oldInput.name;
                newInput.className = oldInput.className;
                newInput.style.cssText = oldInput.style.cssText;
                // TODO: copy any other relevant attributes

                oldInput.parentNode.replaceChild(newInput, oldInput);
            }

            $(".form-check-input").click(function () {
                $(this).each(function () {
                    var id = $(this).attr('id');
                    var name = $(this).attr('name');
                    var radioValue = $("input[name='"+name+"']:checked").val();
                    console.log(radioValue);
                    if(radioValue !== '') {
//                        console.log('Good Job');
                        $("#"+name.substring(3)+"_upload").prop('disabled',false);
                    }
                    else {
                        clearFileInput(name.substring(3)+"_upload");
                        $("#"+name.substring(3)+"_upload").prop('disabled',true);
                    }
                });
            });
        });
    </script>
@endsection