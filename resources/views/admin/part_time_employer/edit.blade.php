@extends('employer.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card auth-form">
                <div class="card-header">
                    @if(Auth::user()->hasRole('superadministrator'))
                    <h3 class="mt-2"><a href="{{route('partTimeEmployer')}}" class="btn btn-danger pull-left">Back </a></h3>
                    @endif
                    <h2 class="text-center">Part Time Employer</h2>
                </div>           
                <div class="card-body">
                <form method="POST" action="{{route('parttimeemployer.update',$employer->user_id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="user_id" value="{{$employer->user_id}}">   
                        <div class="form-group row" style="margin-left: 150px;">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_maid" value="1" class="custom-control-input" id="looking_for_maid" {{ $employer->looking_for_maid == '1' ? 'checked' : '' }} onclick="lookingForMaid()">
                                    <label class="custom-control-label" for="looking_for_maid">Looking For Maid</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_driver" value="1" class="custom-control-input" id="looking_for_driver" {{ $employer->looking_for_driver == '1' ? 'checked' : '' }} onclick="lookingForDriver()">
                                    <label class="custom-control-label" for="looking_for_driver">Looking For Driver</label>
                                </div>
                            </div>              
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="looking_for_home_nurse" value="1" class="custom-control-input" id="looking_for_home_nurse" {{ $employer->looking_for_home_nurse == '1' ? 'checked' : '' }} onclick="lookingForHomeNurse()">
                                    <label class="custom-control-label" for="looking_for_home_nurse">Looking For Home Nurse</label>
                                </div>
                            </div>  
                        </div><hr>
                        <div class="form-group">
                            <h3 class="text-center">Part Time Employer</h3>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="name">Full Name<span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $employer->name }}" placeholder="First Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $employer->email }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label for="phone">Phone Number<span class="text-danger">*</span></label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $employer->phone }}" placeholder="Phone" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="home_phone">Home Number</label>
                                <input id="home_phone" type="text"class="form-control{{ $errors->has('home_phone') ? ' is-invalid' : '' }}"name="home_phone" value="{{ $employer->home_phone }}" placeholder="Phone">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district">{{ __('Country') }}</label>
                                    <select name="company_country" id="company_country" class="form-control" >
                                        <option value="3" selected="true">{{$employer->countryName->name}}</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <option value="{{$country->id}}" {{$country->id == $employer->employer_profile->company_country ? 'selected':''}}>{{$country->name}}</option> --}}
                            <div class="col-sm-3">
                                <label for="name">State<span class="text-danger">*</span></label>
                                <select name="state" class="form-control" id="person_state" required>
                                    <option value="" disable="true" selected="true">-------  Select State -------</option>
                                    @foreach ($state as $state)
                                        <option value="{{$state->id}}" {{$state->id == $employer->state ? 'selected':''}}>{{$state->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-sm-3">
                                <label for="name">City<span class="text-danger">*</span></label>
                                <select name="city" class="form-control" id="person_city" required>
                                    <option value="">-------  Select City -------</option>
                                    @foreach ($city as $city)
                                        <option value="{{$city->id}}" {{$city->id == $employer->city ? 'selected':''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="address">Full Address</label>
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $employer->address }}" placeholder="Company Phone">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="address">Second Home Address</label>
                                <input id="address2" type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{ $employer->address2 }}" placeholder="Second Home Address">
                                @if ($errors->has('address2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-sm-3">
                                <label for="nric">Identity Card Number(MyKad)</label>
                                <input id="nric" type="text" class="form-control{{ $errors->has('nric') ? ' is-invalid' : '' }}" name="nric" value="{{ $employer->nric }}" placeholder="My Card">
                                @if ($errors->has('nric'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nric') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="post_code">Post Code</label>
                                <input id="post_code" type="text" class="form-control{{ $errors->has('post_code') ? ' is-invalid' : '' }}" name="post_code" value="{{ $employer->post_code}}" placeholder="Post Code">
                                @if ($errors->has('post_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                       
                            <div class="col-sm-6">
                                <label for="name">{{ __('When do you need the Services?') }}<span class="text-danger">*</span></label>
                                <select name="service_time" class="form-control">
                                    <option value="" disable="true" selected="true">When do you need the Services?</option>
                                    <option value="Immediately" {{'Immediately' == $employer->service_time ? 'selected':''}}>Immediately</option>
                                    <option value="In the next 3 days" {{'In the next 3 days' == $employer->service_time ? 'selected':''}}>In the next 3 days</option>
                                    <option value="In the next 7 days" {{'In the next 7 days' == $employer->service_time ? 'selected':''}}>In the next 7 days</option>
                                    <option value="In the next 15 days" {{'In the next 15 days' == $employer->service_time ? 'selected':''}}>In the next 15 days</option>
                                    <option value="Winthin a month" {{'"Winthin a month' == $employer->service_time ? 'selected':''}}>Winthin a month</option>
                                    <option value="After a month" {{'After a month' == $employer->service_time ? 'selected':''}}>After a month</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="name">{{ __('When type of service do you need?') }}</label>
                                <select name="service_type" class="form-control">
                                    <option value="" disable="true" selected="true">When do you need the Services?</option>
                                    <option value="Part Time" {{'Part Time' == $employer->service_type ? 'selected':''}}>Part Time</option>
                                    <option value="Full Time - Non Live-in" {{'Full Time - Non Live-in' == $employer->service_type ? 'selected':''}}>Full Time - Non Live-in</option>
                                    <option value="Full Time - Live-in" {{'Full Time - Live-in' == $employer->service_type ? 'selected':''}}>Full Time - Live-in</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="passport_file">{{ __('MyKad Front Copy') }}</label>
                                    <input id="passport_file" type="file" class="form-control-file{{ $errors->has('passport_file') ? ' is-invalid' : '' }}" name="passport_file" value="{{ $employer->passport_file }}" placeholder="Passport File">
                                    @if($employer->passport_file)
                                        <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$employer->passport_file)}}">View Passport File</a>
                                    @endif
                                    <p class="text-danger">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                    @if ($errors->has('passport_file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passport_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="passport_file_back">{{ __('MyKad Back Copy') }}</label>
                                    <input id="passport_file_back" type="file" class="form-control-file{{ $errors->has('passport_file_back') ? ' is-invalid' : '' }}" name="passport_file_back" value="{{ $employer->passport_file_back }}" placeholder="Passport File">
                                    @if($employer->passport_file_back)
                                        <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$employer->passport_file_back)}}">View Passport File</a>
                                    @endif
                                    <p class="text-danger">Supported file format PDF, JPG and PNG. Maximum file size: 1MB</p>
                                    @if ($errors->has('passport_file_back'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('passport_file_back') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <?php 
                            $service_task=$employer->service_task;
                            $final_task=explode(",",$service_task);
                            if($employer->looking_for_home_nurse=='1' && $employer->looking_for_maid=='1'){
                                $service_task_all=['Housekeeping','Clean Utensils','Wash Clothes','Iron Clothes','Elderly care','In house patients','Hospitalised patients'];
                            }elseif($employer->looking_for_maid=='1'){
                                $service_task_all=['Housekeeping','Clean Utensils','Wash Clothes','Iron Clothes'];
                            }elseif($employer->looking_for_driver=='1'){
                                $service_task_all=[];
                            }elseif($employer->looking_for_home_nurse=='1'){
                                $service_task_all=['Elderly care','In house patients','Hospitalised patients'];
                            }else{
                                $service_task_all=[];
                            }
                            ?>
                            <div class="col-sm-6">
                                <label for="name">{{ __('Select tasks that you want to get done:') }}<span class="text-danger">*</span></label>
                                <select placeholder="Name" class="form-control" id="task" name="service_task[]" multiple="multiple" style="width:200px;border-style: groove;">
                                    @foreach ($service_task_all as $list )
                                        <option value="{{$list}}" 
                                        @foreach ($final_task as $task)
                                            @if($list == $task)
                                            {{'selected'}}
                                            @endif
                                        @endforeach
                                        >{{$list}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#looking_for').select2();
                                    $('#task').select2({
                                        placeholder: "Select tasks that you want to get done"
                                    });
                                });
                            </script>
                    </div>    
                        <hr>
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
@section('script')
<script>
function lookingForMaid() {
	
	var maid_option1 = document.getElementById("looking_for_maid")
		if(maid_option1.checked){
			$("#task").append('<option value="Housekeeping">Housekeeping</option>');
			$("#task").append('<option value="Clean Utensils">Clean Utensils</option>');
			$("#task").append('<option value="Wash Clothes">Wash Clothes</option>');
			$("#task").append('<option value="Iron Clothes">Iron Clothes</option>');
		}
		if(!maid_option1.checked){
			$("#task").find('[value="Housekeeping"]').remove();
			$("#task").find('[value="Clean Utensils"]').remove();
			$("#task").find('[value="Wash Clothes"]').remove();
			$("#task").find('[value="Iron Clothes"]').remove();
		}
	
}
function lookingForDriver() {
}
function lookingForHomeNurse() {
    
	var nurses_option3 = document.getElementById("looking_for_home_nurse")
   
		if(nurses_option3.checked){
			$("#task").append('<option value="Elderly care">Elderly care</option>');
			$("#task").append('<option value="In house patients">In house patients</option>');
			$("#task").append('<option value="Hospitalised patients">Hospitalised patients</option>');
		}
		if(!nurses_option3.checked){
			$("#task").find('[value="Elderly care"]').remove();
			$("#task").find('[value="In house patients"]').remove();
			$("#task").find('[value="Hospitalised patients"]').remove();
		}
}
</script>

@endsection