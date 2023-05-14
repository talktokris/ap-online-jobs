@extends('layouts.app')
@section('content')
{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" /> --}}
<div class="container py-5" style="margin-top:55px">
    <div class="row">
        <div class="col-md-10 mx-auto">
                <h2 style="text-align: center;">Foregin Worker Registration</h2><hr>
                <form method="POST" action="{{route('foreign.worker.registration.save')}}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="name">{{ __('Name ') }}<span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="First Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-sm-4">
                                <label for="address">{{ __('Address ') }}</label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" placeholder="Address">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                      
                            <div class="col-sm-4">
                                <label for="passport_number">{{ __('Passport Number') }}<span class="text-danger">*</span></label>
                                <input id="passport_number" type="text" class="form-control{{ $errors->has('passport_number') ? ' is-invalid' : '' }}" name="passport_number" value="{{ old('passport_number') }}" placeholder="Passport/NRIC" >
                                @if ($errors->has('passport_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                           
                        </div>
                        
                        <div class="form-group row">
                          
                            <div class="col-sm-3">
                                <label for="country">{{ __('Country ') }}<span class="text-danger">*</span></label>
                                <select name="country" id="company_country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="">--Select Country--</option>
                                    @foreach ($country as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="state">{{ __('State ') }}<span class="text-danger">*</span></label>
                                <select name="state" id="company_state" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" required>
                                    <option value="" disable="true" selected="true">--Select State--</option>
                                </select>
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="city">{{ __('City ') }}<span class="text-danger">*</span></label>
                                <select name="city" id="company_city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" required>
                                    <option value="" disable="true" selected="true">--Select City--</option>
                                </select>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="phone">{{ __('Contact Number ') }}<span class="text-danger">*</span></label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                         
                            <div class="col-sm-3">
                                <label for="email">{{ __('Email Address ') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="margin-top: 29px; margin-right: 15px;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="passport_file">{{ __('Passport Copy ') }}</label>
                                <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ old('passport_file') }}">
                                <p class="text-danger">Supported file format pdf, doc or docx. Maximum file size: 1MB</p>
                                @if ($errors->has('passport_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <div class="">
                                    <input type="checkbox" class="form-check-input" name="agreement" id="customCheck1" required checked>
                                    <label class="" for="customCheck1">I have read and agree to the <a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
