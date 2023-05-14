@extends('employer.app')

@section('content')

<!----------Start Multi Step Form Design---------->
<div class="tab-banner">
<span class="step">Personal Information</span>
<span class="step">Skill, Education & Experience</span>
@if ( (request()->t == 'dm') )
    <span class="step">Do & Don't (Maid Only)</span>
@endif
</div>
<div class="tab-section">
    <div class="container">
        @if(Session::has('message'))
        <div class="col-md-12">
            <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('agent.saveuser') }}" id="gm_dm_form" enctype="multipart/form-data">
                @csrf
                @if(isset(Auth::user()->agent_profile->agent_code))
                    <input type="hidden" name="agent_code" value="{{Auth::user()->agent_profile->agent_code}}">
                @else
                    <input type="hidden" name="agent_code" value="{{Auth::user()->id}}">
                @endif
                <!-- One "tab" for each step in the form: -->
                <div class="tab">
                <div class="card-body">
                    <!-- <div class="row"> -->
                        @if ( (request()->t == 'gw') || (request()->t == 'dm') )

                        <!-- Hidden field for GW/DM user type -->
                        <input type="hidden" name="role" value="{{ (request()->t == 'gw') ? "worker" : "maid" }}">

                        @else
                        <div class="col-md-6">
                            <div class="form-group dis-cls">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input id="role" class="radio" type="radio" name="role" value="worker" required>
                                    </div>
                                    <label for="role" class="col-md-10">General Worker</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input id="role" class="radio" type="radio" name="role" value="maid" required>
                                    </div>
                                    <label for="role" class="col-md-10">Domestic Maid</label>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if  (request()->t == 'gw')
                            <div class="col-md-12" id="General-Info">
                                <h3 class="title-new-cls">Foreign Workers Information</h3>
                            </div>
                        @endif
                        @if  (request()->t == 'dm')
                        <div class="col-md-12" id="General-Info">
                                <h3 class="title-new-cls">Domestic Maid Information</h3>
                            </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-sm-6 ">
                                <label for="name">{{ __('Name ') }}<span class="text-danger">*</span></label>
                                <input required id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" >
                                <small id="nameError" style="visibility:hidden;color:red">Name is mandatory</small>
                                <!-- @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="date_of_birth">{{ __('Date of Birth ') }}<span class="text-danger">*</span></label>
                                <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" min="1900-01-01" max="2200-01-01" value="{{ old('date_of_birth') ? \Carbon\Carbon::parse(old('date_of_birth'))->format('Y-m-d') : ''}}" placeholder="Date of Birth" required>
                                <small id="dobError" style="visibility:hidden;color:red">Date of Birth is mandatory</small>
                                <!-- @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="phone">{{ __('Contact No. ') }}<span class="text-danger">*</span></label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone" required>
                                <small id="phoneError" style="visibility:hidden;color:red">Contact Number is mandatory</small>
                                <!-- @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="gender">{{ __('Gender ') }}<span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Gender--</option>
                                    @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}" {{$gender->id == old('gender') ? 'selected':''}}>{{$gender->name}}</option>
                                    @endforeach
                                </select>
                                <small id="genderError" style="visibility:hidden;color:red">Gender is mandatory</small>
                                <!-- @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3">
                                <label for="email_id">{{ __('Email') }}</label>
                                <input id="email_id" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail">
    
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="marital_status">{{ __('Marital Status') }}</label>
                                <select onChange="displayChildren(this.value)" name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                    <option value="">-- Select Marital Status --</option>
                                    @foreach ($marital_statuses as $marital_status)
                                        <option value="{{$marital_status->id}}" {{$marital_status->id == old('marital_status')? 'selected':''}}>{{$marital_status->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('marital_status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('marital_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-1">
                                <label for="children">{{ __('Children') }}</label>
                                <input id="children" type="children" class="form-control{{ $errors->has('children') ? ' is-invalid' : '' }}" name="children" value="{{ old('children') }}" placeholder="Children">
    
                                @if ($errors->has('children'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('children') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                <label for="siblings">{{ __('Siblings') }}</label>
                                <input id="siblings" type="siblings" class="form-control{{ $errors->has('siblings') ? ' is-invalid' : '' }}" name="siblings" value="{{ old('siblings') }}" placeholder="Siblings">
    
                                @if ($errors->has('siblings'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('siblings') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6" id="com_country">
                                <label for="company_country">Country</label><span class="text-danger"> *</span>
                                <select name="company_country" id="company_country" required class="form-control" >
                                    @if(Auth::user()->hasRole('sub-agent') && Auth::user()->status == 1)
                                        @foreach ($countrys as $country)
                                            <option value="{{$country->id}}" {{$country->id == old('company_country') ? 'selected':''}}>{{$country->name}}</option>
                                        @endforeach
                                    @endif
                                    @if(Auth::user()->hasRole('superadministrator|agent|part-timer') && Auth::user()->status == 1)
                                        <option value="" disable="true" selected="true">- - - - - - - - - - - - - - - - -    Select Country - - - - - - - - - - - - - - - - -</option>
                                        @foreach ($nationalitys as $key=> $value)
                                            <option value="{{$value->id}}" {{$value->id == old('company_country') ? 'selected':''}}>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="company_countryError" style="visibility:hidden;color:red">Country is mandatory</small>
                            </div>
                            <div class="col-sm-3" id="com_state">
                                <label for="state">State/Province/Division</label><span class="text-danger"> *</span>
                                <select name="company_state" id="company_state" required class="form-control">
                                    @if(Auth::user()->hasRole('superadministrator|agent|part-timer') && Auth::user()->status == 1)
                                        <option value=""  disable="true" selected="true">-------  Select State -------</option>
                                    @endif
                                    @if(Auth::user()->hasRole('sub-agent') && Auth::user()->status == 1)
                                        <option value="" disable="true" selected="true">-------  Select State -------</option>
                                        @foreach ($states as $state)
                                            <option value="{{$state->id}}" {{$state->id == old('company_state') ? 'selected':''}}>{{$state->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="company_stateError" style="visibility:hidden;color:red">State is mandatory</small>
                                <!-- @if ($errors->has('company_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_state') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                            <div class="col-sm-3" id="com_city">
                                <label for="city">City</label><span class="text-danger"> *</span>
                                <select name="company_city" id="company_city" required class="form-control">
                                    <option value="" disable="true" selected="true">-------  Select City -------</option> 
                                </select>
                                <small id="company_cityError" style="visibility:hidden;color:red">City is mandatory</small>
                                <!-- @if ($errors->has('company_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_city') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="district">{{ __('District') }}</label>
                                <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district') }}" placeholder="District">
                                @if ($errors->has('district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="address">{{ __('Address ') }}<span class="text-danger">*</span></label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                <small id="addressError" style="visibility:hidden;color:red">Address is mandatory</small>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <!-- <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="city">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" placeholder="City" required>
    
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="state">{{ __('State/Proviace ') }}<span class="text-danger">*</span></label>
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}" placeholder="State/Proviace" required>
    
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="nationality">{{ __('Nationality ') }}<span class="text-danger">*</span></label>
                                <select name="nationality" id="nationality" class="form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" required>
                                     @if(Auth::user()->hasRole('sub-agent') && Auth::user()->status == 1)
                                        @foreach ($countrys as $country)
                                            <option value="{{$country->id}}" {{$country->id == old('company_country') ? 'selected':''}}>{{$country->name}}</option>
                                        @endforeach
                                    @endif
                                    @if(Auth::user()->hasRole('superadministrator|agent|part-timer') && Auth::user()->status == 1)
                                        <option value="">- - - - - Select Nationality - - - - -</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" {{$nationality->id == old('nationality') ? 'selected':''}}>{{$nationality->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="nationalityError" style="visibility:hidden;color:red">Nationality is mandatory</small>
                                @if ($errors->has('nationality'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="religion">{{ __('Religion') }}</label>
                                <select name="religion" id="religion" class="form-control{{ $errors->has('religion') ? ' is-invalid' : '' }}" >
                                    <option value=""> - - - - Select Religion - - - -</option>
                                    @foreach ($religions as $religion)
                                        <option value="{{$religion->id}}" {{$religion->id == old('religion')? 'selected':''}}>{{$religion->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('religion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('religion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="height">{{ __('Height (CM)') }}</label>
                                <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="{{ old('height') }}" placeholder="Height">
    
                                @if ($errors->has('height'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="weight">{{ __('Weight (KG)') }}</label>
                                <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{ old('weight') }}" placeholder="Weight">
    
                                @if ($errors->has('weight'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="father_name">{{ __('Father Name') }}</label>
                                <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{ old('father_name') }}" placeholder="Father Name">
    
                                @if ($errors->has('father_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="mother_name">{{ __('Mother Name') }}</label>
                                <input id="mother_name" type="text" class="form-control{{ $errors->has('mother_name') ? ' is-invalid' : '' }}" name="mother_name" value="{{ old('mother_name') }}" placeholder="Mother Name">
    
                                @if ($errors->has('mother_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="father_contact_number">{{ __('Father Contact No') }}</label>
                                <input id="father_contact_number" type="text" class="form-control{{ $errors->has('father_contact_number') ? ' is-invalid' : '' }}" name="father_contact_number" value="{{ old('father_contact_number') }}" placeholder="Father Contact No">
    
                                @if ($errors->has('father_contact_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('father_contact_number') }}</strong>
                                    </span>
                                @endif
                            </div>    
                            @if ( request()->t == 'gw' )
                                <div class="col-sm-3">
                                    <label for="sector">{{ __('Sector') }}</label>
                                    <select name="sector" id="sector" class="form-control{{ $errors->has('sector') ? ' is-invalid' : '' }}" >
                                        <option value="">- - - - Select Sector - - - -</option>
                                        @foreach ($sectors as $sector)
                                            <option value="{{$sector->id}}" {{$sector->id == old('sector')? 'selected':''}}>{{$sector->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sector'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sector') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <label for="sub_sector">{{ __('Sub Sector') }}</label>
                                    <select name="sub_sector" id="sub_sector" class="form-control{{ $errors->has('sub_sector') ? ' is-invalid' : '' }}" >
                                        <option value=""> - - - -Select Sub Sector - - - -</option>
                                    </select>
                                    @if ($errors->has('sub_sector'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sub_sector') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endif                    
                        </div><hr>
                        <div class="col-md-12 pt-5 page-section" id="Images">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="title-new-cls">Images</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group dis-cls1">
                                        <div class="upload-label">
                                            <label for="image">{{ __('Half Image') }}</label><span class="text-danger">*</span>
                                            <div class="upload-area">
                                                <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Upload Photo</span></button>
                                                <span class="uploadfiles">
                                                    <input id="image"  onchange="previewFile('#image_preview', '#image')"  type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" value="{{ old('image') }}">
                                                </span>
                                                <p class="text-short-mes">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                                <img id="image_preview" style="width: 100px;" src="" class="img-thumbnail" height="">
                                                <small id="imageError" style="visibility:hidden;color:red">Half Image is mandatory</small>
                                                <small id="imageError2" style="visibility:hidden;color:red">Select file is not Image file</small>
                                                <!-- @if ($errors->has('image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group dis-cls1">
                                        <div class="upload-label">
                                            <label for="full_image">{{ __('Full Image') }}</label>
                                            <div class="upload-area">
                                                <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Upload Photo</span></button>
                                                <span class="uploadfiles">
                                                    <input onchange="previewFile('#full_image_preview','#full_image')" id="full_image" type="file" class="form-control-file{{ $errors->has('full_image') ? ' is-invalid' : '' }}" name="full_image">
                                                </span>
                                                <p class="text-short-mes">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                                <img id="full_image_preview" style="width: 100px;" src="" class="img-thumbnail" height="">
                                                <small id="full_imageError" style="visibility:hidden;color:red">Select file is not Image file</small>
                                                @if ($errors->has('full_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('full_image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pt-5 page-section" id="Emergency-Contact">
                            <!-- <div class="row"> -->
                                <div class="col-md-12">
                                    <h3 class="title-new-cls">Emergency Contact</h3>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="emergency_contact_name">{{ __('Name ') }}<span class="text-danger">*</span></label>
                                        <input id="emergency_contact_name" type="text" class="form-control{{ $errors->has('emergency_contact_name') ? ' is-invalid' : '' }}" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" placeholder="Name" required>
                                        <small id="emergency_contact_nameError" style="visibility:hidden;color:red">Emergency Contact Name is mandatory</small>
                                        @if ($errors->has('emergency_contact_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('emergency_contact_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="emergency_contact_relationship">{{ __('Relationship ') }}<span class="text-danger">*</span></label>
                                        <input id="emergency_contact_relationship" type="text" class="form-control{{ $errors->has('emergency_contact_relationship') ? ' is-invalid' : '' }}" name="emergency_contact_relationship" value="{{ old('emergency_contact_relationship') }}" placeholder="Relationship" required>
                                        <small id="emergency_contact_relationshipError" style="visibility:hidden;color:red">Relationship is mandatory</small>
                                        @if ($errors->has('emergency_contact_relationship'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('emergency_contact_relationship') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="emergency_contact_phone">{{ __('Contact No. ') }}<span class="text-danger">*</span></label>
                                        <input id="emergency_contact_phone" type="text" class="form-control{{ $errors->has('emergency_contact_phone') ? ' is-invalid' : '' }}" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" placeholder="Telephone No." required>
                                        <small id="emergency_contact_phoneError" style="visibility:hidden;color:red">Contact No is mandatory</small>
                                        @if ($errors->has('emergency_contact_phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('emergency_contact_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="emergency_contact_address">{{ __('Address ') }}<span class="text-danger">*</span></label>
                                        <input id="emergency_contact_address" type="text" class="form-control{{ $errors->has('emergency_contact_address') ? ' is-invalid' : '' }}" name="emergency_contact_address" value="{{ old('emergency_contact_address') }}" placeholder="Address" required>
                                        <small id="emergency_contact_addressError" style="visibility:hidden;color:red">Address is mandatory</small>
                                        @if ($errors->has('emergency_contact_address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('emergency_contact_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-md-12 pt-5 page-section" id="Passport-Details">
                            <!-- <div class="row"> -->
                                <div class="col-md-12">
                                    <h3 class="title-new-cls">Passport Details</h3>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="passport_number">{{ __('Passport Number ') }}<span class="text-danger">*</span></label>
                                        <input id="passport_number" type="text" class="form-control{{ $errors->has('passport_number') ? ' is-invalid' : '' }}" name="passport_number" value="{{ old('passport_number') }}" placeholder="Passport Number" required>
                                        <small id="passport_numberError" style="visibility:hidden;color:red">Passport Number is mandatory</small>
                                        @if ($errors->has('passport_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('passport_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="passport_issue_place">{{ __('Passport Issue Place ') }}<span class="text-danger">*</span></label>
                                        <input id="passport_issue_place" type="text" class="form-control{{ $errors->has('passport_issue_place') ? ' is-invalid' : '' }}" name="passport_issue_place" value="{{ old('passport_issue_place') }}" placeholder="Passport Issue Place" required>
                                        <small id="passport_issue_placeError" style="visibility:hidden;color:red">Passport Issue Place is mandatory</small>
                                        @if ($errors->has('passport_issue_place'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('passport_issue_place') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div><hr>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="passport_issue_date">{{ __('Passport Issue Date ') }}<span class="text-danger">*</span></label>
                                        <input id="passport_issue_date" type="date" class="form-control{{ $errors->has('passport_issue_date') ? ' is-invalid' : '' }}" name="passport_issue_date" min="1900-01-01" max="2200-01-01" value="{{ old('passport_issue_date') ? \Carbon\Carbon::parse(old('passport_issue_date'))->format('Y-m-d') : ''}}" placeholder="Passport Issue Date" required>
                                        <small id="passport_issue_dateError" style="visibility:hidden;color:red">Passport Issue Date is mandatory</small>
                                        @if ($errors->has('passport_issue_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('passport_issue_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="passport_expire_date">{{ __('Passport Expire Date ') }}<span class="text-danger">*</span></label>
                                        <input id="passport_expire_date" type="date" class="form-control{{ $errors->has('passport_expire_date') ? ' is-invalid' : '' }}" name="passport_expire_date" min="1900-01-01" max="2200-01-01" value="{{ old('passport_expire_date') ? \Carbon\Carbon::parse(old('passport_expire_date'))->format('Y-m-d') : ''}}" placeholder="Passport Expire Date" required>
                                        <small id="passport_expire_dateError" style="visibility:hidden;color:red">Passport Expire is mandatory</small>
                                        @if ($errors->has('passport_expire_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('passport_expire_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="passport_file">{{ __('Passport Copy ') }}</label><span class="text-danger"> *</span>
                                        <div class="upload-area">
                                            <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Choose File </span></button>
                                            <span class="uploadfiles">
                                                <input onchange="previewFile('#passport_file_preview','#passport_file')" id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ old('passport_file') }}" placeholder="Passport File">
                                            </span>
                                            <p class="text-short-mes">Supported file format PDF. Maximum file size: 1MB</p>
                                            <img id="passport_file_preview" style="width: 100px;" src="" class="img-thumbnail" height="">
                                            <small id="passport_fileError" style="visibility:hidden;color:red">Passport Copy is mandatory</small>
                                            <small id="passport_fileError2" style="visibility:hidden;color:red">Select pdf file only</small>
                                            @if ($errors->has('passport_file'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('passport_file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                        <div class="col-md-12 pt-5 page-section" id="Other-Files">
                            <!-- <div class="row"> -->
                                <div class="col-md-12">
                                    <h3 class="title-new-cls">Other Files</h3>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="medical_certificate">{{ __('Medical Certificate') }}</label>
                                        <div class="upload-area">
                                            <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Upload Photo</span></button>
                                            <span class="uploadfiles">
                                                <input onchange="previewFile('#medical_certificate_preview','#medical_certificate')" id="medical_certificate" type="file" class="form-control-file{{ $errors->has('medical_certificate') ? ' is-invalid' : '' }}" name="medical_certificate" value="{{ old('medical_certificate') }}" placeholder="Medical Certificate">
                                            </span>
                                            <p class="text-short-mes">Supported file format PDF. Maximum file size: 1MB</p>
                                            <img id="medical_certificate_preview" style="width: 100px;" src="" class="img-thumbnail" height="">
                                            <small id="medical_certificateError" style="visibility:hidden;color:red">Select pdf file only</small>
                                            @if ($errors->has('medical_certificate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('medical_certificate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="immigration_security_clearence">{{ __('Immigration Security Clearence') }}</label>
                                        <div class="upload-area">
                                            <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Upload Photo</span></button>
                                            <span class="uploadfiles">
                                                <input onchange="previewFile('#immigration_security_clearence_preview','#immigration_security_clearence')" id="immigration_security_clearence" type="file" class="form-control-file{{ $errors->has('immigration_security_clearence') ? ' is-invalid' : '' }}" name="immigration_security_clearence" value="{{ old('immigration_security_clearence') }}" placeholder="Immigration Security Clearence">
                                            </span>
                                            <p class="text-short-mes">Supported file format PDF. Maximum file size: 1MB</p>
                                            <img id="immigration_security_clearence_preview" style="width: 100px;" src="" class="img-thumbnail" height="">
                                            <small id="immigration_security_clearenceError" style="visibility:hidden;color:red">Select pdf file only</small>
                                            @if ($errors->has('immigration_security_clearence'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('immigration_security_clearence') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    <!-- </div> -->
                </div>
                 </div>
                <div class="tab">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 pt-5 page-section" id="Education">
                        <h3 class="title-new-cls">Education</h3>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                <select name="education_level[]" id="id_1_education_level" class="form-control">
                                    <option value="">--Select Education Level--</option>
                                    @foreach ($education_levels as $education_level)
                                        <option value="{{$education_level->id}}" {{$education_level->id == old('education_level')[0] ? 'selected':''}}>{{$education_level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" value="{{old('education_remark')[0]}}" placeholder="Education Remark">
                            </div>
                            <!-- <div class="col-md-12">
                                <hr class="mt-4 mb-4"/>
                            </div> -->
                        </div><hr>
                        @if(old('education_level'))
                            @for ($i = 1; $i < count(old('education_level')); $i++)
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div id="div_id_1_education_level" class="form-group dis-cls">
                                            <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                            <select name="education_level[]" id="id_1_education_level" class="form-control">
                                                <option value="">--Select Education Level--</option>
                                                @foreach ($education_levels as $education_level)
                                                    <option value="{{$education_level->id}}" {{$education_level->id == old('education_level')[$i] ? 'selected':''}}>{{$education_level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="div_id_1_education_remark" class="form-group dis-cls">
                                            <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                            <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" value="{{old('education_remark')[$i]}}" placeholder="Education Remark">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr class="mt-4 mb-4"/>
                                    </div>
                                </div>
                            @endfor
                        @endif
                        <div id="czContainerEducation">
                            <div id="first">
                                <div class="recordset">
                                    <div class="fieldRow clearfix">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                                <select name="education_level[]" id="id_1_education_level" class="form-control">
                                                    <option value="">--Select Education Level--</option>
                                                    @foreach ($education_levels as $education_level)
                                                        <option value="{{$education_level->id}}" {{$education_level->id == old('education_level')[0] ? 'selected':''}}>{{$education_level->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                                <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" value="{{old('education_remark')[0]}}" placeholder="Education Remark">
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div id="div_id_1_education_level" class="form-group dis-cls">
                                                    <label for="id_1_education_level">{{ __('Education Level') }}</label>
                                                    {{-- <input id="id_1_education_level" type="text" class="form-control" name="education_level[]" placeholder="Education Level"> --}}
                                                    <select name="education_level[]" id="id_1_education_level" class="form-control">
                                                        <option value="">--Select Education Level--</option>
                                                        @foreach ($education_levels as $education_level)
                                                            <option value="{{$education_level->id}}" {{$education_level->id == old('nationality') ? 'selected':''}}>{{$education_level->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6">
                                                <div id="div_id_1_education_remark" class="form-group dis-cls">
                                                    <label for="id_1_education_remark">{{ __('Education Remark') }}</label>
                                                    <input id="id_1_education_remark" type="text" class="form-control" name="education_remark[]" placeholder="Education Remark">
                                                </div>
                                            </div> -->
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
                            <h3 class="title-new-cls">Experience</h3>
                            <!-- <div class="row"> -->
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="id_1_employer_name">{{ __('Employer Name') }}</label>
                                    <input id="id_1_employer_name" type="text" class="form-control" name="employer_name[]" placeholder="Employers Name" value="{{old('employer_name')[0]}}" required>
                                </div>
                                <div class="col-sm-3">
                                    <label for="id_1_employer_country">{{ __('Employer Country') }}</label>
                                    <select name="country[]" id="id_1_employer_country" class="form-control">
                                        <option value="">--Select Country--</option>
                                        @foreach ($nationalitys as $nationality)
                                            <option value="{{$nationality->id}}" {{$nationality->id == old('country')[0] ? 'selected':''}}>{{$nationality->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="id_1_from_date">{{ __('From Date') }}</label>
                                    <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{old('from_date')[0] ? \Carbon\Carbon::parse(old('from_date')[0])->format('Y-m-d') : ''}}" name="from_date[]">
                                </div>
                                <div class="col-md-3">
                                    <label for="id_1_to_date">{{ __('To Date') }}</label>
                                    <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{old('to_date')[0] ? \Carbon\Carbon::parse(old('to_date')[0])->format('Y-m-d') : ''}}" name="to_date[]">
                                </div>
                            </div><hr>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="id_1_remark">{{ __('Remark') }}</label>
                                    <input id="id_1_remark" type="text" class="form-control" name="remark[]" value="{{old('remark')[0]}}" placeholder="Remark">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="mt-4 mb-4"/>
                            </div>
                            <!-- </div> -->
                            @if(old('employer_name'))
                            @for ($i = 1; $i < count(old('employer_name')); $i++)
                            <div class="row">
                                <div class="col-md-3">
                                    
                                        <label for="id_1_employer_name">{{ __('Employer Name') }}</label>
                                        <input id="id_1_employer_name" type="text" class="form-control" name="employer_name[]" placeholder="Employers Name" value="{{old('employer_name')[$i]}}" required>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div id="div_id_1_employer_country" class="form-group dis-cls">
                                        <label for="id_1_employer_country">{{ __('Employer Country') }}</label>
                                        <select name="country[]" id="id_1_employer_country" class="form-control">
                                            <option value="">--Select Country--</option>
                                            @foreach ($nationalitys as $nationality)
                                                <option value="{{$nationality->id}}" {{$nationality->id == old('country')[$i] ? 'selected':''}}>{{$nationality->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="div_id_1_from_date" class="form-group dis-cls">
                                        <label for="id_1_from_date">{{ __('From Date') }}</label>
                                        <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{old('from_date')[$i] ? \Carbon\Carbon::parse(old('from_date')[$i])->format('Y-m-d') : ''}}" name="from_date[]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="div_id_1_to_date" class="form-group dis-cls">
                                        <label for="id_1_to_date">{{ __('To Date') }}</label>
                                        <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{old('to_date')[$i] ? \Carbon\Carbon::parse(old('to_date')[$i])->format('Y-m-d') : ''}}" name="to_date[]">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="div_id_1_remark" class="form-group dis-cls">
                                        <label for="id_1_remark">{{ __('Remark') }}</label>
                                        <input id="id_1_remark" type="text" class="form-control" name="remark[]" value="{{old('remark')[$i]}}" placeholder="Remark">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr class="mt-4 mb-4"/>
                                </div>
                            </div>
                            @endfor
                            @endif
                            <div id="czContainer">
                                <div id="first">
                                    <div class="recordset">
                                        <div class="fieldRow clearfix">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label for="id_1_employer_name">{{ __('Employer Name') }}</label>
                                                <input id="id_1_employer_name" type="text" class="form-control" name="employer_name[]" placeholder="Employers Name" value="{{old('employer_name')[0]}}" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="id_1_employer_country">{{ __('Employer Country') }}</label>
                                                <select name="country[]" id="id_1_employer_country" class="form-control">
                                                    <option value="">--Select Country--</option>
                                                    @foreach ($nationalitys as $nationality)
                                                        <option value="{{$nationality->id}}" {{$nationality->id == old('country')[0] ? 'selected':''}}>{{$nationality->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="id_1_from_date">{{ __('From Date') }}</label>
                                                <input id="id_1_from_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{old('from_date')[0] ? \Carbon\Carbon::parse(old('from_date')[0])->format('Y-m-d') : ''}}" name="from_date[]">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="id_1_to_date">{{ __('To Date') }}</label>
                                                <input id="id_1_to_date" type="date" class="form-control" min="1900-01-01" max="2200-01-01" value="{{old('to_date')[0] ? \Carbon\Carbon::parse(old('to_date')[0])->format('Y-m-d') : ''}}" name="to_date[]">
                                            </div>
                                        </div><hr>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label for="id_1_remark">{{ __('Remark') }}</label>
                                                    <input id="id_1_remark" type="text" class="form-control" name="remark[]" value="{{old('remark')[0]}}" placeholder="Remark">
                                                </div>
                                            </div>
                                                <!-- <div class="col-md-12">
                                                    <div id="div_id_1_remark" class="form-group dis-cls">
                                                        <label for="id_1_remark">{{ __('Remark') }}</label>
                                                        <input id="id_1_remark" type="text" class="form-control" name="remark[]" placeholder="Remark">
                                                    </div>
                                                </div> -->
                                                <div class="col-md-12">
                                                    <hr class="mt-4 mb-4"/>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pt-5 page-section nonflex-cls" id="Skills">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="title-new-cls">Skills</h3>
                                </div>
                                @foreach($skills as $skill)
                                    @if ( $skill->for == request()->t && $skill->type == 'Skill')
                                        <div class="col-md-6">
                                            <div class="form-group dis-cls" style="display:flex;">
                                                @php
                                                    $checked = old($skill->slug) ?  'checked': '';
                                                @endphp
                                                <input style="height:30px;width:30px;" type="checkbox" id="" name="{{ $skill->slug }}" {{$checked}} value="Yes">
                                                <label style="padding-top: 3px;padding-left: 5px;" for="able_to_cook">{{ $skill->name }}</label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="col-md-12">
                                    <div class="form-group dis-cls">
                                        <label for="other_skills">{{ __('Other Skills (Seperate with Comma)') }}</label>
                                        <input id="other_skills" type="text" class="form-control{{ $errors->has('other_skills') ? ' is-invalid' : '' }}" name="other_skills" value="{{ old('other_skills') }}" placeholder="Other Skills">
            
                                        @if ($errors->has('other_skills'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('other_skills') }}</strong>
                                            </span>
                                        @endif
                                    </div><hr>
                                    {{-- <div class="form-group dis-cls">
                                        <label for="other_skills">Other Skills (Seperate with Comma)</label>
                                        
                                        
                                            <div class="suggest">
                                                <select class="js-search-tags form-control" name="other_skills" multiple="multiple">
                                                  <option>orange</option>
                                                  <option>white</option>
                                                  <option>purple</option>
                                                </select>
                                            </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 page-section nonflex-cls" id="Languages">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="title-new-cls">Languages</h3>
                                </div>
                                @foreach($skills as $skill)
                                    @if ( $skill->for == request()->t && $skill->type == 'Language')
                                        <div class="col-md-6">
                                            <div class="form-group dis-cls" style="display:flex;">
                                                @php
                                                    $checked = old($skill->slug) ?  'checked': '';
                                                @endphp
                                                <input style="height:30px;width:30px;" type="checkbox" id="" name="{{ $skill->slug }}" {{$checked}} value="Yes">
                                                <label style="padding-top: 3px;padding-left: 5px;" for="able_to_cook">{{ $skill->name }}</label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              @if ( (request()->t == 'dm') )
                <div class="tab">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" id="do_donts">
                                <h3 class="title-new-cls">Insurans</h3>
                                <!-- <p><br><br><br><br><br><br><br><br><br><br><br><br><br><br></p> -->
                            </div>
                            @foreach($skills as $skill)
                                @if ( $skill->for == request()->t && $skill->type == 'Do & Do not')
                                    <div class="col-md-6">
                                        <div class="form-group dis-cls" style="display:flex;">
                                            @php
                                                $checked = old($skill->slug) ?  'checked': '';
                                            @endphp
                                            <input style="height:30px;width:30px;" type="checkbox" id="" name="{{ $skill->slug }}" {{$checked}} value="Yes">
                                            <label style="padding-top: 3px;padding-left: 5px;text-align: left;" for="able_to_cook">{{ $skill->name }}</label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            {{-- <div class="col-md-12 pt-5">
                                <div class="form-group dis-cls mb-0 text-center">
                                    <button type="submit" class="btn btn-success btn-block">
                                        {{ __('Save Information') }}
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
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
<!----------End Multi Step Form Design---------->



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
          console.log(x);
          console.log(n);
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Save Information";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }

        function nextPrev(n) {

            // console.log("test next");
            // const name=document.getElementById('name');
            const nameValue=document.getElementById('name').value.trim();
            const dobValue=document.getElementById('date_of_birth').value.trim();
            const phoneValue=document.getElementById('phone').value.trim();
            const genderValue=document.getElementById('gender').value.trim();
            const company_countryValue=document.getElementById('company_country').value.trim();
            const company_stateValue=document.getElementById('company_state').value.trim();
            const company_cityValue=document.getElementById('company_city').value.trim();
            const imageValue=document.getElementById('image').value.trim();
            const fullimageValue=document.getElementById('full_image').value.trim();
            const addressValue=document.getElementById('address').value.trim();
            const nationalityValue=document.getElementById('nationality').value.trim();
            const emergency_contact_nameValue=document.getElementById('emergency_contact_name').value.trim();
            const emergency_contact_relationshipValue=document.getElementById('emergency_contact_relationship').value.trim();
            const emergency_contact_phoneValue=document.getElementById('emergency_contact_phone').value.trim();
            const emergency_contact_addressValue=document.getElementById('emergency_contact_address').value.trim();
            const passport_numberValue=document.getElementById('passport_number').value.trim();
            const passport_issue_placeValue=document.getElementById('passport_issue_place').value.trim();
            const passport_issue_dateValue=document.getElementById('passport_issue_date').value.trim();
            const passport_expire_dateValue=document.getElementById('passport_expire_date').value.trim();
            const passport_fileValue=document.getElementById('passport_file').value.trim();
            const medical_certificateValue=document.getElementById('medical_certificate').value.trim();
            const immigration_security_clearenceValue=document.getElementById('immigration_security_clearence').value.trim();
            var validExt=["jpeg","png","jpg"];  
            var validfileExt=["pdf"];
            var image_ext=imageValue.substring(imageValue.lastIndexOf('.')+1);
            var fullimage_ext=fullimageValue.substring(fullimageValue.lastIndexOf('.')+1);
            var passport_file_ext=passport_fileValue.substring(passport_fileValue.lastIndexOf('.')+1);
            var medical_certificate_file_ext=medical_certificateValue.substring(medical_certificateValue.lastIndexOf('.')+1);
            var immigration_security_clearence_file_ext=immigration_security_clearenceValue.substring(immigration_security_clearenceValue.lastIndexOf('.')+1);
            var passportFileResult=validfileExt.includes(passport_file_ext);
            var medical_certificateFileResult=validfileExt.includes(medical_certificate_file_ext);
            var immigration_security_clearenceFileResult=validfileExt.includes(immigration_security_clearence_file_ext);
            var result=validExt.includes(image_ext);
            var fullImageresult=validExt.includes(fullimage_ext);

            // if(imageValue!='')
            // {
            //     var image_ext=imageValue.substring(imageValue.lastIndexOf('.')+1);
            //     console.log(image_ext);
            // }

            

            // console.log(imageValue);

            if(nameValue==='')
            {
                document.getElementById("nameError").style.visibility = "visible";
                document.getElementById("name").style.borderColor = "red";
            }
            else if(dobValue==='')
            {
                document.getElementById("dobError").style.visibility = "visible";
                document.getElementById("date_of_birth").style.borderColor = "red";
            }
            else if(phoneValue==='')
            {
                document.getElementById("phoneError").style.visibility = "visible";
                document.getElementById("phone").style.borderColor = "red";
            }
            else if(genderValue==='')
            {
                document.getElementById("genderError").style.visibility = "visible";
                document.getElementById("gender").style.borderColor = "red";
            }
            else if(company_countryValue==='')
            {
                document.getElementById("company_countryError").style.visibility = "visible";
                document.getElementById("company_country").style.borderColor = "red";
            }
            else if(company_stateValue==='')
            {
                document.getElementById("company_stateError").style.visibility = "visible";
                document.getElementById("company_state").style.borderColor = "red";
            }
            else if(company_cityValue==='')
            {
                document.getElementById("company_cityError").style.visibility = "visible";
                document.getElementById("company_city").style.borderColor = "red";
            }
            
            else if(addressValue==='')
            {
                
                document.getElementById("addressError").style.visibility = "visible";
                document.getElementById("address").style.borderColor = "red";
            }
            else if(nationalityValue==='')
            {
                document.getElementById("nationalityError").style.visibility = "visible";
                document.getElementById("nationality").style.borderColor = "red";
            }
            else if(imageValue==='')
            {
                document.getElementById("imageError").style.visibility = "visible";
                document.getElementById("image").style.borderColor = "red";
            }
            
            else if(result==false)
            {
                document.getElementById("imageError2").style.visibility = "visible";
            }
            // else if(fullImageresult==false)
            // {
            //     document.getElementById("full_imageError").style.visibility = "visible";
            // }
            else if(emergency_contact_nameValue==='')
            {
                document.getElementById("emergency_contact_nameError").style.visibility = "visible";
                document.getElementById("emergency_contact_name").style.borderColor = "red";
            }
            else if(emergency_contact_relationshipValue==='')
            {
                document.getElementById("emergency_contact_relationshipError").style.visibility = "visible";
                document.getElementById("emergency_contact_relationship").style.borderColor = "red";
            }
            else if(emergency_contact_phoneValue==='')
            {
                document.getElementById("emergency_contact_phoneError").style.visibility = "visible";
                document.getElementById("emergency_contact_phone").style.borderColor = "red";
            }
            else if(emergency_contact_addressValue==='')
            {
                document.getElementById("emergency_contact_addressError").style.visibility = "visible";
                document.getElementById("emergency_contact_address").style.borderColor = "red";
            }
            else if(passport_numberValue==='')
            {
                document.getElementById("passport_numberError").style.visibility = "visible";
                document.getElementById("passport_number").style.borderColor = "red";
            }
            else if(passport_issue_placeValue==='')
            {
                document.getElementById("passport_issue_placeError").style.visibility = "visible";
                document.getElementById("passport_issue_place").style.borderColor = "red";
            }
            else if(passport_issue_dateValue==='')
            {
                document.getElementById("passport_issue_dateError").style.visibility = "visible";
                document.getElementById("passport_issue_date").style.borderColor = "red";
            }
            else if(passport_expire_dateValue==='')
            {
                document.getElementById("passport_expire_dateError").style.visibility = "visible";
                document.getElementById("passport_expire_date").style.borderColor = "red";
            }
            else if(passport_fileValue==='')
            {
                document.getElementById("passport_fileError").style.visibility = "visible";
                document.getElementById("passport_file").style.borderColor = "red";
            }
            else if(passportFileResult==false)
            {
                document.getElementById("passport_fileError2").style.visibility = "visible";
            }
            // else if(medical_certificateFileResult==false)
            // {
            //     document.getElementById("medical_certificateError").style.visibility = "visible";
            // }
            // else if(immigration_security_clearenceFileResult==false)
            // {
            //     document.getElementById("immigration_security_clearenceError").style.visibility = "visible";
            // }
            
            else{
                console.log('success');
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("tab");
                // Exit the function if any field in the current tab is invalid:
                // if (n == 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab >= x.length) {
                    // ... the form gets submitted:
                    document.getElementById("gm_dm_form").submit();
                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }
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
        $("#czContainerEducation").czMore();
    </script>
    <script>
        function displayChildren(value)
        {
            if(value == 2 || value == 3){
                element = document.querySelector('#children-div');
                element.classList.remove("d-none");
            }else if(value == 1){
                element = document.querySelector('#children-div');
                element.classList.add("d-none");
            }
        }
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

        $(".js-search-tags").select2({
            tags: true,
          placeholder: "Other Skills"
        });

    </script>
@endsection