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
            <form method="POST" action="{{ route('professional.update', $user->id) }}" aria-label="{{ __('Update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="role" value="professional">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="name">{{ __('First Name ') }} <span class="text-danger mt-2">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->professional_profile->name ?? 'N/A'}}" placeholder="Name" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="lname">{{ __('Last Name ') }} <span class="text-danger mt-2">*</span></label>
                        <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ $user->professional_profile->last_name ?? 'N/A'}}" placeholder="Name" required>
                        @if ($errors->has('lname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="address">{{ __('Address ') }} <span class="text-danger">*</span></label>
                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $user->professional_profile->address ?? 'N/A'}}" placeholder="Address" required>
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="nric">{{ __('Passport/NRIC ') }} <span class="text-danger">*</span></label>
                        <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ $user->professional_profile->nric ?? 'N/A'}}" required>
                        @if ($errors->has('nric'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nric') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br><hr>
                {{-- <label for="from">{{ __('Date of Birth') }} <span class="text-danger mt-2">*</span></label> --}}
                <div id="from" class="form-group row">
                    {{-- <div class="col-sm-2">
                        <label></label>
                        <select class="form-control" name="dob_day" id="" required>
                            <option value="">--Day--</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{$i}}" {{$user->professional_profile->dob_day() == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label></label>
                        <select class="form-control" name="dob_month" id="" required>
                            <option value="">--Month--</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}" {{$user->professional_profile->dob_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-2">
                    <label></label>
                        <select class="form-control" name="dob_year" id="" required>
                            <option value="">--Year--</option>
                            @for ($i = 1960; $i <= date('Y', time()); $i++)
                                <option value="{{$i}}" {{$user->professional_profile->dob_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>   --}}

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" min="1900-01-01" max="2200-01-01" value="{{ $user->professional_profile->dob ? \Carbon\Carbon::parse($user->professional_profile->dob)->format('Y-m-d') : ''}}" placeholder="Date Of Date" >
    
                            @if ($errors->has('dob'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="country">{{ __('Country') }} <span class="text-danger mt-2">*</span></label>
                        <select name="country" id="person_country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                            <option value="{{$user->professional_profile->country}}">{{$user->professional_profile->job_seeker_country_data->name ?? 'N/A'}}</option>
                            @foreach ($countrys as $country)
                                <option value="{{$country->id}}" {{$country->name == $user->professional_profile->country ? 'selected':''}}>{{$country->name}}</option>
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
                            <option value="{{$user->professional_profile->state}}" disable="true" selected="true">{{$user->professional_profile->job_seeker_state_data->name ?? 'N/A'}}</option>
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
                            <option value="{{$user->professional_profile->city}}">{{$user->professional_profile->job_seeker_city_data->name ?? 'N/A'}}</option>
                        </select>
                    </div>
                </div><br><hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="email">{{ __('Email') }} <span class="text-danger mt-2">*</span></label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->professional_profile->email ?? 'N/A'}}" placeholder="Email" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="phone">{{ __('Mobile Number') }} <span class="text-danger mt-2">*</span></label>
                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->professional_profile->phone ?? 'N/A'}}" placeholder="Mobile Number" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="expected_salary">{{ __('Expected Salary') }} <span class="text-danger mt-2">*</span></label>
                        <input id="expected_salary" type="text" class="form-control{{ $errors->has('expected_salary') ? ' is-invalid' : '' }}" name="expected_salary" value="{{ $user->professional_profile->expected_salary ?? 'N/A'}}" placeholder="Expected Salary" required>
                        @if ($errors->has('expected_salary'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expected_salary') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="resume_headline">{{ __('Job Category ') }} <span class="text-danger mt-2">*</span></label>
                        <select name="resume_headline" id="resume_headline" class="form-control{{ $errors->has('resume_headline') ? ' is-invalid' : '' }}" required>
                            <option value="{{$user->professional_profile->job_category}}">{{$user->professional_profile->job_seeker_job_category_data->name ?? 'N/A'}}</option>
                            @foreach ($PositionNames as $PositionName)
                                <option value="{{$PositionName->id}}" {{$user->professional_profile->resume_headline == $PositionName->name ? 'selected' : ''}}>{{$PositionName->name ?? 'N/A'}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('resume_headline'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('resume_headline') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="hired">Status For Hired <span class="text-danger mt-2">*</span></label>
                        <select name="hired" id="hired" class="form-control{{ $errors->has('hired') ? ' is-invalid' : '' }}">
                            <option value="">Select Option</option>
                            <option value="2" {{isset($applicants->invited_by_employer) == 2 ? 'selected' : ''}}>Hired</option>
                            <option value="1" {{isset($applicants->invited_by_employer) == 1 ? 'selected' : ''}}>UnHired</option>
                        </select>
                    </div>
                </div><br><hr>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="skills">{{ __('Skills (Seperate with comma)') }}</label>
                        <input id="skills" type="text" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" value="{{ $user->professional_profile->skills ?? 'N/A'}}" placeholder="Skills">
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
                        <input id="it_skills" type="text" class="form-control{{ $errors->has('it_skills') ? ' is-invalid' : '' }}" name="it_skills" value="{{ $user->professional_profile->it_skills ?? 'N/A'}}" placeholder="IT Skills">
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
                        @if($user->professional_profile->resume_file)
                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->resume_file)}}">View Resume</a>
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
                        @if($user->professional_profile->modified_resume_file)
                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->modified_resume_file)}}">View Modified Resume</a>
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
                        @if($user->professional_profile->profile_image)
                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->profile_image)}}">View Profile Image</a>
                        @endif
                        @if ($errors->has('profile_image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('profile_image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><br>










                <div><h3> Add Experience</h3> </div>
                @if(count($user->professional_experiences)>0)
                @foreach ($user->professional_experiences as $professional_experience)
                <div class="col-md-11">
                    <div class="form-group row">
                        <label for="designation" class="col-sm-4 col-form-label text-right">{{ __('Designation ') }}</label>
                        <div class="col-sm-8">
                            <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation[]" value="{{ $professional_experience->designation }}" placeholder="Designation">

                        @if ($errors->has('designation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('designation') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company ') }}</label>
                        <div class="col-sm-8">
                            <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company[]" value="{{ $professional_experience->company }}" placeholder="Company">

                        @if ($errors->has('company'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="from" class="col-sm-4 col-form-label text-right">{{ __('From ') }}</label>
                        <div class="col-sm-8">
                            {{-- <input id="from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from[]" value="{{ $professional_experience->from }}" placeholder="from" required> --}}
                            <div class="row">
                                {{-- <div class="col-sm-6">
                                    <select class="form-control" name="from_month[]" id="">
                                        <option value="">--Month--</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" {{$professional_experience->from_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" name="from_year[]" id="">
                                        <option value="">--Year--</option>
                                        @for ($i = 1960; $i <= date('Y', time()); $i++)
                                            <option value="{{$i}}" {{$professional_experience->from_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div> --}}

                                <div class="col-md-6">
                                    <div id="div_id_1_from_date" class="form-group">
                                        <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$professional_experience->from ? \Carbon\Carbon::parse($professional_experience->from)->format('Y-m-d') : ''}}" name="from_date[]">
                                    </div>
                                </div>
                            </div>

                        @if ($errors->has('from'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('from') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right">{{ __('Present Job?') }}</label>
                        <div class="col-sm-8">
                            <div class="form-check mt-2">
                                <input type="hidden" name="is_present_job[]" value="0" />
                                <input onchange="hideInput(this);" type="checkbox" class="form-check-input" {{ $professional_experience->is_present_job == 1 ? 'checked' : ''}} value="1" id="is_present_job">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="to" class="col-sm-4 col-form-label text-right">{{ __('To') }}</label>
                        <div class="col-sm-8">
                            {{-- <input id="to" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to[]" value="{{ $professional_experience->to }}" placeholder="To"> --}}
                            <div class="row">
                                {{-- <div class="col-sm-6">
                                    <select class="form-control" name="to_month[]" id="">
                                        <option value="">--Month--</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{$i}}" {{$professional_experience->to_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control" name="to_year[]" id="">
                                        <option value="">--Year--</option>
                                        @for ($i = 1960; $i <= date('Y', time()); $i++)
                                            <option value="{{$i}}" {{$professional_experience->to_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div> --}}

                                <div class="col-md-6">
                                    <div id="div_id_1_to_date" class="form-group">
                                        <label for="id_1_to_date">{{ __('To Date') }}</label>
                                        <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$professional_experience->to ? \Carbon\Carbon::parse($professional_experience->to)->format('Y-m-d') : ''}}" name="to_date[]">
                                    </div>
                                </div>
                            </div>
                        @if ($errors->has('to'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('to') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position_level" class="col-sm-4 col-form-label text-right">{{ __('Position Level') }}</label>
                        <div class="col-sm-8">
                            <input id="position_level" type="text" class="form-control{{ $errors->has('position_level') ? ' is-invalid' : '' }}" name="position_level[]" value="{{ $professional_experience->position_level }}" placeholder="Position Level">

                        @if ($errors->has('position_level'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('position_level') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="experience_description" class="col-sm-4 col-form-label text-right">{{ __('Experience Description ') }}</label>
                        <div class="col-sm-8">
                            <textarea class="form-control{{ $errors->has('experience_description') ? ' is-invalid' : '' }}" name="experience_description[]" id="experience_description" cols="30" rows="9" >{{ $professional_experience->experience_description }}</textarea>
                        @if ($errors->has('experience_description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('experience_description') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="mt-4 mb-4"/>
                </div>
                @endforeach
            @else
            <div class="col-md-11">
                <div class="form-group row">
                    <label for="designation" class="col-sm-4 col-form-label text-right">{{ __('Designation ') }}</label>
                    <div class="col-sm-8">
                        <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation[]" value="{{ old('designation') }}" placeholder="Designation" >

                    @if ($errors->has('designation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('designation') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company ') }}</label>
                    <div class="col-sm-8">
                        <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company[]" value="{{ old('company') }}" placeholder="Company" >

                    @if ($errors->has('company'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('company') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="from" class="col-sm-4 col-form-label text-right">{{ __('From ') }}</label>
                    <div class="col-sm-8">
                        {{-- <input id="from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from[]" value="{{ old('from') }}" placeholder="from" required> --}}
                        <div class="row">
                            {{-- <div class="col-sm-6">
                                <select class="form-control" name="from_month[]" id="">
                                    <option value="0">--Month--</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control" name="from_year[]" id="">
                                    <option value="0">--Year--</option>
                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div> --}}


                            <div class="col-md-6">
                                <div id="div_id_1_from_date" class="form-group">
                                    <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="from_date[]">
                                </div>
                            </div>
                        </div>
                    @if ($errors->has('from'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('from') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-right">{{ __('Present Job?') }}</label>
                    <div class="col-sm-8">
                        <div class="form-check mt-2">
                            <input type="hidden" name="is_present_job[]" value="0" />
                            <input onchange="hideInput(this);" type="checkbox" class="form-check-input" {{old('is_present_job') == 1 ? 'checked' : ''}} value="1" id="is_present_job">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="to" class="col-sm-4 col-form-label text-right">{{ __('To') }}</label>
                    <div class="col-sm-8">
                        {{-- <input id="to" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to[]" value="{{ old('to') }}" placeholder="To"> --}}
                        <div class="row">
                            {{-- <div class="col-sm-6">
                                <select class="form-control" name="to_month[]" id="">
                                    <option value="">--Month--</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control" name="to_year[]" id="">
                                    <option value="">--Year--</option>
                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div> --}}

                            <div class="col-md-6">
                                <div id="div_id_1_to_date" class="form-group">
                                    <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="to_date[]">
                                </div>
                            </div>
                        </div>
                    @if ($errors->has('to'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('to') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="position_level" class="col-sm-4 col-form-label text-right">{{ __('Position Level') }}</label>
                    <div class="col-sm-8">
                        <input id="position_level" type="text" class="form-control{{ $errors->has('position_level') ? ' is-invalid' : '' }}" name="position_level[]" value="{{ old('position_level') }}" placeholder="Position Level">

                    @if ($errors->has('position_level'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('position_level') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="experience_description" class="col-sm-4 col-form-label text-right">{{ __('Experience Description ') }}</label>
                    <div class="col-sm-8">
                        <textarea class="form-control{{ $errors->has('experience_description') ? ' is-invalid' : '' }}" name="experience_description[]" id="experience_description" cols="30" rows="9" >{{ old('experience_description') }}</textarea>
                    @if ($errors->has('experience_description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('experience_description') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr class="mt-4 mb-4"/>
            </div>
            @endif
            
            <div id="czContainerExperience">
                <div id="first">
                    <div class="recordset">
                        <div class="fieldRow clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="designation" class="col-sm-4 col-form-label text-right">{{ __('Designation ') }}</label>
                                        <div class="col-sm-8">
                                            <input id="designation" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation[]" value="{{ old('designation') }}" placeholder="Designation" >
            
                                        @if ($errors->has('designation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company" class="col-sm-4 col-form-label text-right">{{ __('Company ') }}</label>
                                        <div class="col-sm-8">
                                            <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company[]" value="{{ old('company') }}" placeholder="Company" >
            
                                        @if ($errors->has('company'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="from" class="col-sm-4 col-form-label text-right">{{ __('From ') }}</label>
                                        <div class="col-sm-8">
                                            {{-- <input id="from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from[]" value="{{ old('from') }}" placeholder="from" required> --}}
                                            <div class="row">
                                                {{-- <div class="col-sm-6">
                                                    <select class="form-control" name="from_month[]" id="">
                                                        <option value="">--Month--</option>
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="from_year[]" id="">
                                                        <option value="">--Year--</option>
                                                        @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div> --}}

                                                <div class="col-md-6">
                                                    <div id="div_id_1_from_date" class="form-group">
                                                        <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="from_date[]">
                                                    </div>
                                                </div>
                                            </div>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('from') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">{{ __('Present Job?') }}</label>
                                        <div class="col-sm-8">
                                            <div class="form-check mt-2">
                                                <input type="hidden" name="is_present_job[]" value="0" />
                                                <input onchange="hideInput(this);" type="checkbox" class="form-check-input" {{old('is_present_job') == 1 ? 'checked' : ''}} value="1" id="is_present_job">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="to" class="col-sm-4 col-form-label text-right">{{ __('To') }}</label>
                                        <div class="col-sm-8">
                                            {{-- <input id="to" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to[]" value="{{ old('to') }}" placeholder="To"> --}}
                                            <div class="row">
                                                {{-- <div class="col-sm-6">
                                                    <select class="form-control" name="to_month[]" id="">
                                                        <option value="">--Month--</option>
                                                        @for ($i = 1; $i <= 12; $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="to_year[]" id="">
                                                        <option value="">--Year--</option>
                                                        @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div> --}}

                                                <div class="col-md-6">
                                                    <div id="div_id_1_to_date" class="form-group">
                                                        <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="to_date[]">
                                                    </div>
                                                </div>
                                            </div>
                                        @if ($errors->has('to'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('to') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="position_level" class="col-sm-4 col-form-label text-right">{{ __('Position Level') }}</label>
                                        <div class="col-sm-8">
                                            <input id="position_level" type="text" class="form-control{{ $errors->has('position_level') ? ' is-invalid' : '' }}" name="position_level[]" value="{{ old('position_level') }}" placeholder="Position Level">
            
                                        @if ($errors->has('position_level'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('position_level') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="experience_description" class="col-sm-4 col-form-label text-right">{{ __('Experience Description ') }}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control{{ $errors->has('experience_description') ? ' is-invalid' : '' }}" name="experience_description[]" id="experience_description" cols="30" rows="9" >{{ old('experience_description') }}</textarea>
                                        @if ($errors->has('experience_description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('experience_description') }}</strong>
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







            <div><h3> Add Education</h3> </div>
            @if(count($user->qualifications)>0)
            @foreach ($user->qualifications as $qualification)
            <div class="col-md-11">
                <div class="form-group row">
                    <label for="university" class="col-sm-4 col-form-label text-right">{{ __('Institute/University/College ') }}</label>
                    <div class="col-sm-8">
                        <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university[]" value="{{ $qualification->university }}" placeholder="Institute/University" >

                    @if ($errors->has('university'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('university') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="graduation_date" class="col-sm-4 col-form-label text-right">{{ __('Graduation Date ') }}</label>
                    <div class="col-sm-8">
                        {{-- <input id="graduation_date" type="number" min="1900" class="form-control{{ $errors->has('graduation_date') ? ' is-invalid' : '' }}" name="graduation_date[]" value="{{ $qualification->passing_year }}" placeholder="Graduation Date" required> --}}
                        <div class="row">
                            {{-- <div class="col-sm-4">
                                <select class="form-control" name="graduation_day[]" id="">
                                    <option value="">--Day--</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{$i}}" {{$qualification->graduation_day() == $i ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="graduation_month[]" id="">
                                    <option value="">--Month--</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{$i}}" {{$qualification->graduation_month() == $i ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div> --}}

                            <div class="col-md-6">
                                <div id="div_id_1_to_date" class="form-group">
                                    <label for="id_1_to_date">{{ __('To Date') }}</label>
                                    <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{$qualification->graduation_date ? \Carbon\Carbon::parse($qualification->graduation_date)->format('Y-m-d') : ''}}" name="graduation_date[]">
                                </div>
                            </div>
                            {{-- <div class="col-sm-4">
                                <select class="form-control" name="graduation_year[]" id="">
                                    <option value="">--Year--</option>
                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                        <option value="{{$i}}" {{$qualification->graduation_year() == $i ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div> --}}
                        </div>
                    @if ($errors->has('graduation_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('graduation_date') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Qualification ') }}</label>
                    <div class="col-sm-8">
                        {{-- <input id="qualification" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" value="{{ $qualification->qualification }}" placeholder="Qualification" required> --}}
                        <select class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" id="qualification" >
                            <option value="">--Select Qualification--</option>
                            @foreach ($qualifications as $q)
                                <option value="{{$q->name}}" {{$qualification->qualification == $q->name ? 'selected' : '' }}>{{$q->name}}</option>
                            @endforeach
                        </select>

                    @if ($errors->has('qualification'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('qualification') }}</strong>
                        </span>
                    @endif
                    </div>
                </div><hr>
                <div class="form-group row">
                    <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study ') }}</label>
                    <div class="col-sm-8">
                        {{-- <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ $qualification->subject }}" placeholder="Field of Study" required> --}}
                        <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" id="subject" >
                            <option value="">--Select Field of Study--</option>
                            @foreach ($field_of_studys as $study)
                                <option value="{{$study->name}}" {{$qualification->subject == $study->name ? 'selected' : '' }}>{{$study->name}}</option>
                            @endforeach
                        </select>
                    @if ($errors->has('subject'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif
                    </div>
                </div><hr>
                <div class="form-group row">
                    <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization ') }}</label>
                    <div class="col-sm-8">
                        <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization[]" value="{{ $qualification->specialization }}" placeholder="Specialization">

                    @if ($errors->has('specialization'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specialization') }}</strong>
                        </span>
                    @endif
                    </div>
                </div><hr>
                <div class="form-group row">
                    <label for="others" class="col-sm-4 col-form-label text-right">{{ __('Others ') }}</label>
                    <div class="col-sm-8">
                        <textarea name="others[]" class="form-control">{{ $qualification->others }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <hr class="mt-4 mb-4"/>
            </div>
            @endforeach
        @else
        <div class="col-md-11">
            <div class="form-group row">
                <label for="university" class="col-sm-4 col-form-label text-right">{{ __('Institute/University/College ') }}</label>
                <div class="col-sm-8">
                    <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university[]" value="{{ old('university') }}" placeholder="Institute/University" >
                    @if ($errors->has('university'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('university') }}</strong>
                        </span>
                    @endif
                </div>
                <hr>
            </div><hr>
            <div class="form-group row">
                <label for="graduation_date" class="col-sm-4 col-form-label text-right">{{ __('Graduation Date ') }}</label>
                <div class="col-sm-8">
                    {{-- <input id="graduation_date" type="number" min="1900" class="form-control{{ $errors->has('graduation_date') ? ' is-invalid' : '' }}" name="graduation_date[]" value="{{ old('graduation_date') }}" placeholder="Graduation Date" required> --}}
                    <div class="row">
                        {{-- <div class="col-sm-4">
                            <select class="form-control" name="graduation_day[]" id="">
                                <option value="">--Day--</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="graduation_month[]" id="">
                                <option value="">--Month--</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="graduation_year[]" id="">
                                <option value="">--Year--</option>
                                @for ($i = 1960; $i <= date('Y', time()); $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div> --}}

                        <div class="col-md-6">
                            <div id="div_id_1_from_date" class="form-group">
                                <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="graduation_date[]">
                            </div>
                        </div>
                    </div>
                @if ($errors->has('graduation_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('graduation_date') }}</strong>
                    </span>
                @endif
                </div>
            </div><hr>
            <div class="form-group row">
                <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Qualification ') }}</label>
                <div class="col-sm-8">
                    {{-- <input id="qualification" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" value="{{ old('qualification') }}" placeholder="Qualification" required> --}}
                    <select class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" id="qualification" >
                            <option value="">--Select Qualification--</option>
                            @foreach ($qualifications as $qualification)
                                <option value="{{$qualification->name}}">{{$qualification->name}}</option>
                            @endforeach
                        </select>
                @if ($errors->has('qualification'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('qualification') }}</strong>
                    </span>
                @endif
                </div>
            </div><hr>
            <div class="form-group row">
                <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study ') }}</label>
                <div class="col-sm-8">
                    {{-- <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ old('subject') }}" placeholder="Field of Study" required> --}}
                    <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" id="subject">
                        <option value="">--Select Field of Study--</option>
                        @foreach ($field_of_studys as $study)
                            <option value="{{$study->name}}">{{$study->name}}</option>
                        @endforeach
                    </select>
                @if ($errors->has('subject'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                @endif
                </div>
            </div><hr>
            <div class="form-group row">
                <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization ') }}</label>
                <div class="col-sm-8">
                    <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization[]" value="{{ old('specialization') }}" placeholder="Specialization">

                @if ($errors->has('specialization'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('specialization') }}</strong>
                    </span>
                @endif
                </div>
            </div><hr>
            <div class="form-group row">
                <label for="others" class="col-sm-4 col-form-label text-right">{{ __('Others ') }}</label>
                <div class="col-sm-8">
                    <textarea name="others[]" class="form-control">{{ $qualification->others }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr class="mt-4 mb-4"/>
        </div>
        @endif
        
        <div id="czContainerEducation">
            <div id="first">
                <div class="recordset">
                    <div class="fieldRow clearfix">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="university" class="col-sm-4 col-form-label text-right">{{ __('Institute/University/College') }}</label>
                                    <div class="col-sm-8">
                                        <input id="university" type="text" class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university[]" value="{{ old('university') }}" placeholder="Institute/University">
        
                                    @if ($errors->has('university'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <label for="graduation_date" class="col-sm-4 col-form-label text-right">{{ __('Graduation Date ') }}</label>
                                    <div class="col-sm-8">
                                        {{-- <input id="graduation_date" type="number" min="1900" class="form-control{{ $errors->has('graduation_date') ? ' is-invalid' : '' }}" name="graduation_date[]" value="{{ old('graduation_date') }}" placeholder="Graduation Date" required> --}}
                                        <div class="row">
                                            {{-- <div class="col-sm-4">
                                                <select class="form-control" name="graduation_day[]" id="">
                                                    <option value="">--Day--</option>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="graduation_month[]" id="">
                                                    <option value="">--Month--</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="graduation_year[]" id="">
                                                    <option value="">--Year--</option>
                                                    @for ($i = 1960; $i <= date('Y', time()); $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div id="div_id_1_from_date" class="form-group">
                                                    <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" name="graduation_date[]">
                                                </div>
                                            </div>
                                        </div>
                                    @if ($errors->has('graduation_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('graduation_date') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <label for="qualification" class="col-sm-4 col-form-label text-right">{{ __('Qualification ') }}</label>
                                    <div class="col-sm-8">
                                        {{-- <input id="qualification" type="text" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" value="{{ old('qualification') }}" placeholder="Qualification" required> --}}
                                        <select class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}" name="qualification[]" id="qualification" required>
                                            <option value="">--Select Qualification--</option>
                                            @foreach ($qualifications as $qualification)
                                                <option value="{{$qualification->name}}">{{$qualification->name}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('qualification'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('qualification') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <label for="subject" class="col-sm-4 col-form-label text-right">{{ __('Field of Study ') }}</label>
                                    <div class="col-sm-8">
                                        {{-- <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" value="{{ old('subject') }}" placeholder="Field of Study" required> --}}
                                        <select class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject[]" id="subject" >
                                            <option value="">--Select Field of Study--</option>
                                            @foreach ($field_of_studys as $study)
                                                <option value="{{$study->name}}">{{$study->name}}</option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <label for="specialization" class="col-sm-4 col-form-label text-right">{{ __('Specialization ') }}</label>
                                    <div class="col-sm-8">
                                        <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization[]" value="{{ old('specialization') }}" placeholder="Specialization">
        
                                    @if ($errors->has('specialization'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('specialization') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <label for="others" class="col-sm-4 col-form-label text-right">{{ __('Others ') }}</label>
                                    <div class="col-sm-8">
                                        <textarea name="others[]" class="form-control">{{ $qualification->others }}</textarea>
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
            var divPlus = '<div id="btnPlus" class="btnPlus"></div>';
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
                  //'background-position': 'center center',
                  'background-repeat': 'no-repeat',
                  'height': '25px',
                  'padding-left': '25px',
                  'cursor': 'pointer',
                  'margin-left': '220px'
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
        $("#czContainerExperience").czMore();
    </script>
     <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
        $("#czContainerEducation").czMore();
    </script>
    <script>
        function hideInput(x)
        {
            console.log(x.previousElementSibling.value);
            if(x.checked){
                console.log('checked');
                x.previousElementSibling.value = 1;
                x.parentElement.parentElement.parentElement.nextElementSibling.classList.add("d-none");
            }else if(!x.checked){
                console.log('unchecked');
                x.previousElementSibling.value = 0;
                x.parentElement.parentElement.parentElement.nextElementSibling.classList.remove("d-none");
            }
        }
    </script>
@endsection
