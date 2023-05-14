@extends('layouts.app')
@section('content')
{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://flatlogic.github.io/awesome-bootstrap-checkbox/demo/build.css" /> --}}
<div class="container py-5" style="margin-top:55px">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2 style="text-align: center;">Employer Registration</h2>
            <form method="POST" action="{{ route('employer.store') }}" enctype="multipart/form-data" id="my-form">
                @csrf
                <input type="hidden" name="role" value="employer">
                <div class=" form-group row" style="margin-left: 150px;">
                    <div class="col-sm-6">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input id="looking_for_job_seeker" name="employer_type" value="1" class="styled" type="radio" onClick="showHide()" required>
                            <label for="checkbox8">
                            Looking For Job Seeker
                            </label>
                        </div>
                        <!-- <input type="checkbox" name="vehicle" value="Bike" id="looking_for_job_seeker" onClick="showHide()">    Looking For Job Seeker  -->
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input id="looking_for_foreign_worker" name="employer_type" value="2" class="styled" type="radio" onClick="showHide()" required>
                            <label for="checkbox8">
                            Looking For Foreign Worker
                            </label>
                        </div>
                        <!-- <input type="checkbox" name="vehicle" value="Bike" id="looking_for_foreign_worker" onClick="showHide()">    Looking For Foreign Worker<br> -->
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input id="looking_for_domestic_maid" name="employer_type" value="3" class="styled" type="radio" onClick="showHide()" required>
                            <label for="checkbox8">
                            Looking For Domestic Maid
                            </label>
                        </div>
                        <!-- <input type="checkbox" name="vehicle" value="Bike" id="looking_for_domestic_maid" onClick="showHide()">    Looking For Domestic Maid -->
                    </div>
                    <div class="col-sm-6">
                        <div class="checkbox checkbox-info checkbox-circle">
                            <input id="looking_for_retired_person" name="employer_type" value="4" class="styled" type="radio" onClick="showHide()"required>
                            <label for="checkbox8">
                            Looking For Retired Person
                            </label>
                        </div>
                        <!-- <input type="checkbox" name="vehicle" value="Bike" id="looking_for_retired_person" onClick="showHide()">    Looking For Retired Person<br> -->
                    </div>
                </div>
                @if ($errors->has('employer_type'))
                        <strong style="color: red; margin-left: 161px;">{{ $errors->first('employer_type') }}</strong>
                @endif

                <hr id="hr_1">      
                <h4 style="text-align: center;" id="company_information">Company Information</h4>  <hr id="hr_2">     
                <div class="form-group row">
                    <div class="col-sm-6" id="company_name">
                        <label for="company_name">Company Name</label><span class="text-danger"> *</span>
                        <input type="text" name="company_name"  class="form-control" id="com_name" required placeholder="Company Name">
                    </div>
                    @if ($errors->has('company_name'))
                        <span class="invalid-feedback" role="alert" style="margin-top: 25px; margin-right: 15px;">
                            <strong>{{ $errors->first('company_name') }}</strong>
                        </span>
                    @endif
                    <div class="col-sm-3" id="registration_number">
                        <label for="roc">Registration Number</label><span class="text-danger"> *</span>
                        <input type="text" name="roc" class="form-control" id="com_registration" placeholder="Registration Number">
                            @if ($errors->has('roc'))
                                <strong style="color: red;">{{ $errors->first('roc') }}</strong>
                        @endif
                    </div>
                   
                    <div class="col-sm-3" id="telephone_number">
                        <label for="company_phone">Telephone Number</label><span class="text-danger"> *</span>
                        <input type="text" name="company_phone" class="form-control" id="com_number" required placeholder="Telephone Number">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6" id="com_country">
                        <label for="company_country">Country</label><span class="text-danger"> *</span>
                        <select name="company_country" id="company_country" required class="form-control" >
                            <option value="" disable="true" selected="true">- - - - - - - - - - - - - - - - -    Select Country - - - - - - - - - - - - - - - - -</option>
                            @foreach ($countrys as $key=> $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3" id="company_email">
                        <label for="email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert" style="margin-top: 25px; margin-right: 15px;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="com_website">
                        <label for="website">Website</label>
                        <!-- <span class="text-danger"> *</span> -->
                        <input type="text" name="website" class="form-control" id="inputWebsite" placeholder="Website">
                    </div>
                </div>


                <div class="form-group row" > 
                    <div class="col-sm-3" id="com_state">
                        <label for="state">State/Province/Division</label><span class="text-danger"> *</span>
                        <select name="company_state" id="company_state" required class="form-control">
                            <option value="" disable="true" selected="true">-------  Select State -------</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="com_city">
                        <label for="city">City</label><span class="text-danger"> *</span>
                        <select name="company_city" id="company_city" required class="form-control">
                            <option value="" disable="true" selected="true">-------  Select City -------</option> 
                        </select>
                    </div>
                    <div class="col-sm-6" id="com_address">
                        <label for="company_address">Company Address</label>
                        <input type="text" name="company_address" class="form-control"  placeholder="Company Address">
                    </div>
                    <!-- <div class="col-sm-6" id="com_logo">
                        <label for="inputContactNumber">Company Logo</label>
                        <input id="company_logo" type="file" class="form-control-file" name="company_logo" >
                        <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                    </div> -->
                </div>


                <hr id="hr_3">
                <h4 style="text-align: center;">Authorised Person</h4><hr id="hr_4">
                <div class="form-group row">
                    <div class="col-sm-6">
                            <label for="name">Contact Name</label><span class="text-danger"> *</span>
                            <input type="text" class="form-control" id="inputFirstname" name="name" required placeholder="Contact Person Name">
                        </div>
                        <div class="col-sm-3" style="display:none;" id="per_email">
                            <label for="contact_email">Contact Email</label><span class="text-danger"> *</span>
                            <input type="text" name="contact_email" class="form-control" id="cont_email" placeholder="Contact Person Email">
                        </div>
                        <div class="col-sm-3">
                            <label for="phone">Contact Number</label>
                            <input type="text" name="phone" class="form-control"  placeholder="Contact Person Number">
                        </div>
                    </div>
                <div class="form-group row" >
                    <div class="col-sm-6" id="per_country" style="display:none;">
                        <label for="country">Country</label><span class="text-danger"> *</span>
                        <select name="country" class="form-control" id="person_country">
                            <option value="0">- - - - - - - - - - - - - - - - -    Select Country - - - - - - - - - - - - - - - - -</option>
                            @foreach ($countrys as $country)
                                <option value="{{$country->id}}" {{$country->id == old('company_country') ? 'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3" id="per_state" style="display:none;">
                        <label for="inputState">State/Province/Division</label><span class="text-danger"> *</span>
                        <select name="state" class="form-control" id="person_state">
                            <option value="">-------  Select State -------</option>
                        </select>
                    </div>
                    <div class="col-sm-3" id="per_city" style="display:none;">
                        <label for="inputPostalCode">City</label><span class="text-danger"> *</span>
                        <select name="city" class="form-control" id="person_city">
                            <option value="">-------  Select City -------</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <div class="">
                            <input type="checkbox" class="form-check-input" name="agreement" id="customCheck1" required checked>
                            <label class="" for="customCheck1" style="margin-left: 23px;">I have read and agree to the <a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Captcha</label>
                            <div class="col-md-6 pull-center">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block" onclick="checkbox_check(); submitOnce()" id="submit-button">
                        Register
                            <!-- {{ __('Register') }} -->
                        </button>
                    </div>
                    </div>
                </div>       
                
            </form>
        </div>
        {!! NoCaptcha::renderJs() !!}
    </div>
</div>
<script>

    

    function checkbox_check()
    {
        if( document.getElementById('looking_for_job_seeker').checked || 
            document.getElementById('looking_for_foreign_worker').checked || 
            document.getElementById('looking_for_retired_person').checked ||
            document.getElementById('looking_for_domestic_maid').checked
        )
            {
                document.getElementById("looking_for_job_seeker").removeAttribute("required");
                document.getElementById("looking_for_foreign_worker").removeAttribute("required");
                document.getElementById("looking_for_retired_person").removeAttribute("required");
                document.getElementById("looking_for_domestic_maid").removeAttribute("required");

                
            }
        else{
            document.getElementById("looking_for_job_seeker").setAttribute("required", "");
            document.getElementById("looking_for_foreign_worker").setAttribute("required", "");
            document.getElementById("looking_for_retired_person").setAttribute("required", "");
            document.getElementById("looking_for_domestic_maid").setAttribute("required", "");
           
        }
    }

    function submitOnce() {
       if(
           document.getElementById('com_name').value !== '' &&
           document.getElementById('com_registration').value !== '' &&
           document.getElementById('com_number').value !== '' &&
           document.getElementById('company_country').value !== '' &&
           document.getElementById('email').value !== '' &&
           document.getElementById('company_state').value !== '' &&
           document.getElementById('company_city').value !== '' &&
           document.getElementById('inputFirstname').value !== '' 
        ){
            document.getElementById('submit-button').removeAttribute('onclick');
            document.getElementById('my-form').submit();
            // document.getElementById('my-form').reset();
            document.getElementById("submit-button").disabled = true;
            // alert('you have already submit the form');
       }
       else if(
           document.getElementById('inputFirstname').value !== '' &&
           document.getElementById('cont_email').value !== '' &&
           document.getElementById('person_country').value !== '' &&
           document.getElementById('person_state').value !== '' &&
           document.getElementById('person_city').value !== '' 
        ){
            document.getElementById("com_name").removeAttribute("required");
            document.getElementById("com_registration").removeAttribute("required");
            document.getElementById("com_number").removeAttribute("required");
            document.getElementById("company_country").removeAttribute("required");
            document.getElementById("email").removeAttribute("required");
            document.getElementById("company_state").removeAttribute("required");
            document.getElementById("company_city").removeAttribute("required");
            document.getElementById("inputFirstname").removeAttribute("required");

            document.getElementById('submit-button').removeAttribute('onclick');
            document.getElementById('my-form').submit();
            // document.getElementById('my-form').reset();
            document.getElementById("submit-button").disabled = true;

            // alert('you have already submit the form');
       }
       else{
        document.getElementById("com_name").setAttribute("required", "");
        document.getElementById("com_registration").setAttribute("required", "");
        document.getElementById("com_number").setAttribute("required", "");
        document.getElementById("company_country").setAttribute("required", "");
        document.getElementById("email").setAttribute("required", "");
        document.getElementById("company_state").setAttribute("required", "");
        document.getElementById("company_city").setAttribute("required", "");
        document.getElementById("inputFirstname").setAttribute("required", "");
       }
    }
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3./jquery.min.js"></script> -->
@endsection


