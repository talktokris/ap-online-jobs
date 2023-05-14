@extends('employer.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3">Edit Personal Information</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
                <div class="card-body">
                    <form method="POST" action="{{ route('retiredPersonnel.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="retired">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">{{ __('First Name ') }}<span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->retired_personnel->name }}" placeholder="First Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="name">{{ __('Last Name ') }}<span class="text-danger">*</span></label>
                                <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{$user->retired_personnel->last_name }}" placeholder="Last Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="nationality" >{{ __('Nationality ') }}<span class="text-danger">*</span></label>
                                <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" required>
                                    <option value="{{$user->retired_personnel->nationality}}">{{$user->retired_personnel->retired_nationality_data->name ?? "--Select Nationality--"}}</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->name == $user->retired_personnel->country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('nationality'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- job category add 2/14/2020 by milesh start-->
                            <div class="col-sm-3">
                                <label for="job_category">{{ __('Job Category ') }}<span class="text-danger">*</span></label>
                                <select name="job_category" id="job_category" class="form-control{{ $errors->has('job_category') ? ' is-invalid' : '' }}" required>
                                    <option value="{{$user->retired_personnel->job_category}}">{{$user->retired_personnel->retired_job_category_data->name ?? "--Select Job Category--"}}</option>
                                    @foreach ($options as $option)
                                        <option value="{{$option->id}}" {{$option->id == old('job_category') ? 'selected':''}}>{{$option->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('job_category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        </br>  
                        <hr> 
                        <!-- job category add 2/14/2020 by milesh end-->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="nric">{{ __('NRIC ') }}<span class="text-danger">*</span></label>
                                <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ $user->retired_personnel->nric }}" placeholder="NRIC" required>
                                @if ($errors->has('nric'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nric') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="address">{{ __('Address ') }}<span class="text-danger">*</span></label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$user->retired_personnel->address}}" placeholder="Address" required>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="postcode">{{ __('Postcode') }}</label>
                                <input id="postcode" type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ $user->retired_personnel->postcode }}" placeholder="Postcode">
                                @if ($errors->has('postcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="age">{{ __('Age ') }}<span class="text-danger">*</span></label>
                                <input id="age" type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ $user->retired_personnel->age }}" placeholder="Age" required>
                                @if ($errors->has('age'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </br>
                        <hr> 
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="gender">{{ __('Gender ') }}<span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option>-- Select Gender --</option>
                                    <option value="Male" {{$user->retired_personnel->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{$user->retired_personnel->gender == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->retired_personnel->email }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="phone">{{ __('Contact No ') }}<span class="text-danger">*</span></label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->retired_personnel->phone }}" placeholder="Contact No" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="marital_status">{{ __('Marital Status') }}</label>
                                <select onChange="displayChildren(this.value)" name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Marital Status--</option>
                                    @foreach ($marital_statuses as $marital_status)
                                        <option value="{{$marital_status->name}}" {{$marital_status->name == $user->retired_personnel->marital_status? 'selected':''}}>{{$marital_status->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('marital_status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('marital_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </br>
                        <hr> 
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="country" id="person_country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="{{$user->retired_personnel->country}}">{{$user->retired_personnel->company_country_data->name}}</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->name == $user->retired_personnel->country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                <!-- <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Nationality--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->name}}" {{$country->name == $user->retired_personnel->country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select> -->
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="state">{{ __('State') }}<span class="text-danger">*</span></label>
                                <select name="state" id="person_state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" required>
                                    <option value="{{$user->retired_personnel->state}}" disable="true" selected="true">{{$user->retired_personnel->company_state_data->name}}</option>
                                </select>
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="person_city">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <select name="person_city" id="person_city" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="{{$user->retired_personnel->city}}" disable="true" selected="true">{{$user->retired_personnel->company_city_data->name}}</option>
                                </select>
                            </div>
                        </div>
                        </br>
                        <hr> 
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="government_employee">{{ __('Were you government servent ?') }}</label>
                                <div class="col-sm-8 mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="govt" name="government_employee" value="Yes" {{$user->retired_personnel->government_employee == 'Yes' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="govt">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="non_govt" name="government_employee" value="No" {{$user->retired_personnel->government_employee == 'No' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="non_govt">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="govt_department">{{ __('Department') }}</label>
                                <input id="govt_department" type="text" class="form-control{{ $errors->has('govt_department') ? ' is-invalid' : '' }}" name="govt_department" value="{{ $user->retired_personnel->govt_department }}" placeholder="Department">
                                @if ($errors->has('govt_department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('govt_department') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="academic_qualification">{{ __('Highest Academic Qualification ') }}<span class="text-danger">*</span></label>
                                <select class="form-control{{ $errors->has('academic_qualification') ? ' is-invalid' : '' }}" name="highest_academic_qualification" id="academic_qualification">
                                    <option value="">--Select Academic Qualification--</option>
                                    @foreach ($academics as $academic)
                                        <option value="{{$academic->name}}" {{$user->retired_personnel->highest_academic_qualification == $academic->name ? 'selected' : ''}}>{{$academic->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('academic_qualification'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('academic_qualification') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="specialization">{{ __('Specialization') }}</label>
                                <select class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" id="specialization">
                                    <option value="">--Select Specialization--</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{$specialization->name}}" {{$user->retired_personnel->specialization == $specialization->name ? 'selected' : ''}}>{{$specialization->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('specialization'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specialization') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                
                        </br>
                      
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3"></div>
                            <div class="col-md-6 mb-3">
                                <div id="czContainerLanguage">
                                    <div id="first">
                                        <div class="recordset">
                                            <div class="fieldRow clearfix">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label for="academic_qualification" class="col-sm-4 col-form-label text-right">{{ __('Academic Qualification ') }}<span class="text-danger">*</span></label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control{{ $errors->has('academic_qualification') ? ' is-invalid' : '' }}" name="academic_qualifications[]" id="academic_qualification">
                                                                    <option >--Select academic qualification--</option>
                                                                    @foreach ($academics as $academic)
                                                                        <option value="{{$academic->name}}">{{$academic->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @if ($errors->has('academic_qualification'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('academic_qualification') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="specializations" class="col-sm-4 col-form-label text-right">{{ __('Specialization') }}</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control{{ $errors->has('specializations') ? ' is-invalid' : '' }}" name="specializations[]" id="specializations">
                                                                    <option >--Select Specialization--</option>
                                                                    @foreach ($specializations as $specialization)
                                                                        <option value="{{$specialization->name}}">{{$specialization->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @if ($errors->has('specialization'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('specialization') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr class="mt-4 mb-4"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </br>
                        <hr> 
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="full_time">{{ __('Prefer Working hours ?') }}</label>
                                <div class="col-sm-8 mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="full_time" name="full_time" value="yes" {{$user->retired_personnel->full_time == 'yes' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="full_time">Full Time</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="part_time" name="full_time" value="no" {{$user->retired_personnel->full_time == 'no' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="part_time">Part Time</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="fit_to_work">{{ __('Fit to work ?') }}</label>
                                <div class="col-sm-8 mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="fit_to_work" name="fit_to_work" value="yes" {{$user->retired_personnel->fit_to_work == 'yes' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="fit_to_work">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="fit_to_work2" name="fit_to_work" value="no" {{$user->retired_personnel->fit_to_work == 'no' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="fit_to_work2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="have_blood_pressure">{{ __('Have blood pressure ?') }}</label>
                                <div class="col-sm-8 mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="have_blood_pressure" name="have_blood_pressure" value="yes" {{$user->retired_personnel->have_blood_pressure == 'yes' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="have_blood_pressure">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="have_blood_pressure1" name="have_blood_pressure" value="no" {{$user->retired_personnel->have_blood_pressure == 'no' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="have_blood_pressure1">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="have_diabetes">{{ __('Have diabetes ?') }}</label>
                                <div class="col-sm-8 mt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="have_diabetes" name="have_diabetes" value="yes" {{$user->retired_personnel->have_diabetes == 'yes' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="have_diabetes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="have_diabetes1" name="have_diabetes" value="no" {{$user->retired_personnel->have_diabetes == 'no' ? 'checked' : ''}} class="custom-control-input">
                                        <label class="custom-control-label" for="have_diabetes1">No</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </br>
                        <hr> 
                        <div class="form-group row d-none hide_working_hours">
                            <div class="col-sm-12">
                                <label for="describe_working_hours">{{ __('Describe Working Hours') }}</label>
                                <input id="describe_working_hours" type="text" class="form-control{{ $errors->has('describe_working_hours') ? ' is-invalid' : '' }}" name="describe_working_hours" value="{{ $user->retired_personnel->describe_working_hours }}" placeholder="Describe Working Hours">
                                @if ($errors->has('describe_working_hours'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('describe_working_hours') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        </br>                        
                        {{-- <div class="form-group row">
                            <label for="health_statement" class="col-sm-4 col-form-label text-right">{{ __('Health Statement') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control{{ $errors->has('health_statement') ? ' is-invalid' : '' }}" name="health_statement" id="health_statement">
                                    <option value="">--Select health Statement--</option>
                                    @foreach ($health_statements as $health_statement)
                                        <option value="{{$health_statement->name}}" {{$user->retired_personnel->health_statement == $health_statement->name ? 'selected' : ''}}>{{$health_statement->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('health_statement'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('health_statement') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            
                            <div class="col-sm-12">
                                <label for="additional_health_statement" >{{ __('Additional Health Information ') }}</label>
                                {{-- <input id="additional_health_statement" type="text" class="form-control{{ $errors->has('additional_health_statement') ? ' is-invalid' : '' }}" name="additional_health_statement" value="{{ $user->retired_personnel->additional_health_statement }}" placeholder="Additional Health Information" > --}}
                                <textarea name="additional_health_statement" class="form-control{{ $errors->has('additional_health_statement') ? ' is-invalid' : '' }}" id="additional_health_statement" cols="30" rows="4">{{ $user->retired_personnel->additional_health_statement }}</textarea>
                            @if ($errors->has('additional_health_statement'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('additional_health_statement') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        </br>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="resume_file">{{ __('Upload Resume') }}</label>
                                <input id="resume_file" type="file" class="form-control-file{{ $errors->has('resume_file') ? ' is-invalid' : '' }}" name="resume_file" value="{{ old('resume_file') }}">
                                <p class="text-danger">Supported file format DOC, DOCX & PDF. Maximum file size: 1MB</p>
                                @if ($errors->has('resume_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('resume_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="profile_image">{{ __('Upload Profile Image') }}</label>
                                <input id="profile_image" type="file" class="form-control-file{{ $errors->has('profile_image') ? ' is-invalid' : '' }}" name="profile_image" value="{{ old('profile_image') }}">
                                <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                @if ($errors->has('profile_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        </br>
                        @if($user->retired_personnel->profile_image)
                            <p>Current Image</p>
                            <img src="{{asset('storage/'.$user->retired_personnel->profile_image)}}" alt="">
                        @endif
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>    
    </div>
</div>
@endsection
@section('script')
<script>
    (function ($, undefined) {
    $.fn.czMore = function (options) {

        //Set defauls for the control
        var defaults = {
            max: 5,
            min: 0,
            onLoad: null,
            onAdd: null,
            onDelete: null,
            styleOverride: false,
        };
        //Update unset options with defaults if needed
        var options = $.extend(defaults, options);
        $(this).bind("onAdd", function (event, data) {
            options.onAdd.call(event, data);
        });
        $(this).bind("onLoad", function (event, data) {
            options.onLoad.call(event, data);
        });
        $(this).bind("onDelete", function (event, data) {
            options.onDelete.call(event, data);
        });
        //Executing functionality on all selected elements
        return this.each(function () {
            var obj = $(this);
            var i = obj.children(".recordset").length;
            var divPlus = '<div id="btnPlus" class="btnPlus">Add</div>';
            var count = '<input id="' + this.id + '_czMore_txtCount" name="' + this.id + '_czMore_txtCount" type="hidden" value="0" size="5" />';

            obj.before(count);
            var recordset = obj.children("#first");
            obj.after(divPlus);
            var set = recordset.children(".recordset").children().first();
            var btnPlus = obj.siblings("#btnPlus");

            if(!options.styleOverride) {
              btnPlus.css({
                  'border': '0px',
                  'background-image': 'url("/images/add.png")',
                  'background-position': 'center center',
                  'background-repeat': 'no-repeat',
                  'height': '25px',
                  'width': '90px',
                  'cursor': 'pointer',
                  'margin': 'auto',
              });
            }

            if (recordset.length) {
                obj.siblings("#btnPlus").click(function () {
                    var i = obj.children(".recordset").length;
                    var item = recordset.clone().html();
                    i++;
                    item = item.replace(/\[([0-9]\d{0})\]/g, "[" + i + "]");
                    item = item.replace(/\_([0-9]\d{0})\_/g, "_" + i + "_");
                    //$(element).html(item);
                    //item = $(item).children().first();
                    //item = $(item).parent();

                    obj.append(item);
                    loadMinus(obj.children().last());
                    minusClick(obj.children().last());
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", i);
                    }

                    obj.siblings("input[name$='czMore_txtCount']").val(i);
                    return false;
                });
                recordset.remove();
                for (var j = 0; j <= i; j++) {
                    loadMinus(obj.children()[j]);
                    minusClick(obj.children()[j]);
                    if (options.onAdd != null) {
                        obj.trigger("onAdd", j);
                    }
                }

                if (options.onLoad != null) {
                    obj.trigger("onLoad", i);
                }
                //obj.bind("onAdd", function (event, data) {
                //If you had passed anything in your trigger function, you can grab it using the second parameter in the callback function.
                //});
            }

            function resetNumbering() {
                $(obj).children(".recordset").each(function (index, element) {
                   $(element).find('input:text, input:password, input:file, select, textarea').each(function(){
                        old_name = this.name;
                        new_name = old_name.replace(/\_([0-9]\d{0})\_/g, "_" + (index + 1) + "_");
                        this.id = this.name = new_name;
                        //alert(this.name);
                    });
                    index++
                    minusClick(element);
                });
            }

            function loadMinus(recordset) {
                var divMinus = '<div id="btnMinus" class="btnMinus" />';
                $(recordset).children().first().before(divMinus);
                var btnMinus = $(recordset).children("#btnMinus");
                if(!options.styleOverride) {
                  btnMinus.css({
                      'float': 'right',
                      'border': '0px',
                      'background-image': 'url("/images/remove.png")',
                      'background-position': 'center center',
                      'background-repeat': 'no-repeat',
                      'height': '25px',
                      'width': '25px',
                      'cursor': 'poitnter',
                  });
              }
            }

            function minusClick(recordset) {
                $(recordset).children("#btnMinus").click(function () {
                    var i = obj.children(".recordset").length;
                    var id = $(recordset).attr("data-id")
                    $(recordset).remove();
                    resetNumbering();
                    obj.siblings("input[name$='czMore_txtCount']").val(obj.children(".recordset").length);
                    i--;
                    if (options.onDelete != null) {
                        if (id != null)
                            obj.trigger("onDelete", id);
                    }
                });
            }
        });
    };
})(jQuery);

    </script>
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
        $("#czContainerLanguage").czMore();
    </script>

<script>
    window.onload = function() {
        //console.log(document.querySelector('#govt').value);
        if(document.querySelector('#govt').value = 'yes'){
            document.querySelector('.hide_govt_department').classList.remove("d-none");
        }
        if(document.querySelector('#part_time').value = 'no'){
            document.querySelector('.hide_working_hours').classList.remove("d-none");
        }
    };
    govt = document.querySelector('#govt');
    non_govt = document.querySelector('#non_govt');
    govt.addEventListener('click', function(){
        if(govt.checked){
            document.querySelector('.hide_govt_department').classList.remove("d-none");
        }
    });
    non_govt.addEventListener('click', function(){
        if(non_govt.checked){
            document.querySelector('.hide_govt_department').classList.add("d-none");
        }
    });
</script>
<script>
    part_time = document.querySelector('#part_time');
    full_time = document.querySelector('#full_time');
    part_time.addEventListener('click', function(){
        if(part_time.checked){
            document.querySelector('.hide_working_hours').classList.remove("d-none");
        }
    });
    full_time.addEventListener('click', function(){
        if(full_time.checked){
            document.querySelector('.hide_working_hours').classList.add("d-none");
        }
    });
</script>
@endsection