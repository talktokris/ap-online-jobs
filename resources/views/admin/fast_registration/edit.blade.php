@extends('employer.app')
@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"><span class="mr-3">Personal</span></h4>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="card-body">
        <form method="POST" action="{{route('admin.fast_registration.update',$user->id)}}" aria-label="{{ __('Update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="role" value="professional">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="full_name">Full Name<span class="text-danger mt-2">*</span></label>
                        <input id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ $user->full_name ?? 'N/A'}}" placeholder="Name" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="address">{{ __('Address ') }} </label>
                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $user->address ?? 'N/A'}}" placeholder="Address">
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="nric">{{ __('Passport/NRIC ') }}</label>
                        <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ $user->nric ?? 'N/A'}}" >
                        @if ($errors->has('nric'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nric') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="form-group">
                        <label for="dob">Date Of Birth</label>
                        <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" min="1900-01-01" max="2200-01-01" value="{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : ''}}" placeholder="Passport Issue Date" >

                        @if ($errors->has('dob'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> --}}
                <br><hr>
                <label for="from">{{ __('Date of Birth') }} </label>
                <div id="from" class="form-group row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dob"></label>
                            <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" min="1900-01-01" max="2200-01-01" value="{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : ''}}" placeholder="Passport Issue Date" >
    
                            @if ($errors->has('dob'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-sm-2">
                        <label></label>
                        <select class="form-control" name="dob_day" id="" >
                            <option value="">--Day--</option>
                            @for ($i = 0; $i <= 31; $i++)
                                <option value="{{$i}}" {{$user->dob_day() == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label></label>
                        <select class="form-control" name="dob_month" id="" >
                            <option value="">--Month--</option>
                            @for ($i = 0; $i <= 12; $i++)
                                <option value="{{$i}}" {{$user->dob_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-2">
                    <label></label>
                        <select class="form-control" name="dob_year" id="">
                            <option value="">--Year--</option>
                            @for ($i = 1960; $i <= date('Y', time()); $i++)
                                <option value="{{$i}}" {{$user->dob_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>   --}}
                    <div class="col-sm-3">
                        <label for="country">{{ __('Country') }} </label>
                        <select name="country" id="person_country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" >
                            {{-- <option value="{{$user->country}}">{{$user->professional_profile->job_seeker_country_data->name ?? 'N/A'}}</option> --}}
                            <option value="" >Select Country</option>
                            @foreach ($countrys as $country)
                                <option value="{{$country->id}}" {{$country->id == $user->person_country ? 'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="state">{{ __('State') }}<span class="text-danger">*</span></label>
                        <select name="state" id="person_state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" required>
                            {{-- <option value="{{$user->state_id}}" disable="true" selected="true">{{$user->state->name ?? 'N/A'}}</option> --}}
                            <option value="" >Select State</option>
                            @foreach ($state as $state)
                                <option value="{{$state->id}}" {{$state->id == $user->state_id ? 'selected':''}}>{{$state->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="city">{{ __('City') }} <span class="text-danger mt-2">*</span></label>
                        <select name="city" id="person_city" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                            <option value="{{$user->city_id}}">{{$user->city->name ?? 'N/A'}}</option>
                        </select>
                    </div>
                </div><br><hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="email">{{ __('Email') }} </label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email ?? 'N/A'}}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="phone">{{ __('Mobile Number') }} <span class="text-danger mt-2">*</span></label>
                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->number ?? 'N/A'}}" placeholder="Mobile Number" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="expected_salary">{{ __('Expected Salary') }} </label>
                        <input id="expected_salary" type="text" class="form-control{{ $errors->has('expected_salary') ? ' is-invalid' : '' }}" name="expected_salary" value="{{ $user->expected_salary ?? 'N/A'}}" placeholder="Expected Salary">
                        @if ($errors->has('expected_salary'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expected_salary') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="job_category">{{ __('Job Category ') }}</label>
                        <select name="job_category" id="job_category" class="form-control{{ $errors->has('job_category') ? ' is-invalid' : '' }}" >
                            <option value="">Select Job Category</option>
                            @foreach ($PositionNames as $PositionName)
                                <option value="{{$PositionName->id}}" {{$user->job_category == $PositionName->id ? 'selected' : ''}}>{{$PositionName->name ?? 'N/A'}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('job_category'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('job_category') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br><hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="skills">{{ __('Skills (Seperate with comma)') }}</label>
                        <input id="skills" type="text" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" value="{{ $user->skills ?? 'N/A'}}" placeholder="Skills">
                        @if ($errors->has('skills'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('skills') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br><hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="it_skills">{{ __('IT Skills (Seperate with comma)') }}</label>
                        <input id="it_skills" type="text" class="form-control{{ $errors->has('it_skills') ? ' is-invalid' : '' }}" name="it_skills" value="{{ $user->it_skills ?? 'N/A'}}" placeholder="IT Skills">
                        @if ($errors->has('it_skills'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('it_skills') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br><hr>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="resume_file">{{ __('Upload Resume') }}</label>
                        <input id="resume_file" type="file" class="form-control-file{{ $errors->has('resume_file') ? ' is-invalid' : '' }}" name="resume_file" value="{{ old('resume_file') }}">
                        <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                        @if($user->resume_file)
                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->resume_file)}}">View Resume</a>
                        @endif
                        @if ($errors->has('resume_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('resume_file') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label for="modified_resume_file">{{ __('Upload Modified Resume') }}</label>
                        <input id="modified_resume_file" type="file" class="form-control-file{{ $errors->has('modified_resume_file') ? ' is-invalid' : '' }}" name="modified_resume_file" value="{{ old('modified_resume_file') }}">
                        <p class="text-danger">Supported file format JPG, PNG & PDF. Maximum file size: 1MB</p>
                        @if($user->modified_resume_file)
                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->modified_resume_file)}}">View Modified Resume</a>
                        @endif
                        @if ($errors->has('modified_resume_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('resume_file') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label for="profile_image">{{ __('Upload Profile Image') }}</label>
                        <input id="profile_image" type="file" class="form-control-file{{ $errors->has('profile_image') ? ' is-invalid' : '' }}" name="profile_image" value="{{ old('profile_image') }}">
                        <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                        @if($user->profile_image)
                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->profile_image)}}">View Profile Image</a>
                        @endif
                        @if ($errors->has('profile_image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('profile_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br>

                <div class="col-md-12 pb-5 pt-5 page-section" id="Education">
                    <h3 class="">Education</h3>
                    @foreach ($user->blue_worker_education as $education)
                    <div class="row">
                        <div class="col-md-6">
                            <div id="div_id_1_education_level" class="form-group">
                                <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                <select name="education_level[]" id="id_1_education_level" class="form-control">
                                    <option value="">--Select Education Level--</option>
                                    @foreach ($education_levels as $education_level)
                                        <option value="{{$education_level->id}}" {{$education_level->id == $education->education_level ? 'selected':''}}>{{$education_level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_id_1_education_remark" class="form-group">
                                <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" value="{{$education->education_remark}}" placeholder="Education Remark">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-4 mb-4"/>
                        </div>
                    </div>
                    @endforeach
                    <div id="czContainerEducation">
                        <div id="first">
                            <div class="recordset">
                                <div class="fieldRow clearfix">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="div_id_1_education_level" class="form-group">
                                                <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                                {{-- <input id="id_1_education_level" type="text" class="form-control" name="education_level[]" placeholder="Education Level"> --}}
                                                <select name="education_level[]" id="id_1_education_level" class="form-control">
                                                    <option value="">--Select Education Level--</option>
                                                    @foreach ($education_levels as $education_level)
                                                        <option value="{{$education_level->id}}" {{$education_level->id == old('nationality') ? 'selected':''}}>{{$education_level->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div id="div_id_1_education_remark" class="form-group">
                                                <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                                <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" placeholder="Education Remark">
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

                <div class="col-md-12 pt-5 page-section" id="Experience">
                    <h3 class="">Experience</h3>
                    @foreach ($user->blue_worker_experience as $experience)
                    <div class="row">
                        <div class="col-md-6">
                            <div id="div_id_1_company_name" class="form-group">
                                <label for="id_1_company_name"">Company Name</label>
                                <input id="id_1_company_name" type="text" class="form-control" name="company_name[]" placeholder="Company Name" value="{{$experience->company}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_id_1_designation" class="form-group">
                                <label for="id_1_designation"">Designation</label>
                                <input id="id_1_designation" type="text" class="form-control" name="designation[]" placeholder="Designation Name" value="{{$experience->designation}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_id_1_from_date" class="form-group">
                                <label for="id_1_from_date">{{ __('From Date') }}</label>
                                <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$experience->from ? \Carbon\Carbon::parse($experience->from)->format('Y-m-d') : ''}}" name="from_date[]">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_id_1_to_date" class="form-group">
                                <label for="id_1_to_date">{{ __('To Date') }}</label>
                                <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$experience->to ? \Carbon\Carbon::parse($experience->to)->format('Y-m-d') : ''}}" name="to_date[]">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="div_id_1_remark" class="form-group">
                                <label for="id_1_remark">{{ __('Remark') }}</label>
                                <input id="id_1_remark" type="text" class="form-control" name="experience_description[]" value="{{$experience->experience_description}}" placeholder="Remark">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr class="mt-4 mb-4"/>
                        </div>
                    </div>
                    @endforeach
                    <div id="czContainer">
                        <div id="first">
                            <div class="recordset">
                                <div class="fieldRow clearfix">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div id="div_id_1_company_name" class="form-group">
                                                <label for="id_1_company_name">Company Name</label>
                                                <input id="id_1_company_name" type="text" class="form-control" name="company_name[]" placeholder="Employers Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="div_id_1_designation" class="form-group">
                                                <label for="id_1_designation">Designation</label>
                                                <input id="id_1_designation" type="text" class="form-control" name="designation[]" placeholder="Employers Name" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="div_id_1_from_date" class="form-group">
                                                <label for="id_1_from_date">{{ __('From Date') }}</label>
                                                <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="from_date[]">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div id="div_id_1_to_date" class="form-group">
                                                <label for="id_1_to_date">{{ __('To Date') }}</label>
                                                <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="to_date[]">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="div_id_1_remark" class="form-group">
                                                <label for="id_1_remark">{{ __('Remark') }}</label>
                                                <input id="id_1_remark" type="text" class="form-control" name="experience_description[]" placeholder="Remark">
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

                <div class="form-group row mb-0">
                    <button type="submit" class="btn btn-warning btn-block">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(window).scroll(function() {
        var scrollDistance = $(window).scrollTop();

        // Assign active class to nav links while scolling
        $('.page-section').each(function(i) {
                if ($(this).position().top <= scrollDistance+250) {
                        $('.bottom-menu a.btn-danger').removeClass('btn-danger');
                        $('.bottom-menu a').eq(i).addClass('btn-danger');
                }
        });
    }).scroll();
    </script>
    <script>
        function previewFile(preview, source) {
            var preview = document.querySelector(preview);
            var file    = document.querySelector(source).files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
            console.log(preview.src);
        }
    </script>
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
            var divPlus = '<div id="btnPlus" class="btnPlus"/>';
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
                  'width': '25px',
                  'cursor': 'pointer',
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
    <script>
        $('#sector').on('change', function() {
            //console.log( this.value );
            $('#sub_sector').empty()
            $.ajax({
                url: '/admin/getSubsectors/'+this.value,
                success: data => {
                    x =  data.sub_sectors;
                    if(x.length < 1){
                        $('#sub_sector').append('<option value="">--No Sub Sector for this sector--</option>')
                    }else{
                        $('#sub_sector').append('<option value="">--Select Sub Sector--</option>');
                    }
                    
                    data.sub_sectors.forEach(sub_sector =>
                        $('#sub_sector').append('<option value="'+sub_sector.id + '">' + sub_sector.name + '</option>')
                    )
                }
            })
        });
    </script>
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
        $("#czContainerEducation").czMore();
    </script>
@endsection
