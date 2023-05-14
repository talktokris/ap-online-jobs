@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
<!-- <div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card auth-form mb-5">
                <div class="card-header"><h2 class="text-center">{{ __('Business Partner!!! Sign up today, its easy!') }}</h2>
                </div>

                <div class="card-body"> -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
        <h2 style="text-align: center;">Business Partner Registration</h2>
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="agent">
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
                        <div class=" form-group row" style="margin-left: 150px;">
                            <div class="col-sm-6">
                                <label>
                                    <input type="radio" name="business_partner" id="license_partner" value="company" checked onClick="partnercheck()">
                                
                                    Recruiting License Partners
                                </label>
                            
                                <!-- <div class="checkbox checkbox-info checkbox-circle"> -->
                                    <!-- <input id="looking_for_job_seeker" name="looking_for_pro" type="radio" checked>
                                    <label for="checkbox8">
                                    Recruiting License Partners
                                    </label> -->
                                <!-- </div> -->
                                <!-- <input type="checkbox" name="vehicle" value="Bike" id="looking_for_job_seeker" onClick="showHide()">    Looking For Job Seeker  -->
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <input type="radio" name="business_partner" id="sub" value="individual"  onClick="subcheck()">
                                
                                    For Part Timer / SubAgents - Partners
                                </label><br>
                                <!-- <div class="checkbox checkbox-info checkbox-circle"> -->
                                    <!-- <input id="looking_for_foreign_worker" name="looking_for_gw" type="radio" type="radio">
                                    <label for="checkbox8">
                                    For Part Timer / Sub – Agents - Partners
                                    </label> -->
                                <!-- </div> -->
                        <!-- <input type="checkbox" name="vehicle" value="Bike" id="looking_for_foreign_worker" onClick="showHide()">    Looking For Foreign Worker<br> -->
                            </div>
                        </div>
                        <script>
                            function subcheck() {
                                console.log('milesh');
                                document.getElementById('company_information').style.display='none';
                                document.getElementById('hr_2').style.display='none';
                                document.getElementById('com_name_reg_no_license_no').style.display='none';
                                document.getElementById('com_country_state_city').style.display='none';
                                document.getElementById('com_address_tel_no_email').style.display='none';
                                document.getElementById('per_contact2').style.display='block';
                                document.getElementById('per_passport').style.display='block';
                                document.getElementById('per_con_state_city').style.display='block';
                                document.getElementById('per_passport_email_address_resume').style.display='block';
                                // document.getElementById('per_email_resume').style.display='block';
                           }
                            function partnercheck() {
                                console.log('partnercheck');
                                document.getElementById('company_information').style.display='block';
                                document.getElementById('hr_2').style.display='block';
                                document.getElementById('com_name_reg_no_license_no').style.display='block';
                                document.getElementById('com_country_state_city').style.display='block';
                                document.getElementById('com_address_tel_no_email').style.display='block';
                                document.getElementById('per_contact2').style.display='none';
                                document.getElementById('per_passport').style.display='none';
                                document.getElementById('per_con_state_city').style.display='none';
                                document.getElementById('per_passport_email_address_resume').style.display='none';
                                // document.getElementById('per_email_resume').style.display='none';
                            }
                        </script>
                        <h4 style="text-align: center;" id="company_information">Company Information</h4>  <hr id="hr_2">     
                         <div class="form-group row" id="com_name_reg_no_license_no">
                            <div class="col-sm-6" id="company_name">
                                <label for="agency_registered_name">{{ __('Company Name ') }} <span class="text-danger">*</span></label>
                                <input id="agency_registered_name" type="text" class="form-control" name="agency_registered_name" placeholder="Company Name" >
                                <!-- <input id="agency_registered_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="agency_registered_name" value="{{ old('agency_registered_name') }}" placeholder="Registered Name" > -->
                                <!-- @if ($errors->has('agency_registered_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_registered_name') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="agency_registration_no">{{ __('Company Registration No ') }} <span class="text-danger">*</span></label>
                                <input id="agency_registration_no" type="text" class="form-control" name="agency_registration_no" placeholder="Company Registration No" >
                                <!-- <input id="agency_registration_no" type="text" class="form-control{{ $errors->has('agency_registration_no') ? ' is-invalid' : '' }}" name="agency_registration_no" value="{{ old('agency_registration_no') }}" placeholder="Company Registration No" >
                                @if ($errors->has('agency_registration_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_registration_no') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="agency_license_no">{{ __('Recruiting License No ') }}<span class="text-danger">*</span></label>
                                <input id="agency_license_no" type="text" class="form-control" name="agency_license_no" placeholder="Recruiting License No" required>
                                <!-- <input id="agency_license_no" type="text" class="form-control{{ $errors->has('agency_license_no') ? ' is-invalid' : '' }}" name="agency_license_no" value="{{ old('agency_license_no') }}" placeholder="Recruiting License No" >
                                @if ($errors->has('agency_license_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_license_no') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                         </div>
                         <div class="form-group row" id="com_country_state_city">
                            <div class="col-sm-6">
                                <label for="company_country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="company_country" id="company_country" required class="form-control{{ $errors->has('company_country') ? ' is-invalid' : '' }}" >
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('company_country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <!-- @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="country">{{ __('State ') }}<span class="text-danger">*</span></label>
                                <select name="company_state" id="company_state" required class="form-control{{ $errors->has('company_state') ? ' is-invalid' : '' }}" >
                                    <option value="" disable="true" selected="true">--Select State--</option>
                                    <!-- @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach -->
                                </select>
                                <!-- @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="country">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <select name="company_city" id="company_city" required class="form-control{{ $errors->has('company_city') ? ' is-invalid' : '' }}" >
                                    <option value="" disable="true" selected="true">--Select City--</option>
                                    <!-- @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach -->
                                </select>
                                <!-- @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group row" id="com_address_tel_no_email">
                            <div class="col-sm-6">
                                <label for="company_address">{{ __('Address') }}</label>
                                <input id="company_address" type="text" class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" name="company_address" value="{{ old('company_address') }}" placeholder="Address">
                                @if ($errors->has('company_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="company_phone">{{ __('Telephone Number ') }}<span class="text-danger">*</span></label>
                                <input id="company_phone" type="text" required class="form-control" name="company_phone" placeholder="Telephone Number" >
                                <!-- <input id="company_phone" type="text" class="form-control{{ $errors->has('company_phone') ? ' is-invalid' : '' }}" name="company_phone" value="{{ old('company_phone') }}" placeholder="Telephone Number" > -->
                                <!-- @if ($errors->has('company_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="company_email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                <input id="company_email" type="email" required class="form-control{{ $errors->has('company_email') ? ' is-invalid' : '' }}" name="company_email" value="{{ old('company_email') }}" placeholder="Email" >
                                @if ($errors->has('company_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
                        <hr id="hr_3">
                        <h4 style="text-align: center;">Authorised Person</h4><hr id="hr_4">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="first_name">{{ __('First Name ') }}<span class="text-danger">*</span></label>
                                <input id="first_name" type="text" required class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" >
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
                                <label for="contact_phone">{{ __('Contact Number1') }}<span class="text-danger">*</span></label>
                                <input id="contact_phone" type="text" required class="form-control{{ $errors->has('contact_phone') ? ' is-invalid' : '' }}" name="contact_phone" value="{{ old('contact_phone') }}" placeholder="Contact Number">
                                @if ($errors->has('contact_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="per_contact2" style="display:none;">
                                <label for="contact_phone2">{{ __('Contact Number2 ') }}</label>
                                <input id="contact_phone2" type="text" class="form-control{{ $errors->has('contact_phone2') ? ' is-invalid' : '' }}" name="contact_phone2" value="{{ old('contact_phone2') }}" placeholder="Contact Number" >
                                @if ($errors->has('contact_phone2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_phone2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" id="per_con_state_city" style="display:none;">
                            <div class="col-sm-6">
                                <label for="per_country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="per_country" id="person_country" class="form-control{{ $errors->has('per_country') ? ' is-invalid' : '' }}" >
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('per_country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <!-- @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="per_state">{{ __('State ') }}<span class="text-danger">*</span></label>
                                <select name="per_state" id="person_state" class="form-control{{ $errors->has('per_state') ? ' is-invalid' : '' }}" >
                                    <option value="" disable="true" selected="true">--Select State--</option>
                                    <!-- @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach -->
                                </select>
                                @if ($errors->has('per_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="per_city">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <select name="per_city" id="person_city" class="form-control{{ $errors->has('per_city') ? ' is-invalid' : '' }}" >
                                    <option value="" disable="true" selected="true">--Select City--</option>
                                    <!-- @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach -->
                                </select>
                                @if ($errors->has('per_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" id="per_passport_email_address_resume" style="display:none;">
                            <div class="col-sm-3" id="per_passport" >
                                <label for="passport">{{ __('Passport/NIC') }}<span class="text-danger">*</span></label>
                                <input id="passport" type="text" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" placeholder="Passport/NIC">
                                @if ($errors->has('passport'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="per_email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                <input id="per_email" type="email" class="form-control{{ $errors->has('per_email') ? ' is-invalid' : '' }}" name="per_email" value="{{ old('per_email') }}" placeholder="Email" >
                                @if ($errors->has('per_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="per_address">{{ __('Address') }}</label>
                                <input id="per_address" type="text" class="form-control{{ $errors->has('per_address') ? ' is-invalid' : '' }}" name="per_address" value="{{ old('per_address') }}" placeholder="Address">
                                @if ($errors->has('per_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- <div class="col-sm-3">
                                <label for="license_file">{{ __('Upload Resume') }}</label>
                                <input id="license_file" type="file" class="form-control-file{{ $errors->has('license_file') ? ' is-invalid' : '' }}" name="license_file" value="{{ old('license_file') }}" placeholder="Upload Resume">
                                <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                @if ($errors->has('license_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('license_file') }}</strong>
                                    </span>
                                @endif
                            </div> -->
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="agreement" id="customCheck1"  checked>
                                    <label class="custom-control-label" for="customCheck1">I have read and agree to the <a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h3>Company Information</h3>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_registered_name" class="col-sm-4 col-form-label">{{ __('Company Name ') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="agency_registered_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="agency_registered_name" value="{{ old('agency_registered_name') }}" placeholder="Registered Name" required>

                                        @if ($errors->has('agency_registered_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_registered_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>                            
                                </div>

                                <div class="form-group row">
                                    <label for="agency_address" class="col-sm-4 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_address" type="text" class="form-control{{ $errors->has('agency_address') ? ' is-invalid' : '' }}" name="agency_address" value="{{ old('agency_address') }}" placeholder="Address">

                                        @if ($errors->has('agency_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agency_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency_city" class="col-sm-4 col-form-label">{{ __('City') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_city" type="text" class="form-control{{ $errors->has('agency_city') ? ' is-invalid' : '' }}" name="agency_city" value="{{ old('agency_city') }}" placeholder="City">

                                    @if ($errors->has('agency_city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_city') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_country" class="col-sm-4 col-form-label">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="agency_country" id="agency_country" class="form-control{{ $errors->has('agency_country') ? ' is-invalid' : '' }}" required>
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
                                </div>
                                <div class="form-group row">
                                    <label for="agency_phone" class="col-sm-4 col-form-label">{{ __('Phone ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="agency_phone" type="text" class="form-control{{ $errors->has('agency_phone') ? ' is-invalid' : '' }}" name="agency_phone" value="{{ old('agency_phone') }}" placeholder="Phone" required>

                                    @if ($errors->has('agency_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_phone') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agency_email" class="col-sm-4 col-form-label">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="agency_email" type="email" class="form-control{{ $errors->has('agency_email') ? ' is-invalid' : '' }}" name="agency_email" value="{{ old('agency_email') }}" placeholder="Email" required>

                                    @if ($errors->has('agency_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="agency_fax" class="col-sm-4 col-form-label">{{ __('Agency Fax') }}</label>
                                    <div class="col-sm-8">
                                        <input id="agency_fax" type="text" class="form-control{{ $errors->has('agency_fax') ? ' is-invalid' : '' }}" name="agency_fax" value="{{ old('agency_fax') }}" placeholder="Agency Fax">

                                    @if ($errors->has('agency_fax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('agency_fax') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="license_no" class="col-sm-4 col-form-label">{{ __('License No ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" name="license_no" value="{{ old('license_no') }}" placeholder="License No" required>

                                    @if ($errors->has('license_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_no') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_issue_date" class="col-sm-4 col-form-label">{{ __('License Issue Date') }}</label>
                                    <div class="col-sm-8">
                                        <input id="license_issue_date" type="date" class="form-control{{ $errors->has('license_issue_date') ? ' is-invalid' : '' }}" name="license_issue_date" min="1900-01-01" max="2200-01-01" value="{{old('license_expire_date') ? \Carbon\Carbon::parse(old('license_issue_date'))->format('Y-m-d') : ''}}" placeholder="license_issue_date">

                                    @if ($errors->has('license_issue_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_issue_date') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_expire_date" class="col-sm-4 col-form-label">{{ __('License Expire Date ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="license_expire_date" type="date" class="form-control{{ $errors->has('license_expire_date') ? ' is-invalid' : '' }}" name="license_expire_date" min="1900-01-01" max="2200-01-01" value="{{old('license_expire_date') ? \Carbon\Carbon::parse(old('license_expire_date'))->format('Y-m-d') : ''}}" placeholder="license_expire_date" required>

                                    @if ($errors->has('license_expire_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_expire_date') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="license_file" class="col-sm-4 col-form-label">{{ __('Upload License') }}</label>
                                    <div class="col-sm-8">
                                        <input id="license_file" type="file" class="form-control-file{{ $errors->has('license_file') ? ' is-invalid' : '' }}" name="license_file" value="{{ old('license_file') }}" placeholder="license_file">
                                        <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                    @if ($errors->has('license_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_file') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <h3>Sign Up Information</h3>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">{{ __('Email *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 col-form-label">{{ __('Password *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-sm-4 col-form-label">{{ __('Confirm Password *') }}</label>

                                    <div class="col-sm-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div> --}}

                            </div>
                            <div class="col-md-6">


                                <div class="form-group">
                                    <h3>Contact Information</h3>
                                </div>
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-4 col-form-label">{{ __('First Name ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="middle_name" class="col-sm-4 col-form-label">{{ __('Middle Name') }}</label>
                                    <div class="col-sm-8">
                                        <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name">

                                    @if ($errors->has('middle_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('middle_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-4 col-form-label">{{ __('Last Name') }}</label>
                                    <div class="col-sm-8">
                                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="designation" class="col-sm-4 col-form-label">{{ __('Designation') }}</label>
                                    <div class="col-sm-8">
                                        <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}" placeholder="Designation">

                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-8">
                                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address">

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="nationality" class="col-sm-4 col-form-label">{{ __('Nationality ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}">
                                            <option value="">--Select Nationality--</option>
                                            @foreach ($nationalitys as $nationality)
                                                <option value="{{$nationality->id}}" {{$nationality->id == old('nationality') ? 'selected':''}}>{{$nationality->name}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('nationality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="passport" class="col-sm-4 col-form-label">{{ __('Passport/NIC') }}</label>
                                    <div class="col-sm-8">
                                        <input id="passport" type="text" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ old('passport') }}" placeholder="Passport/NIC">

                                    @if ($errors->has('passport'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passport') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="nic" class="col-sm-4 col-form-label">{{ __('NIC') }}</label>
                                    <div class="col-sm-8">
                                        <input id="nic" type="text" class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" value="{{ old('nic') }}" placeholder="NIC" >

                                    @if ($errors->has('nic'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nic') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="passport_file" class="col-sm-4 col-form-label">{{ __('Passport/NIC (Upload Scanned copy) ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ old('passport_file') }}">
                                        <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                    @if ($errors->has('passport_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passport_file') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="contact_phone" class="col-sm-4 col-form-label">{{ __('Mobile Number ') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input id="contact_phone" type="text" class="form-control{{ $errors->has('contact_phone') ? ' is-invalid' : '' }}" name="contact_phone" value="{{ old('contact_phone') }}" placeholder="Mobile Number">

                                    @if ($errors->has('contact_phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_phone') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="contact_email" class="col-sm-4 col-form-label">{{ __('E-Mail Address *') }}</label>
                                    <div class="col-sm-8">
                                        <input id="contact_email" type="contact_email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" name="contact_email" value="{{ old('contact_email') }}" placeholder="E-Mail">

                                    @if ($errors->has('contact_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div> --}}                
                                <div class="form-group row">
                                        <div class="col-sm-1 ml-auto">
                                            <input id="agreement" class="checkbox" type="checkbox" name="agreement" required>
                                        </div>
                                        <label for="agreement" class="col-sm-8">I have read and agree to the<a href=""> Terms and Conditions</a> governing the use of onlinejobs.my</label>
                                </div>



                            </div>
                        </div> -->

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                        
                    </form>
                <!-- </div>
            </div>
        </div> -->
    </div>
</div>


@endsection
