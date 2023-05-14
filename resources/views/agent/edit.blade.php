@extends('employer.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card auth-form mb-5">
                <div class="card-header">
                    <h3 class="text-center mt-2">
                        @if(Auth::user()->hasRole('agent'))
                        <a href="{{route('agent.index')}}" class="btn btn-danger pull-left">Back </a>
                        @elseif(Auth::user()->hasRole('superadministrator'))
                        <a href="{{route('admin.agent.index')}}" class="btn btn-danger pull-left">Back </a>
                        @endif
                    </h3>
                    <h2 class="text-center">Update Information</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('agent.update', $agent->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h4 style="text-align: center;" id="company_information">Company Information</h4>  <hr id="hr_2"> 
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="agency_registered_name">{{ __('Company Name ') }}@if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span>@endif</label>
                                <input id="agency_registered_name" type="text" class="form-control{{ $errors->has('agency_registered_name') ? ' is-invalid' : '' }}" name="agency_registered_name" value="{{ $agentProfile->agency_registered_name }}" placeholder="Registered Name" @if($agentProfile->agency_registered_name!='')required @endif>
                                @if ($errors->has('agency_registered_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_registered_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="a_registred_no">
                                <label for="agency_registration_no">{{ __('Company Registration No ') }} @if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span>@endif</label>
                                <input @if($agentProfile->agency_registered_name!='') required @endif id="agency_registration_no" type="text" value="{{ $agentProfile->agency_registration_no}}" class="form-control" name="agency_registration_no" placeholder="Company Registration No" >
                            </div>
                            <div class="col-sm-3" id="a_license_no">
                                <label for="license_no">{{ __('Recruiting License No ') }} @if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span>@endif</label>
                                <input id="license_no" type="text" class="form-control{{ $errors->has('license_no') ? ' is-invalid' : '' }}" name="license_no" value="{{ $agentProfile->license_no }}" placeholder="Agency License No" @if($agentProfile->agency_registered_name!='') required @endif>
                                @if ($errors->has('license_no'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('license_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="company_country">{{ __('Country ') }} @if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span> @endif</label>
                                <select name="agency_country" id="company_country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" @if($agentProfile->agency_registered_name!='') required @endif>
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        @if($agentProfile->agency_registered_name!='')
                                        <option value="{{$country->id}}" {{$country->id == $agentProfile->agency_country ? 'selected':''}}>{{$country->name ?? ''}}</option>
                                        @else
                                        <option value="{{$country->id}}" {{$country->id == old('per_country') ? 'selected':''}}>{{$country->name ?? ''}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('agency_country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="country">{{ __('State ') }}@if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span> @endif</label>
                                <select @if($agentProfile->agency_registered_name!='') required @endif name="agency_state" id="company_state" class="form-control{{ $errors->has('agency_state') ? ' is-invalid' : '' }}" >
                                    @if($agentProfile->agency_registered_name!='')
                                    <option value="{{$agentProfile->agency_state}}" disable="true" selected="true">{{$agentProfile->company_state_data->name ?? ''}}</option>
                                    @else
                                    <option value="" disable="true" selected="true">--Select State--</option>
                                    @endif
                                </select>
                                @if ($errors->has('agency_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="agency_city">{{ __('Agency City') }}</label>
                                <select @if($agentProfile->agency_registered_name!='') required @endif name="agency_city" id="company_city"  class="form-control{{ $errors->has('agency_city') ? ' is-invalid' : '' }}" >
                                    
                                    @if($agentProfile->agency_registered_name!='')
                                    <option value="{{$agentProfile->agency_city}}" disable="true" selected="true">{{$agentProfile->company_city_data->name ?? ''}}</option>
                                    @else
                                    <option value="" disable="true" selected="true">--Select City--</option>
                                    @endif
                                </select>
                                @if ($errors->has('agency_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="agency_address">{{ __('Address') }}</label>
                                <input id="agency_address" type="text" class="form-control{{ $errors->has('agency_address') ? ' is-invalid' : '' }}" name="agency_address" value="@if($agentProfile->agency_registered_name!=''){{$agentProfile->agency_address}} @endif" placeholder="Address">
                                @if ($errors->has('agency_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="a_phone">
                                <label for="agency_phone">{{ __('Phone ') }}@if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span> @endif</label>
                                <input @if($agentProfile->agency_registered_name!='') required @endif id="agency_phone" type="text" class="form-control{{ $errors->has('agency_phone') ? ' is-invalid' : '' }}" name="agency_phone" value="@if($agentProfile->agency_registered_name!=''){{ $agentProfile->agency_phone }}@endif" placeholder="Phone">
                                @if ($errors->has('agency_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agency_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="a_email">
                                <label for="agency_email">{{ __('Email ') }} @if($agentProfile->agency_registered_name!='') <span class="text-danger">*</span> @endif</label>
                                <input @if($agentProfile->agency_registered_name!='') required @endif id="agency_email" value="@if($agentProfile->agency_registered_name!=''){{$agentProfile->agency_email}}@endif" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert"  style="margin-top: 35px;margin-right: 25px;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="license_issue_date">{{ __('License Issue Date') }}</label>
                                <input id="license_issue_date" type="date" class="form-control{{ $errors->has('license_issue_date') ? ' is-invalid' : '' }}" name="license_issue_date" min="1900-01-01" max="2200-01-01" value="{{$agentProfile->license_issue_date ? \Carbon\Carbon::parse($agentProfile->license_issue_date)->format('Y-m-d') : ''}}" placeholder="license_issue_date">
                                @if ($errors->has('license_issue_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('license_issue_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="license_expire_date">{{ __('License Expire Date ') }}@if($agentProfile->agency_registered_name!='')<span class="text-danger">*</span>@endif</label>
                        
                                <input id="license_expire_date" type="date" class="form-control{{ $errors->has('license_expire_date') ? ' is-invalid' : '' }}" name="license_expire_date" min="1900-01-01" max="2200-01-01" value="{{$agentProfile->license_expire_date ? \Carbon\Carbon::parse($agentProfile->license_expire_date)->format('Y-m-d') : ''}}" placeholder="license_expire_date" @if($agentProfile->agency_registered_name!='') required @endif>

                                @if ($errors->has('license_expire_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('license_expire_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="license_file">{{ __('Upload License') }}</label>
                                    <input id="license_file" type="file" class="form-control-file{{ $errors->has('license_file') ? ' is-invalid' : '' }}" name="license_file" value="{{ $agentProfile->license_file}}" placeholder="license_file">
                                    @if($agentProfile->license_file)
                                        <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$agentProfile->license_file)}}">View License File</a>
                                    @endif
                                    <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                    @if ($errors->has('license_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('license_file') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div><hr>
                        <hr id="hr_3">
                        <h4 style="text-align: center;">Authorised Person</h4><hr id="hr_4">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="first_name">{{ __('First Name ') }}<span class="text-danger">*</span></label>
                                <input required id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $agentProfile->first_name }}" placeholder="First Name" required>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="last_name">{{ __('Last Name') }}</label>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $agentProfile->last_name }}" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="contact_phone">{{ __('Mobile Number ') }}<span class="text-danger">*</span></label>
                                <input required id="contact_phone" type="text" class="form-control{{ $errors->has('contact_phone') ? ' is-invalid' : '' }}" name="contact_phone" value="{{ $agentProfile->contact_phone }}" placeholder="Mobile Number">
                                @if ($errors->has('contact_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="p_contact_no_2">
                                <label for="contact_phone2">{{ __('Contact Number2 ') }}</label>
                                <input id="contact_phone2" type="text" class="form-control{{ $errors->has('contact_phone2') ? ' is-invalid' : '' }}" name="contact_phone2" value="{{ $agentProfile->contact_phone2 }}" placeholder="Contact Number" >
                                @if ($errors->has('contact_phone2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_phone2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6" id="p_country">
                                <label for="per_country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="per_country" id="person_country" class="form-control{{ $errors->has('per_country') ? ' is-invalid' : '' }}" >
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                    {{-- <option value="{{$country->id}}" {{$country->id == $agentProfile->agency_country ? 'selected':''}}>{{$country->name ?? ''}}</option> --}}
                                    <option value="{{$country->id}}" {{$country->id == $agentProfile->agency_country ? 'selected':''}}>{{$country->name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3" id="p_state">
                                <label for="per_state">{{ __('State ') }}<span class="text-danger">*</span></label>
                                <select name="per_state" id="person_state" class="form-control{{ $errors->has('per_state') ? ' is-invalid' : '' }}" >
                                    {{-- <option value="" disable="true" selected="true">--Select State--</option> --}}
                                    <option value="{{$agentProfile->agency_state}}" disable="true" selected="true">{{$agentProfile->company_state_data->name ?? ''}}</option>
                                </select>
                                @if ($errors->has('per_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="p_city">
                                <label for="per_city">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <select name="per_city" id="person_city" class="form-control{{ $errors->has('per_city') ? ' is-invalid' : '' }}" >
                                    {{-- <option value="" disable="true" selected="true">--Select City--</option> --}}
                                    <option value="{{$agentProfile->agency_city}}" disable="true" selected="true">{{$agentProfile->company_city_data->name ?? ''}}</option>
                                </select>
                                @if ($errors->has('per_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3" id="p_passport">
                                <label for="passport">{{ __('Passport/NIC') }}<span class="text-danger">*</span></label>
                                <input id="passport" type="text" class="form-control{{ $errors->has('passport') ? ' is-invalid' : '' }}" name="passport" value="{{ $agentProfile->passport }}" placeholder="Passport/NIC">
                                @if ($errors->has('passport'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="p_email">
                                <label for="per_email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                <input id="per_email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="per_email" value="{{ $user->email }}" placeholder="Email" >
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
                            <div class="col-sm-6" id="p_address" >
                                <label for="per_address">{{ __('Address') }}</label>
                                <input id="per_address" type="text" class="form-control{{ $errors->has('per_address') ? ' is-invalid' : '' }}" name="per_address" value="{{ $agentProfile->address }}" placeholder="Address">
                                @if ($errors->has('per_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('per_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="designation">{{ __('Designation') }}</label>
                                <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ $agentProfile->designation }}" placeholder="Designation">
                                @if ($errors->has('designation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="nationality">{{ __('Nationality ') }}<span class="text-danger">*</span></label>
                                <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Nationality--</option>
                                    @foreach ($nationalitys as $nationality)
                                        <option value="{{$nationality->id}}" {{$nationality->id == $agentProfile->nationality ? 'selected':''}}>{{$nationality->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('nationality'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="passport_file">{{ __('Passport/NIC (Upload Scanned copy) ') }}<span class="text-danger">*</span></label>
                                <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ $agentProfile->passport_file }}" required>
                                @if($agentProfile->passport_file)
                                    <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$agentProfile->passport_file)}}">View Passport File</a>
                                @endif
                                <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                                @if ($errors->has('passport_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
