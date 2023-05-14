@extends('layouts.app')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2 style="text-align: center;"><a class="btn btn-primary btn-sm" href="{{route('user.index')}}">Back</a>Create user</h2><hr>
                <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="user_name">First Name</label><span class="text-danger"> *</span>
                            <input type="text" name="user_name"  class="form-control"  required placeholder="First Name">
                        </div>
                        <div class="col-sm-3">
                            <label for="user_name">Last Name</label><span class="text-danger"> *</span>
                            <input type="text" name="user_last_name"  class="form-control"  required placeholder="Last Name">
                        </div>
                        <div class="col-sm-3">
                            <label for="user_phone">Mobile Number</label><span class="text-danger"> *</span>
                            <input type="text" name="user_phone"  class="form-control"  required placeholder="Name">
                        </div>
                        <div class="col-sm-3">
                            <label for="user_email">Email</label><span class="text-danger"> *</span>
                            <input type="email" name="user_email"  class="form-control"  required placeholder="Email">
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        @if(Auth::user()->hasRole('superadministrator'))    
                            <div class="col-sm-3" id="com_country">
                                <label for="company_country">Country</label><span class="text-danger"> *</span>
                                <select name="company_country" id="company_country" required class="form-control" >
                                    <option value="" disable="true" selected="true">- - - - -  Select Country  - - - - -</option>
                                    @foreach ($countrys as $key=> $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3" id="com_state">
                                <label for="state">State/Province/Division</label><span class="text-danger"> *</span>
                                <select name="company_state" id="company_state" required class="form-control">
                                    <option value="" disable="true" selected="true">-------  Select State -------</option>
                                </select>
                                @if ($errors->has('company_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="com_city">
                                <label for="city">City</label><span class="text-danger"> *</span>
                                <select name="company_city" id="company_city" required class="form-control">
                                    <option value="" disable="true" selected="true">-------  Select City -------</option> 
                                </select>
                                @if ($errors->has('company_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if(Auth::user()->hasRole('cadmin'))
                            <div class="col-sm-3" id="com_country">
                                <label for="company_country">Country</label><span class="text-danger"> *</span>
                                <select name="company_country" id="company_country" required class="form-control" >
                                    @foreach ($countrys as $country)
                                        <option value="{{$country->id}}" {{$country->id == old('company_country') ? 'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3" id="com_state">
                                <label for="state">State/Province/Division</label><span class="text-danger"> *</span>
                                <select name="company_state" id="company_state" required class="form-control">
                                <option value="" disable="true" selected="true">-------  Select State -------</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" >{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" id="com_city">
                                <label for="city">City</label><span class="text-danger"> *</span>
                                <select name="company_city" id="company_city" required class="form-control">
                                    <option value="" disable="true" selected="true">-------  Select City -------</option> 
                                </select>
                                @if ($errors->has('company_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                        
                         <div class="col-sm-3">
                             <label for="company_country">Password</label><span class="text-danger"> *</span>
                             <div class="input-group">
                             <input type="password" class="form-control pwd" required name="user_password">
                             <span class="input-group-btn">
                                 <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                             </span>          
                             </div>
                         </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="date_of_birth">{{ __('Date of Birth ') }}<span class="text-danger">*</span></label>
                            <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" min="1900-01-01" max="2200-01-01" value="{{ old('date_of_birth') ? \Carbon\Carbon::parse(old('date_of_birth'))->format('Y-m-d') : ''}}" placeholder="Date of Birth" required>
                            @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-3">
                            <label for="user_role">Role</label><span class="text-danger"> *</span>
                            <select name="user_role" id="user_role" required class="form-control" >
                                <option value="" disable="true" selected="true">-- Select Role --</option>
                                @if(Auth::user()->hasRole('superadministrator'))
                                    <option value="1">Superadministrator</option>
                                    <option value="2">Administrator</option>
                                    <option value="9">Country-User</option>
                                    <option value="10">Sub-Exclusive Business Partner</option>
                                @endif
                                @if(Auth::user()->hasRole('cadmin'))
                                    <option value="10">Sub-Exclusive Business Partner</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="nric">{{ __('Passport/NRIC ') }}<span class="text-danger">*</span></label>
                            <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ old('nric') }}" placeholder="Passport/NRIC" required>
                            @if ($errors->has('nric'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nric') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-3">
                            <label for="passport_file">{{ __('Passport Copy ') }}</label>
                            <div class="upload-area">
                                <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Choose File </span></button>
                                <span class="uploadfiles">
                                    <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ old('passport_file') }}" placeholder="Passport File">
                                </span>
                                <p class="text-short-mes">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                @if ($errors->has('passport_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passport_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6" id="company_name">
                            <label for="company_name">Company Name</label><span class="text-danger"> *</span>
                            <input type="text" name="company_name"  class="form-control" id="com_name" required placeholder="Company Name">
                        </div>
                        <div class="col-sm-3" id="registration_number">
                            <label for="roc">Registration Number</label><span class="text-danger"> *</span>
                            <input type="text" name="roc" class="form-control" id="com_registration" required placeholder="Registration Number">
                        </div>
                        <div class="col-sm-3" id="telephone_number">
                            <label for="company_phone">Telephone Number</label><span class="text-danger"> *</span>
                            <input type="text" name="company_phone" class="form-control" id="com_number" required placeholder="Telephone Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="roc_file">{{ __('Registration Copy ') }}</label>
                            <div class="upload-area">
                                <button type="button" class="upload-btn"><span ng-bind="uploader.status.fileName">Choose File </span></button>
                                <span class="uploadfiles">
                                    <input id="roc_file" type="file" class="form-control-file{{ $errors->has('roc_file') ? ' is-invalid' : '' }}" name="roc_file" value="{{ old('roc_file') }}" placeholder="ROC File">
                                </span>
                                <p class="text-short-mes">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                @if ($errors->has('roc_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roc_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Save') }}
                            </button>
                        </div>
                </form>
        </div>
     </div>
</div>
<script>
    $(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>
@endsection