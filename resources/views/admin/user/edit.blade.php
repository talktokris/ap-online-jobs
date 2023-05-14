@extends('admin.layouts.master')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2 style="text-align: center;"><a class="btn btn-primary btn-sm" href="{{route('user.index')}}">Back</a>Edit User</h2><hr>
                <form method="POST" action="{{ route('user.update',$users->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="user_name">First Name</label><span class="text-danger"> *</span>
                            <input type="text" value="{{$users->name}}" name="user_name"  class="form-control"  required placeholder="First Name">
                        </div>
                        <div class="col-sm-3">
                            <label for="user_name">Last Name</label><span class="text-danger"> *</span>
                            <input type="text" name="user_last_name" value="{{$users->last_name}}"  class="form-control"  required placeholder="Last Name">
                        </div>
                        <div class="col-sm-3">
                            <label for="user_phone">Phone Number</label><span class="text-danger"> *</span>
                            <input type="text" value="{{$users->phone}}" name="user_phone"  class="form-control"  required placeholder="Name">
                        </div>
                        <div class="col-sm-3">
                            <label for="user_email">Email</label><span class="text-danger"> *</span>
                            <input type="email" value="{{$users->email}}" name="user_email"  class="form-control"  required placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                         <div class="col-sm-3" id="com_country">
                             <label for="company_country">Country</label><span class="text-danger"> *</span>
                            <select name="company_country" id="company_country" required class="form-control" >
                                <option value="{{$user_profiles->company_country}}" disable="true" selected="true">{{$user_profiles->country_data->name ?? N/A}}</option>
                                @foreach ($countrys as $key=> $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                         </div>
                         <div class="col-sm-3" id="com_state">
                             <label for="state">State/Province/Division</label><span class="text-danger"> *</span>
                             <select name="company_state" id="company_state" required class="form-control">
                                <option value="{{$user_profiles->company_state}}" disable="true" selected="true">{{$user_profiles->state_data->name}}</option>
                             </select>
                             <!-- @if ($errors->has('company_state'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('company_state') }}</strong>
                                 </span>
                             @endif -->
                         </div>
                         <div class="col-sm-3" id="com_city">
                             <label for="city">City</label><span class="text-danger"> *</span>
                             <select name="company_city" id="company_city" required class="form-control">
                                 <option value="{{$user_profiles->company_city}}" disable="true" selected="true">{{$user_profiles->city_data->name}}</option> 
                             </select>
                             @if ($errors->has('company_city'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('company_city') }}</strong>
                                 </span>
                             @endif
                         </div>
                         <div class="col-sm-3">
                             <label for="company_country">New Password</label><span class="text-danger"></span>
                             <div class="input-group">
                                <input type="password" class="form-control pwd" name="user_password">          
                             </div>
                         </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="date_of_birth">{{ __('Date of Birth ') }}<span class="text-danger">*</span></label>
                            <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" min="1900-01-01" max="2200-01-01" value="{{$user_profiles->date_of_birth}}" placeholder="Date of Birth" required>
                            @if ($errors->has('date_of_birth'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date_of_birth') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-3">
                            <label for="user_role">Role</label><span class="text-danger"> *</span>
                            <select name="user_role" id="user_role" required class="form-control" >
                                <option value="{{$users->roles->first()->id}}" disable="true" selected="true">{{$users->roles->first()->description}}</option>
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
                            <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{$user_profiles->passport_number}}" placeholder="Passport/NRIC" required>
                            @if ($errors->has('nric'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nric') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-3">
                            <label for="passport_file">{{ __('Passport Copy ') }}</label><span class="text-danger"> *</span>
                            <div class="form-group">
                                <input onchange="previewFile('#image_preview', '#image')" id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" name="passport_file">
                                <p class="text-danger">To get best view, upload a square size image and must be less than 250KB</p>
                                <img id="image_preview" style="width: 100px;" src="{{$user_profiles->passport_file != '' ? asset('storage/'.$user_profiles->passport_file ) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
    
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6" id="company_name">
                            <label for="company_name">Company Name</label><span class="text-danger"> *</span>
                            <input type="text" value="{{$user_profiles->company_name}}" name="company_name"  class="form-control" id="com_name" required placeholder="Company Name">
                        </div>
                        <div class="col-sm-3" id="registration_number">
                            <label for="roc">Registration Number</label><span class="text-danger"> *</span>
                            <input type="text" value="{{$user_profiles->roc}}" name="roc" class="form-control" id="com_registration" required placeholder="Registration Number">
                        </div>
                        <div class="col-sm-3" id="telephone_number">
                            <label for="company_phone">Telephone Number</label><span class="text-danger"> *</span>
                            <input type="text" value="{{$user_profiles->company_phone}}" name="company_phone" class="form-control" id="com_number" required placeholder="Telephone Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="roc_file">{{ __('Registration Copy ') }}</label><span class="text-danger"> *</span>
                            <div class="form-group">
                                <input onchange="previewFile('#image_preview', '#image')" id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}" name="roc_file">
                                <p class="text-danger">To get best view, upload a square size image and must be less than 250KB</p>
                                <img id="image_preview" style="width: 100px;" src="{{$user_profiles->roc_file != '' ? asset('storage/'.$user_profiles->roc_file) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
    
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
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
@endsection