@extends('layouts.app')
<style>
    .ftco-navbar-light {
  background: transparent !important;
  position: relative !important;
  top: 0px !important;
  left: 0;
  right: 0;
  z-index: 3; }
  </style>
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center" style="margin-top: 90px;">
        <div class="col-md-12">
            <h2 style="text-align: center;">Business Partner Registration</h2>             
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data" id="my-form">
                @csrf
                <!-- <input type="hidden" name="role" value="agent"> -->
                {{-- <div class="form-group row">
                    <label for="agent_code" class="col-sm-4 col-form-label">{{ __('Agent Code') }}</label>
                    <div class="col-sm-8">
                        <input id="agent_code" type="text" class="form-control{{ $errors->has('agent_code') ? ' is-invalid' : '' }}" name="agent_code" value="{{ old('agent_code') }}" placeholder="Agent Code" >
                        @if ($errors->has('agent_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agent_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> --}}
                <div class=" form-group row" >
                    <div class="col-sm-4">
                        <label>
                            <input type="radio" name="role" id="license_partner" value="agent" checked onClick="partnercheck()">
                        
                            Recruiting License Partners
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label>
                            <input type="radio" name="role" id="part_timer" value="part-timer" onClick="subcheck()">
                            Partners / Part Timers
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label>
                            <input type="radio" name="role" id="sub" value="agent"  onClick="subcheck()">
                            Sub Agents
                        </label><br>
                    </div>
                    {{-- <div class="col-sm-3">
                        <label>
                            <input type="radio" name="role" id="sub" value="agent"  onClick="subcheck()">
                            Retired Personal
                        </label><br>
                    </div> --}}
                </div>
                <h4 style="text-align: center;" id="company_information">Company Information</h4>  <hr id="hr_2"> 
                <div class="form-group row">
                    <div class="col-sm-6" id="a_registered_name">
                        <label for="agency_registered_name">{{ __('Company Name ') }} <span class="text-danger">*</span></label>
                        <input required id="agency_registered_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="agency_registered_name" value="{{ old('agency_registered_name') }}" placeholder="Registered Name">
                        @if ($errors->has('agency_registered_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agency_registered_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="a_registred_no">
                        <label for="agency_registration_no">{{ __('Company Registration No ') }} <span class="text-danger">*</span></label>
                        <input required id="agency_registration_no" type="text" class="form-control" name="agency_registration_no" placeholder="Company Registration No" >
                    </div>
                    <div class="col-sm-3" id="a_license_no">
                        <label for="license_no">{{ __('Recruiting License No ') }}<span class="text-danger">*</span></label>
                        <input required id="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" name="license_no" value="{{ old('license_no') }}" placeholder="License No" >
                        @if ($errors->has('license_no'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('license_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6" id="a_country">
                        <label for="company_country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                        <select required name="agency_country" id="company_country"  class="form-control{{ $errors->has('agency_country') ? ' is-invalid' : '' }}" >
                            <option value="">--Select Country--</option>
                            @foreach ($countrys as $country)
                                <option value="{{$country->id}}" {{$country->id == old('agency_country') ? 'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('agency_country'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agency_country') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="a_state">
                        <label for="country">{{ __('State ') }}<span class="text-danger">*</span></label>
                        <select required name="agency_state" id="company_state" class="form-control{{ $errors->has('agency_state') ? ' is-invalid' : '' }}" >
                            <option value="" disable="true" selected="true">-- Select State--</option>
                        </select>
                        @if ($errors->has('agency_state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agency_state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="a_city">
                        <label for="country">{{ __('City ') }}<span class="text-danger">*</span></label>
                        <select required name="agency_city" id="company_city"  class="form-control{{ $errors->has('agency_city') ? ' is-invalid' : '' }}" >
                            <option value="" disable="true" selected="true">--Select City--</option>
                        </select>
                        @if ($errors->has('agency_city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agency_city') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6" id="a_address">
                        <label for="agency_address">{{ __('Address') }}</label>
                        <input id="agency_address" type="text" class="form-control{{ $errors->has('agency_address') ? ' is-invalid' : '' }}" name="agency_address" value="{{ old('agency_address') }}" placeholder="Address">
                        @if ($errors->has('agency_address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agency_address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="a_phone">
                        <label for="agency_phone">{{ __('Phone ') }}<span class="text-danger">*</span></label>
                        <input required id="agency_phone" type="text" class="form-control{{ $errors->has('agency_phone') ? ' is-invalid' : '' }}" name="agency_phone" value="{{ old('agency_phone') }}" placeholder="Phone">
                        @if ($errors->has('agency_phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('agency_phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="a_email">
                        <label for="agency_email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                        <input required id="agency_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert"  style="margin-top: 35px;margin-right: 25px;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <hr id="hr_3">
                <h4 style="text-align: center;">Authorised Person</h4><hr id="hr_4">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="first_name">{{ __('First Name ') }}<span class="text-danger">*</span></label>
                        <input required id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="last_name">{{ __('Last Name') }}</label>
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="contact_phone">{{ __('Mobile Number ') }}<span class="text-danger">*</span></label>
                        <input required id="contact_phone" type="text" class="form-control{{ $errors->has('contact_phone') ? ' is-invalid' : '' }}" name="contact_phone" value="{{ old('contact_phone') }}" placeholder="Mobile Number">
                        @if ($errors->has('contact_phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact_phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="p_contact_no_2" style="display:none;">
                        <label for="contact_phone2">{{ __('Contact Number2 ') }}</label>
                        <input id="contact_phone2" type="text" class="form-control{{ $errors->has('contact_phone2') ? ' is-invalid' : '' }}" name="contact_phone2" value="{{ old('contact_phone2') }}" placeholder="Contact Number" >
                        @if ($errors->has('contact_phone2'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact_phone2') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6" id="p_country" style="display:none;">
                        <label for="per_country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                        <select name="per_country" id="person_country" class="form-control{{ $errors->has('per_country') ? ' is-invalid' : '' }}" >
                            <option value="">--Select Country--</option>
                            @foreach ($countrys as $country)
                                <option value="{{$country->id}}" {{$country->id == old('per_country') ? 'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3" id="p_state" style="display:none;">
                        <label for="per_state">{{ __('State ') }}<span class="text-danger">*</span></label>
                        <select name="per_state" id="person_state" class="form-control{{ $errors->has('per_state') ? ' is-invalid' : '' }}" >
                            <option value="" disable="true" selected="true">--Select State--</option>
                        </select>
                        @if ($errors->has('per_state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('per_state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="p_city" style="display:none;">
                        <label for="per_city">{{ __('City ') }}<span class="text-danger">*</span></label>
                        <select name="per_city" id="person_city" class="form-control{{ $errors->has('per_city') ? ' is-invalid' : '' }}" >
                            <option value="" disable="true" selected="true">--Select City--</option>
                        </select>
                        @if ($errors->has('per_city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('per_city') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3" id="p_passport" style="display:none;">
                        <label for="passport">{{ __('Passport/NIC') }}<span class="text-danger">*</span></label>
                        <input id="passport" type="text" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" placeholder="Passport/NIC">
                        @if ($errors->has('passport'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passport') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3" id="p_email" style="display:none;">
                        <label for="per_email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                        <input id="per_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="per_email" value="{{ old('email') }}" placeholder="Email" >
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert"  style="margin-top: 35px;margin-right: 25px;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <!-- @if ($errors->has('per_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('per_email') }}</strong>
                            </span>
                        @endif -->
                    </div>
                    <div class="col-sm-6" id="p_address" style="display:none;">
                        <label for="per_address">{{ __('Address') }}</label>
                        <input id="per_address" type="text" class="form-control{{ $errors->has('per_address') ? ' is-invalid' : '' }}" name="per_address" value="{{ old('per_address') }}" placeholder="Address">
                        @if ($errors->has('per_address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('per_address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <div class="col-sm-8">
                        <input id="agreement" class="checkbox" type="checkbox" name="agreement" required>
                    
                    <label for="agreement" class="col-sm-8">I have read and agree to the<a href=""> Terms and Conditions</a> governing the use of onlinejobs.my</label>
                    </div>
                </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-warning btn-block">
                        {{ __('Register') }}
                    </button>
                </div> --}}

                <div class="form-group row">
                    <div class="col-sm-8">
                        {{-- <div class=""> --}}
                            <input type="checkbox" class="form-check-input" name="agreement" id="customCheck1" required checked>
                            <label class="" for="customCheck1" >I have read and agree to the <a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block" onclick="submitOnce()" id="submit-button">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script>
    function submitOnce()
    {
        // var agency=document.getElementById('agency_registered_name').value;
        // alert(agency);
        if(
           document.getElementById('agency_registered_name').value !== '' &&
           document.getElementById('agency_registration_no').value !== '' &&
           document.getElementById('license_no').value !== '' &&
           document.getElementById('company_country').value !== '' &&
           document.getElementById('company_state').value !== '' &&
           document.getElementById('company_city').value !== '' &&
           document.getElementById('agency_phone').value !== '' &&
           document.getElementById('agency_email').value !== '' &&

           document.getElementById('first_name').value !== '' &&
           document.getElementById('contact_phone').value !== ''
        ){
            document.getElementById('submit-button').removeAttribute('onclick');
            document.getElementById('my-form').submit();
            document.getElementById("submit-button").disabled = true;
        }
        else if(
           document.getElementById('first_name').value !== '' &&
           document.getElementById('contact_phone').value !== '' &&
           document.getElementById('person_country').value !== '' &&
           document.getElementById('person_state').value !== '' &&
           document.getElementById('person_city').value !== '' &&
           document.getElementById('passport').value !== '' &&
           document.getElementById('per_email').value !== '' 
        ){
            document.getElementById("agency_registered_name").removeAttribute("required");
           document.getElementById("agency_registration_no").removeAttribute("required");
           document.getElementById("license_no").removeAttribute("required");
           document.getElementById("company_country").removeAttribute("required");
           document.getElementById("company_state").removeAttribute("required");
           document.getElementById("company_city").removeAttribute("required");
           document.getElementById("agency_phone").removeAttribute("required");
           document.getElementById("agency_email").removeAttribute("required");

            document.getElementById('submit-button').removeAttribute('onclick');
            document.getElementById('my-form').submit();
            // document.getElementById('my-form').reset();
            document.getElementById("submit-button").disabled = true;

            // alert('you have already submit the form');
       }
        else{
           document.getElementById("agency_registered_name").setAttribute("required", "");
           document.getElementById("agency_registration_no").setAttribute("required", "");
           document.getElementById("license_no").setAttribute("required", "");
           document.getElementById("company_country").setAttribute("required", "");
           document.getElementById("company_state").setAttribute("required", "");
           document.getElementById("company_city").setAttribute("required", "");
           document.getElementById("agency_phone").setAttribute("required", "");
           document.getElementById("agency_email").setAttribute("required", "");
           document.getElementById("first_name").setAttribute("required", "");
           document.getElementById("contact_phone").setAttribute("required", "");
           
        }
    }
</script>
