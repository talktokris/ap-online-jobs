@extends('employer.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-dark">
        <div class="col-12">
            <h4 class="text-center text-white pb-3 pt-4"> <button class="btn btn-info" onclick="location.href='{{route('employer.show')}}'" type="button">Back</button> Post Job </h4>
        </div>
    </div>
</div>
<!----------Start Multi Step Form Design---------->
<div class="tab-banner">
    <span class="step">Vacancies Details</span>
    <span class="step">Contact Details</span>
    <span class="step">Candidates Requirement</span>
    <span class="step">Academic Qualifications</span>
</div>
<div class="tab-section">
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card auth-form mb-5">
                <div class="card-body">
                    <form method="POST" id="job_post" action="{{ route('job.store') }}">
                        @csrf
                    <div class="tab">
                        <div class="form-group dis-cls">
                            <label for="positions_name" class="col-sm-4 col-form-label text-right">{{ __('Position Name ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <input type="hidden" name="worker_type" id="" value="{{$worker_type}}">
                                {{-- <input id="positions_name" type="text" class="form-control{{ $errors->has('positions_name') ? ' is-invalid' : '' }}" name="positions_name" value="{{ old('positions_name') }}" required> --}}
                                <select name="positions_name" id="positions_name" class="form-control{{ $errors->has('positions_name') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Position Name--</option>
                                    @foreach ($PositionNames as $PositionName)
                                        <option value="{{$PositionName->id}}">{{$PositionName->name}}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('positions_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('positions_name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="vacancies_description" class="col-sm-4 col-form-label text-right">{{ __('Vacancies Description ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <textarea name="vacancies_description" id="vacancies_description" class="required form-control{{ $errors->has('vacancies_description') ? ' is-invalid' : '' }}" cols="30" rows="6" required>{{ old('vacancies_description') }}</textarea>
                            @if ($errors->has('vacancies_description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('vacancies_description') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="scope_of_duties" class="col-sm-4 col-form-label text-right">{{ __('Scope of Duties ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <textarea name="scope_of_duties" id="scope_of_duties" class="form-control{{ $errors->has('scope_of_duties') ? ' is-invalid' : '' }}" cols="30" rows="6" required>{{ old('scope_of_duties') }}</textarea>
                            @if ($errors->has('scope_of_duties'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('scope_of_duties') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="skills" class="col-sm-4 col-form-label text-right">{{ __('Skills ') }}</label>
                            <div class="col-sm-8">
                                <input id="skills" type="text" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" value="{{ old('skills') }}">

                            @if ($errors->has('skills'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('skills') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="related_experience_year" class="col-sm-4 col-form-label text-right">{{ __('Experience ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-4">
                                <input id="related_experience_year" type="text" class="form-control{{ $errors->has('related_experience_year') ? ' is-invalid' : '' }}" name="related_experience_year" value="{{ old('related_experience_year') }}">
                            </div>
                            <div class="col-sm-4"><p class="mt-2">Years</p></div>
                            {{-- <div class="col-sm-4">
                                <input id="related_experience_month" type="text" class="form-control{{ $errors->has('related_experience_month') ? ' is-invalid' : '' }}" name="related_experience_month" value="{{ old('related_experience_month') }}" placeholder="Month">
                            </div> --}}
                        </div>
                        <div class="form-group dis-cls">
                            <label for="job_vacancies_type" class="col-sm-4 col-form-label text-right">{{ __('Job Vacancies Type ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <select name="job_vacancies_type" id="job_vacancies_type" class="form-control{{ $errors->has('job_vacancies_type') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Vacancies Type--</option>
                                    <option value="Permanent">Permanent</option>
                                    <option value="Part-Time">Part-Time</option>
                                    <option value="Contract">Contract</option>
                                </select>
                            @if ($errors->has('job_vacancies_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('job_vacancies_type') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="salary_offer" class="col-sm-4 col-form-label text-right">{{ __('Salary Offer ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-2">
                                <select name="salary_offer_currency" id="salary_offer_currency" class="form-control{{ $errors->has('salary_offer_currency') ? ' is-invalid' : '' }}">
                                    <option value="RM">RM</option>
                                    <option value="BDT">BDT</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input id="salary_offer" type="number" class="form-control{{ $errors->has('salary_offer') ? ' is-invalid' : '' }}" name="salary_offer" value="{{ old('salary_offer') }}" required>
                            </div>
                            <div class="col-sm-3">
                                <select name="salary_offer_period" id="salary_offer_period" class="form-control{{ $errors->has('salary_offer_period') ? ' is-invalid' : '' }}">
                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="postcode" class="col-sm-4 col-form-label text-right">{{ __('Job Location') }}</label>
                            <div class="col-sm-2">
                                <input id="town" type="text" class="form-control{{ $errors->has('town') ? ' is-invalid' : '' }}" name="town" value="{{ old('town') }}" placeholder="Town">
                            </div>
                            <div class="col-sm-2">
                                <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district') }}" placeholder="District">
                            </div>
                            <div class="col-sm-2">
                                    <input id="postcode" type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode">
                            </div>
                            
                            <div class="col-sm-2">
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="total_number_of_vacancies" class="col-sm-4 col-form-label text-right">{{ __('Total Number of Vacancies ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <input id="total_number_of_vacancies" type="number" class="form-control{{ $errors->has('total_number_of_vacancies') ? ' is-invalid' : '' }}" name="total_number_of_vacancies" value="{{ old('total_number_of_vacancies') }}" required>

                            @if ($errors->has('total_number_of_vacancies'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('total_number_of_vacancies') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="closing_date" class="col-sm-4 col-form-label text-right">{{ __('Closing Date ') }}</label>
                            <div class="col-sm-8">
                                <input id="closing_date" type="date" class="form-control{{ $errors->has('closing_date') ? ' is-invalid' : '' }}" name="closing_date" value="{{ old('closing_date') }}">

                            @if ($errors->has('closing_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('closing_date') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="working_hours" class="col-sm-4 col-form-label text-right">{{ __('Working Hours ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <select name="working_hours" id="working_hours" class="form-control{{ $errors->has('working_hours') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Working hour--</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Shift">Shift</option>
                                    <option value="Flexi-Time">Flexi-Time</option>
                                </select>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group dis-cls">
                            <div class="col-sm-1 ml-auto">
                                <input id="agreement" class="form-control checkbox" type="checkbox" name="agreement" checked required>
                            </div>
                            <label for="agreement" class="col-sm-8">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                        </div> --}}
                    </div>
                    <div class="tab">
                        <div class="form-group dis-cls">
                            <label for="posted_by" class="col-sm-4 col-form-label text-right">Posted By</label>
                            <div class="col-sm-8">
                                <input id="posted_by" type="text" class="form-control{{ $errors->has('posted_by') ? ' is-invalid' : '' }}" name="posted_by" value="{{ old('posted_by') }}">

                            @if ($errors->has('posted_by'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('posted_by') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="person_in_charge" class="col-sm-4 col-form-label text-right">{{ __('Person in Charge ') }}</label>
                            <div class="col-sm-8">
                                <input id="person_in_charge" type="text" class="form-control{{ $errors->has('person_in_charge') ? ' is-invalid' : '' }}" name="person_in_charge" value="{{ old('person_in_charge') }}">

                            @if ($errors->has('person_in_charge'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('person_in_charge') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="telephone_number" class="col-sm-4 col-form-label text-right">{{ __('Telephone Number ') }}</label>
                            <div class="col-sm-8">
                                <input id="telephone_number" type="text" class="form-control{{ $errors->has('telephone_number') ? ' is-invalid' : '' }}" name="telephone_number" value="{{ old('telephone_number') }}">

                            @if ($errors->has('telephone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('telephone_number') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="handphone_number" class="col-sm-4 col-form-label text-right">{{ __('Handphone Number ') }}</label>
                            <div class="col-sm-8">
                                <input id="handphone_number" type="text" class="form-control{{ $errors->has('handphone_number') ? ' is-invalid' : '' }}" name="handphone_number" value="{{ old('handphone_number') }}">

                            @if ($errors->has('handphone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('handphone_number') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="email" class="col-sm-4 col-form-label text-right">{{ __('Email ') }}</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                    </div>
                    {{-- //Candidate details --}}
                    <div class="tab">
                        <div class="form-group dis-cls">
                            <label for="gender" class="col-sm-4 col-form-label text-right">{{ __('Gender ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Gender--</option>
                                    <option value="Any">Any</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="marital_status" class="col-sm-4 col-form-label text-right">{{ __('Marital Status ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <select name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Marital Status--</option>
                                    <option value="Any">Any</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="race" class="col-sm-4 col-form-label text-right">{{ __('Race ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <select name="race" id="race" class="form-control{{ $errors->has('race') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Race--</option>
                                    @foreach ($races as $race)
                                        <option value="{{$race->name}}">{{$race->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="age_eligibillity" class="col-sm-4 col-form-label text-right">{{ __('Age Eligibillity ') }}</label><span class="text-danger mt-2">*</span>
                            <div class="col-sm-8">
                                <select name="age_eligibillity" id="age_eligibillity" class="form-control{{ $errors->has('age_eligibillity') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Age Range--</option>
                                    <option value="20-24">20-24</option>
                                    <option value="25-30">25-30</option>
                                    <option value="30-35">30-35</option>
                                    <option value="35-40">35-40</option>
                                    <option value="40+">40+</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="other_requirements" class="col-sm-4 col-form-label text-right">{{ __('Other Requirements') }}</label>
                            <div class="col-sm-8">
                                <textarea name="other_requirements" id="other_requirements" class="form-control{{ $errors->has('other_requirements') ? ' is-invalid' : '' }}" cols="30" rows="6">{{ old('other_requirements') }}</textarea>
                            @if ($errors->has('other_requirements'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('other_requirements') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="facilities" class="col-sm-4 col-form-label text-right">{{ __('Facilities') }}</label>
                            <div class="col-md-8 mt-2">
                                <div class="row">
                                    @foreach($facilities as $facility)
                                        <div class="col-md-4">
                                            <div class="custom-control custom-checkbox d-inline">
                                                <input type="checkbox" class="custom-control-input" id="{{$facility->name}}" name="facilities[]" value="{{$facility->name}}">
                                                <label class="custom-control-label" for="{{$facility->name}}">{{$facility->name}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-8">
                                        <div class="custom-control custom-checkbox d-inline">
                                            <input type="checkbox" class="custom-control-input" onclick="toogleOtherFacilities(this);" name="other_faliclities_checkbox" id="other" value="yes">
                                            <label class="custom-control-label" for="other">Other</label>
                                            <input type="text" name="other_facilities" id="other_facilities" class="form-control d-none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-8">
                                <input id="facilities" type="text" class="form-control{{ $errors->has('facilities') ? ' is-invalid' : '' }}" name="facilities" value="{{ old('facilities') }}">
                                
                            @if ($errors->has('facilities'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('facilities') }}</strong>
                                </span>
                            @endif
                            </div> --}}

                            
                        </div>
                    </div>
                    {{-- Academic --}}
                    <div class="tab">
                        <div class="col-md-12 mb-2">
                            <h4>Language Proficiency</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="language" class="form-group dis-cls">
                                    <label for="language">{{ __('Language ') }}</label><span class="text-danger mt-2">*</span>
                                    <select class="form-control" name="language[]" id="language">
                                        <option value="">--Select--</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="speaking" class="form-group dis-cls">
                                    <label for="speaking">{{ __('Speaking') }}</label>
                                    <select class="form-control" name="speaking[]" id="speaking">
                                        <option value="">--Select--</option>
                                        <option value="Fluent">Fluent</option>
                                        <option value="Good">Good</option>
                                        <option value="Poor">Poor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="writing" class="form-group dis-cls">
                                    <label for="writing">{{ __('Writing') }}</label>
                                    <select class="form-control" name="writing[]" id="writing">
                                        <option value="">--Select--</option>
                                        <option value="Fluent">Fluent</option>
                                        <option value="Good">Good</option>
                                        <option value="Poor">Poor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div id="czContainerLanguage">
                                    <div id="first">
                                        <div class="recordset">
                                            <div class="fieldRow clearfix">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <hr class="mt-4 mb-4"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="language" class="form-group dis-cls">
                                                            <label for="language">{{ __('Language ') }}</label><span class="text-danger mt-2">*</span>
                                                            <select class="form-control" name="language[]" id="language">
                                                                <option value="">--Select--</option>
                                                                @foreach($languages as $language)
                                                                    <option value="{{$language->id}}">{{$language->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="speaking" class="form-group dis-cls">
                                                            <label for="speaking">{{ __('Speaking') }}</label>
                                                            <select class="form-control" name="speaking[]" id="speaking">
                                                                <option value="">--Select--</option>
                                                                <option value="Fluent">Fluent</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="writing" class="form-group dis-cls">
                                                            <label for="writing">{{ __('Writing') }}</label>
                                                            <select class="form-control" name="writing[]" id="writing">
                                                                <option value="">--Select--</option>
                                                                <option value="Fluent">Fluent</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Poor">Poor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 mb-2">
                            <h4>Academic Qualification</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row dis-cls">
                                <label for="minimum_academic_qualification" class="col-sm-4 col-form-label text-right">{{ __('Minimum Academic Qualification ') }}</label><span class="text-danger mt-2">*</span>
                                <div class="col-sm-8">
                                    <select class="form-control{{ $errors->has('minimum_academic_qualification') ? ' is-invalid' : '' }}" name="minimum_academic_qualification" id="minimum_academic_qualification">
                                        <option value="">--Select Academic Qualification--</option>
                                        @foreach ($academics as $academic)
                                            <option value="{{$academic->name}}">{{$academic->name}}</option>
                                        @endforeach
                                    </select>
                                @if ($errors->has('minimum_academic_qualification'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('minimum_academic_qualification') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group row dis-cls">
                                <label for="academic_field" class="col-sm-4 col-form-label text-right">{{ __('Academic Field') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control{{ $errors->has('academic_field') ? ' is-invalid' : '' }}" name="academic_field" id="academic_field">
                                        <option value="">--Select Academic Field--</option>
                                        @foreach ($academic_fields as $academic_field)
                                            <option value="{{$academic_field->name}}">{{$academic_field->name}}</option>
                                        @endforeach
                                    </select>
                                @if ($errors->has('academic_field'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('academic_field') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div id="czContainerAcademic">
                                    <div id="first">
                                        <div class="recordset">
                                            <div class="fieldRow clearfix">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <hr class="mt-4 mb-4"/>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row dis-cls">
                                                            <label for="academic_qualification" class="col-sm-4 col-form-label text-right">{{ __('Academic Qualification ') }}</label><span class="text-danger mt-2">*</span>
                                                            <div class="col-sm-8">
                                                                <select class="form-control{{ $errors->has('academic_qualification') ? ' is-invalid' : '' }}" name="academic_qualifications[]" id="academic_qualification">
                                                                    <option value="">--Select Academic Qualification--</option>
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
                                                        <div class="form-group row dis-cls">
                                                            <label for="academic_fields" class="col-sm-4 col-form-label text-right">{{ __('Academic Field') }}</label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control{{ $errors->has('academic_fields') ? ' is-invalid' : '' }}" name="academic_fields[]" id="academic_fields">
                                                                    <option value="">--Select Academic Qualification--</option>
                                                                    @foreach ($academic_fields as $academic_field)
                                                                        <option value="{{$academic_field->name}}">{{$academic_field->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @if ($errors->has('academic_fields'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('academic_fields') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-group dis-cls">
                                                            <label for="academic_qualifications" class="col-sm-4 col-form-label text-right">{{ __('Academic Qualification *') }}</label>
                                                            <div class="col-sm-8">
                                                                <input id="academic_qualifications" type="text" class="form-control{{ $errors->has('academic_qualifications') ? ' is-invalid' : '' }}" name="academic_qualifications[]" value="{{ old('academic_qualifications') }}">
                                
                                                            @if ($errors->has('academic_qualifications'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('academic_qualifications') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group dis-cls">
                                                            <label for="academic_fields" class="col-sm-4 col-form-label text-right">{{ __('Academic Fields *') }}</label>
                                                            <div class="col-sm-8">
                                                                <input id="academic_fields" type="text" class="form-control{{ $errors->has('academic_fields') ? ' is-invalid' : '' }}" name="academic_fields[]" value="{{ old('academic_fields') }}">
                                
                                                            @if ($errors->has('academic_fields'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('academic_fields') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="driving_license" class="col-sm-4 col-form-label text-right">{{ __('Driving License') }}</label>
                            <div class="col-sm-8">
                                <input id="driving_license" type="text" class="form-control{{ $errors->has('driving_license') ? ' is-invalid' : '' }}" name="driving_license" value="{{ old('driving_license') }}">

                            @if ($errors->has('driving_license'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('driving_license') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group dis-cls">
                            <label for="other_skills" class="col-sm-4 col-form-label text-right">{{ __('Other Skills') }}</label>
                            <div class="col-sm-8">
                                <textarea name="other_skills" id="other_skills" class="form-control{{ $errors->has('other_skills') ? ' is-invalid' : '' }}" cols="30" rows="6">{{ old('other_skills') }}</textarea>
                            @if ($errors->has('other_skills'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('other_skills') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                    </div>
                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button class="prev-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button class="primary-btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
    <!---------Start for Multi Step form---------->
    <script type="text/javascript">
        $(document).ready(function() {  
    
            // Random Alert shown for the fun of it
            function randomAlert() {
                var min = 5,
                    max = 20;
                var rand = Math.floor(Math.random() * (max - min + 1) + min); //Generate Random number between 5 - 20
                // post time in a <span> tag in the Alert
                $("#time").html('Next alert in ' + rand + ' seconds');
                $('#timed-alert').fadeIn(500).delay(3000).fadeOut(500);
                setTimeout(randomAlert, rand * 1000);
            };
            randomAlert();
        });

        $('.btn').click(function(event) {
            event.preventDefault();
            var target = $(this).data('target');
            // console.log('#'+target);
            $('#click-alert').html('data-target= ' + target).fadeIn(50).delay(3000).fadeOut(1000);
            
        });


        // Multi-Step Form
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the crurrent tab

        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Post Job";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }

        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("tab");
          // Exit the function if any field in the current tab is invalid:
          //if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("job_post").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }

        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("tab");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }

        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("step");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }
    </script>
    <!---------End for Multi Step form---------->
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
                $("#czContainerAcademic").czMore();
            </script>
            <script>
                function toogleOtherFacilities(input){
                    console.log(input.checked);
                    if(input.checked){
                        document.querySelector('#other_facilities').classList.remove('d-none');
                    }else{
                        document.querySelector('#other_facilities').classList.add('d-none');
                    }
                }
            </script>
@endsection