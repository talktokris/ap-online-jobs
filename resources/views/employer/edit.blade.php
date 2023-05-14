@extends('employer.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card auth-form">
                <div class="card-header">
                    @if(Auth::user()->hasRole('superadministrator'))
                    <h3 class="mt-2"><a href="{{route('admin.employerApplication')}}" class="btn btn-danger pull-left">Back</a></h3>
                    @elseif(Auth::user()->hasRole('employer'))
                    <h3 class="mt-2"><a href="{{route('employer.show')}}" class="btn btn-danger pull-left">Back </a></h3>
                    @endif
                    <h2 class="text-center">{{ __('Update Employer Inofrmation') }}</h2>
                </div>           
                <div class="card-body">
                    <form method="POST" action="{{ route('employer.update', $employer->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="role" value="employer">   
                        <div class="form-group row" style="margin-left: 150px;">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_pro" value="yes" class="custom-control-input" id="looking_for_pro" {{ $employer->employer_profile->looking_for_pro == 'yes' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="looking_for_pro">Looking For Job Seeker</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_gw" value="yes" class="custom-control-input" id="looking_for_gw" {{ $employer->employer_profile->looking_for_gw == 'yes' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="looking_for_gw">Looking For Foreign Worker</label>
                                </div>
                            </div>              
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_dm" value="yes" class="custom-control-input" id="looking_for_dm" {{ $employer->employer_profile->looking_for_dm == 'yes' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="looking_for_dm">Looking For Domestic Maid</label>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_rp" value="yes" class="custom-control-input" id="looking_for_rp" {{ $employer->employer_profile->looking_for_rp == 'yes' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="looking_for_rp">Looking For Retired Person</label>
                                </div>
                            </div>
                        </div><hr>
                        <div class="form-group">
                            <h3 class="text-center">Company Information</h3>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="company_name">{{ __('Company Name ') }}<span class="text-danger">*</span></label>
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ $employer->employer_profile->company_name }}" placeholder="Company Name" required>
                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="roc">{{ __('Registration Number ') }}<span class="text-danger">*</span></label>
                                <input id="roc" type="text" class="form-control{{ $errors->has('roc') ? ' is-invalid' : '' }}" name="roc" value="{{ $employer->employer_profile->roc }}" placeholder="ROC" required>
                                @if ($errors->has('roc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roc') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="company_phone">{{ __('Telephone Number') }}</label>
                                <input id="company_phone" type="text" class="form-control{{ $errors->has('company_phone') ? ' is-invalid' : '' }}" name="company_phone" value="{{ $employer->employer_profile->company_phone }}" placeholder="Company Phone">
                                @if ($errors->has('company_phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="company_country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="company_country" id="company_country" class="form-control{{ $errors->has('company_country') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == $employer->employer_profile->company_country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="email">{{ __('Email ') }}<span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $employer->email }}" placeholder="Company Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="website">{{ __('Website ') }}</label>
                                <input id="website" type="text" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" name="website" value="{{ $employer->employer_profile->website }}" placeholder="Company Website">
                                @if ($errors->has('website'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="country">{{ __('State/Province/Division ') }}<span class="text-danger">*</span></label>
                                <select name="company_state" id="company_state" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="{{ $employer->employer_profile->state}}" disable="true" selected="true">{{$employer->employer_profile->company_state_data->name ?? 'N/A'}}</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="company_city">{{ __('City') }}</label>
                                <select name="company_city" id="company_city" required  class="form-control{{ $errors->has('company_city') ? ' is-invalid' : '' }}"> 
                                     <option value="{{ $employer->employer_profile->company_city}}" disable="true" selected="true">{{ $employer->employer_profile->company_city_data->name ?? 'N/A' }}</option>
                                </select>
                                @if ($errors->has('company_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="company_address">{{ __('Company Address') }}</label>
                                <input id="company_address" type="text" class="form-control{{ $errors->has('company_address') ? ' is-invalid' : '' }}" name="company_address" value="{{ $employer->employer_profile->company_address }}" placeholder="Company Address" required>
                                @if ($errors->has('company_address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="postcode">{{ __('Postcode') }}</label>
                                <input id="postcode" type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ $employer->employer_profile->postcode }}" placeholder="Postcode">
                                @if ($errors->has('postcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="postcode">{{ __('Sector') }}</label>
                                <select name="company_country" id="company_country" class="form-control{{ $errors->has('company_country') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Sector--</option>
                                    @foreach ($sectors as $sector)
                                        <option value="{{$sector->id}}" >{{$sector->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('postcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="company_logo">{{ __('Company Logo') }}</label>
                                <input id="company_logo" type="file" class="form-control-file{{ $errors->has('company_logo') ? ' is-invalid' : '' }}" name="company_logo" value="{{ old('company_logo') }}">
                                <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                @if ($errors->has('company_logo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_logo') }}</strong>
                                    </span>
                                @endif
                                @if($employer->employer_profile->company_logo)
                                <p>Current Logo</p>
                                <img src="{{asset('storage/'.$employer->employer_profile->company_logo)}}" alt="">
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="work_place_img">{{ __('Work Place/Company Image') }}</label>
                                <input id="work_place_img" type="file" class="form-control-file{{ $errors->has('work_place_img') ? ' is-invalid' : '' }}" name="work_place_img" value="{{ old('work_place_img') }}">
                                <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                @if($employer->employer_profile->work_place_img)
                                    <p>Current WorkPlace/Company Image</p>
                                    <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->work_place_img != '' ? asset('storage/'.$employer->employer_profile->work_place_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                                    <!-- <img src="{{asset('storage/'.$employer->employer_profile->work_place_img)}}" alt=""> -->
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="nature_of_work">{{ __('Image of Nature of work') }}</label>
                                <input id="nature_of_work" type="file" class="form-control-file{{ $errors->has('nature_of_work') ? ' is-invalid' : '' }}" name="nature_of_work" value="{{ old('nature_of_work') }}">
                                <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                @if($employer->employer_profile->nature_of_work_img)
                                    <p>Current Nature of Work Image</p>
                                    <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->nature_of_work_img != '' ? asset('storage/'.$employer->employer_profile->nature_of_work_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                                    <!-- <img src="{{asset('storage/'.$employer->employer_profile->nature_of_work_img)}}" alt=""> -->
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="hostel_img">{{ __('Picture of Hostel') }}</label>
                                <input id="hostel_img" type="file" class="form-control-file{{ $errors->has('hostel_img') ? ' is-invalid' : '' }}" name="hostel_img" value="{{ old('hostel_img') }}">
                                <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                @if($employer->employer_profile->hostel_img)
                                    <p>Current Hostel Image</p>
                                    <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->hostel_img != '' ? asset('storage/'.$employer->employer_profile->hostel_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                                    <!-- <img src="{{asset('storage/'.$employer->employer_profile->hostel_img)}}" alt=""> -->
                                @endif
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="product_of_company">{{ __('Product of Company') }}</label>
                                <input id="product_of_company" type="file" class="form-control-file{{ $errors->has('product_of_company') ? ' is-invalid' : '' }}" name="product_of_company" value="{{ old('product_of_company') }}">
                                <p class="text-danger">Supported file format JPG, PNG. Maximum file size: 1MB</p>
                                @if($employer->employer_profile->product_of_company_img)
                                    <p>Current Product of Company Image</p>
                                    <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->product_of_company_img != '' ? asset('storage/'.$employer->employer_profile->product_of_company_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                                    <!-- <img src="{{asset('storage/'.$employer->employer_profile->product_of_company_img)}}" alt=""> -->
                                @endif
                            </div>
                        </div><hr>
                        <div class="form-group">
                            <h3 class="text-center">Contact Information</h3>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="name">{{ __('Contact Name ') }}<span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $employer->name }}" placeholder="Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="contact_email">{{ __('Contact Email ') }}<span class="text-danger">*</span></label>
                                <input id="contact_email" type="email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" name="contact_email" value="{{ $employer->employer_profile->contact_email }}" placeholder="Email" required>

                                @if ($errors->has('contact_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="phone">{{ __('Contact Number ') }}</label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $employer->phone }}" placeholder="Contact Number">
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="nric">{{ __('NRIC ') }}</label>
                                <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ $employer->employer_profile->nric }}" placeholder="NRIC">
                                @if ($errors->has('nric'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nric') }}</strong>
                                    </span>
                                @endif
                            </div>
                          
                            <div class="col-sm-3">
                                <label for="country">{{ __('Country') }}</label>
                                <select name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}">
                                    <option value="">--Select Country--</option>
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == $employer->employer_profile->country ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
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
