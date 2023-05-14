@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <img style="max-width: 200px;" src="{{asset('storage/'.$employer->employer_profile->company_logo)}}" alt="">
                                <h4>Welcome {{$employer->employer_profile->company_name}}</h4>
                                @if(Auth::user()->status == 1)

                                @else
                                <p class="text-danger">Your Employer Applications under review</p>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Address</strong><br/>
                                <span>{{$employer->employer_profile->company_address ?? 'N/A'}}</span><br/>
                                <span>{{$employer->employer_profile->country_data->name ?? 'N/A'}}</span>
                            </div>
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('employer.type.update', Auth::user()->id) }}" enctype="multipart/form-data">
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
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-warning btn-block">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @if(Auth::user()->status == 1)
                            <div class="col-md-12">
                                <hr>
                                <div class="row">
                                {{-- <a class="btn btn-info btn-sm pull-left" href="#downloads"> <i class="fa fa-download"></i> Download files</a> --}}
                               
                                @if($employer->employer_profile->looking_for_pro == 'yes')
                                <div class="col-md-4">
                                    <a class="btn btn-success btn-sm ml-3" href="{{route('job.create')}}">Post Vacancy for Jobseekers</a>
                                </div>
                                @endif
                                @if($employer->employer_profile->looking_for_gw == 'yes')
                                <div class="col-md-4">
                                    <a class="btn btn-warning btn-sm ml-3" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#demandModal" href="#">Send Demand for Foreign Workers</a>
                                </div>
                                @endif
                                <div class="col-md-4">
                                <form method="GET" action="{{route('job.create')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="blue_color" value="blue_colors">
                                    <button type="submit" class="btn btn-primary btn-sm ml-3">
                                        Post Vacancy for Blue Color Job Seeker
                                    </button>
                                {{-- <a class="btn btn-primary btn-sm ml-3" href="{{route('job.create')}}">Post Vacancy for Blue Color Job Seeker</a> --}}
                                </form>
                                </div>
                            </div>
                            </div>
                            @endif
                        </div>
                       
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                @if(Auth::user()->status == 1)
                @if($employer->employer_profile->looking_for_pro == 'yes')
                {{-- Jobs Posted --}}
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">
                        All Jobs
                    </h4>
                    <div class="card-body">
                        <table id="jobs-table" class="my_datatable table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Positions Name</th>
                                    <th>Worker Type</th>
                                    <th>Vacancies</th>
                                    <th>Closing Date</th>
                                    <th>Nature</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <th>Positions Name</th>
                                    <th class="hide"></th>
                                    <th>Vacancies</th>
                                    <th>Closing Date</th>
                                    <th>Nature</th>
                                    <th class="hide">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                @if($employer->employer_profile->looking_for_gw == 'yes')
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">
                        Demand for Foreign Workers
                        <a class="btn btn-warning btn-sm mb-2 mr-2 pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#demandModal" href="#">Send Demand for Foreign Workers</a>
                    </h4>
                    <div class="card-body">
                        <table id="demands-table" class="my_datatable table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <!-- <th title="Approval KDN No">KDN No</th>
                                    <th title="Company">Company</th> -->
                                    <th title="Nationality">Nationality</th>
                                    <th title="Issue Date">Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th title="Day Pending">Day Pending</th>
                                    <th title="Confirmed Quantity">Confirmed Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th title="Status">Status</th>
                                    <th title="Interview Date">Interview Date</th>
                                    <th title=""></th>
                                   
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <!-- <th title="Approval KDN No">KDN No</th>
                                    <th title="Company">Company</th> -->
                                    <th title="Nationality">Nationality</th>
                                    <th title="Issue Date">Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th title="Day Pending">Day Pending</th>
                                    <th title="Confirmed Quantity">Confirmed Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th title="Status">Status</th>
                                    <th title="Interview Date">Interview Date</th>
                                    <th class="hide" title=""></th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                <!-- Demand Entry Modal -->
                <div class="modal fade" id="demandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content tex-center">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLongTitle" style="margin-left: 400px;"> Send Demand for Foreign Workers </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-11">
                                        <form method="POST" action="{{ route('saveDemand') }}" aria-label="{{ __('Save Demand') }}" enctype="multipart/form-data">
                                            @csrf
                                            <br>
                                            <div class="row">
                                                <!-- <div class="form-group col-md-4">
                                                    <select id="HiringPackage" class="form-control{{ $errors->has('HiringPackage') ? ' is-invalid' : '' }}" name="HiringPackage">
                                                        <option value="">-- Hiring Package --</option>
                                                        <option value="p1">Package 1</option>
                                                        <option value="p2">Package 2</option>
                                                        <option value="p3">Package 3</option>
                                                    </select>

                                                    @if ($errors->has('HiringPackage'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('HiringPackage') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> -->
                                                <!-- <div class="form-group col-md-6">
                                                    <input id="CompanyName" type="text" class="form-control{{ $errors->has('CompanyName') ? ' is-invalid' : '' }}" name="CompanyName" value="{{ old('CompanyName') }}" placeholder="Company Name*" required>

                                                    @if ($errors->has('CompanyName'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('CompanyName') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> -->
                                                <div class="form-group col-md-4"> 
                                                    <select name="job_position" id="job_position" class="form-control{{ $errors->has('job_position') ? ' is-invalid' : '' }}" required>
                                                        <option  value="">-- Sector *--</option>
                                                        @foreach ($job_positions as $job_position)
                                                            <option value="{{$job_position->name}}" {{$job_position->name == old('job_position') ? 'selected':''}}>{{$job_position->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input class="form-control" type="text" name="job_location" id="job_location" placeholder="Job Location">
                                                </div>
                                                
                                                <div class="form-group col-md-4">
                                                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Gender --</option>
                                                        @foreach ($genders as $gender)
                                                            <option value="{{$gender->id}}">{{$gender->name}}</option>
                                                        @endforeach                                                        
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group col-md-4">
                                                    <select name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Marital Status --</option>
                                                        @foreach ($marital_statuses as $marital_status)
                                                            <option value="{{$marital_status->name}}">{{$marital_status->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> -->
                                            </div><br>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <select name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Marital Status --</option>
                                                        @foreach ($marital_statuses as $marital_status)
                                                            <option value="{{$marital_status->name}}">{{$marital_status->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group col-md-4">
                                                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Gender --</option>
                                                        @foreach ($genders as $gender)
                                                            <option value="{{$gender->id}}">{{$gender->name}}</option>
                                                        @endforeach                                                        
                                                    </select>
                                                </div> -->
                                                <!-- <div class="form-group col-md-4">
                                                    <select name="marital_status" id="marital_status" class="form-control{{ $errors->has('marital_status') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Marital Status --</option>
                                                        @foreach ($marital_statuses as $marital_status)
                                                            <option value="{{$marital_status->name}}">{{$marital_status->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> -->
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_language" id="preferred_language" class="form-control{{ $errors->has('preferred_language') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Language --</option>
                                                        @foreach ($languages as $language)
                                                            <option value="{{$language->name}}">{{$language->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="highest_education" id="highest_education" class="form-control{{ $errors->has('highest_education') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Highest Education --</option>
                                                        @foreach ($educations as $education)
                                                            <option value="{{$education->name}}" {{$education->name == old('education') ? 'selected':''}}>{{$education->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <!-- <div class="form-group col-md-4">
                                                    <select name="preferred_language" id="preferred_language" class="form-control{{ $errors->has('preferred_language') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Language --</option>
                                                        @foreach ($languages as $language)
                                                            <option value="{{$language->name}}">{{$language->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div> -->
                                                <div class="form-group col-md-2">
                                                    <select name="reading" id="reading" class="form-control{{ $errors->has('reading') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Reading --</option>
                                                        <option value="Fluent">Fluent</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Poor">Poor</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <select name="written" id="written" class="form-control{{ $errors->has('written') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Written --</option>
                                                        <option value="Good">Good</option>
                                                        <option value="Fluent">Fluent</option>
                                                        <option value="Poor">Poor</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <textarea rows="3" id="Comments" class="form-control{{ $errors->has('Comments') ? ' is-invalid' : '' }}" name="comments" value="{{ old('Comments') }}" placeholder="Vacancies Description"></textarea>
        
                                                        @if ($errors->has('Comments'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('Comments') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="ExpectedJoinDate" class="pull-left">Expected Join Date*</label>
                                                    <input id="ExpectedJoinDate" type="date" class="form-control{{ $errors->has('ExpectedJoinDate') ? ' is-invalid' : '' }}" name="ExpectedJoinDate" value="{{ old('ExpectedJoinDate') }}" title="Expected Join Date*" required>

                                                    @if ($errors->has('ExpectedJoinDate'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ExpectedJoinDate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div><br>
                                            <!-- <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input class="form-control" type="text" name="job_location" id="job_location" placeholder="Job Location">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <textarea id="Comments" class="form-control{{ $errors->has('Comments') ? ' is-invalid' : '' }}" name="comments" value="{{ old('Comments') }}" placeholder="Vacancies Description"></textarea>
        
                                                        @if ($errors->has('Comments'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('Comments') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="IssueDate" class="pull-left">Issue Date*</label>
                                                    <input id="IssueDate" type="date" class="form-control{{ $errors->has('IssueDate') ? ' is-invalid' : '' }}" name="IssueDate" value="{{ old('IssueDate') }}" title="Issue Date*" required>

                                                    @if ($errors->has('IssueDate'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('IssueDate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="ExpectedJoinDate" class="pull-left">Expected Join Date*</label>
                                                    <input id="ExpectedJoinDate" type="date" class="form-control{{ $errors->has('ExpectedJoinDate') ? ' is-invalid' : '' }}" name="ExpectedJoinDate" value="{{ old('ExpectedJoinDate') }}" title="Expected Join Date*" required>

                                                    @if ($errors->has('ExpectedJoinDate'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ExpectedJoinDate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                        <label for="ExpectedJoinDate" class="pull-left">.</label>
                                                    <input id="DemandLetterNo" type="text" class="form-control{{ $errors->has('DemandLetterNo') ? ' is-invalid' : '' }}" name="DemandLetterNo" value="{{ old('DemandLetterNo') }}" placeholder="Approval KDN No*" required>

                                                    @if ($errors->has('DemandLetterNo'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('DemandLetterNo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> -->
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_country[]" id="preferred_country" class="form-control{{ $errors->has('preferred_country') ? ' is-invalid' : '' }}" required>
                                                        <option value="">-- Preferred Country *--</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('preferred_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('preferred_country') }}</strong>
                                                        </span>
                                                    @endif

                                                    <input id="demand_qty" type="text" class="mt-3 form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity*" required>

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_country[]" id="preferred_country" class="form-control{{ $errors->has('preferred_country') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('preferred_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('preferred_country') }}</strong>
                                                        </span>
                                                    @endif

                                                    <input id="demand_qty" type="text" class="mt-3 form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity">

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_country[]" id="preferred_country" class="form-control{{ $errors->has('preferred_country') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('preferred_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('preferred_country') }}</strong>
                                                        </span>
                                                    @endif

                                                    <input id="demand_qty" type="text" class="mt-3 form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity">

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div><br>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="pull-left" for="">Demand Letter</label>
                                                    <input id="DemandFile" type="file" class="form-control-file{{ $errors->has('DemandFile') ? ' is-invalid' : '' }}" name="DemandFile" title="Upload demand letter">
                                                    <p class="text-left small">Supported file PDF, JPG and PNG. Max file size: 1MB</p>
                                                </div>

                                                @if ($errors->has('DemandFile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('DemandFile') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="form-group col-md-6">
                                                    <label class="pull-left" for="">KDN Approval Letter and Levy Receipt</label>
                                                    <input id="approvalQuotaAndLevy" type="file" class="form-control-file{{ $errors->has('approvalQuotaAndLevy') ? ' is-invalid' : '' }}" name="approvalQuotaAndLevy" title="KDN, Quota Approval and Levy Receipt">
                                                    <p class="text-left small">Supported file PDF, JPG and PNG. Max file size: 1MB</p>
                                                </div>

                                                @if ($errors->has('approvalQuotaAndLevy'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('approvalQuotaAndLevy') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                    
                                            <div class="form-group mb-0 text-center" style="width: 59px; margin-left: 475px;">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Send') }}
                                                </button>
                                            </div><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--  /.modal-dialog modal-dialog-centered  -->
                </div><!--  /.modal fade  -->
                <!-- /.Login Modal -->

                <div class="modal fade" id="requestforinterview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content tex-center">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLongTitle"> Select Date and time</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-11">
                                        <form method="POST" action="{{ route('addinterviewdatetime') }}" aria-label="{{ __('Assign Demand Agent') }}" enctype="multipart/form-data">
                                            @csrf
                                           
                                            <br>
                                            <div class="form-group">
                                                <input type="hidden" id="demandID" name="demandID" value="">
                                                <input type="datetime-local" id="interview_datetime" name="interview_datetime">

                                                @if ($errors->has('AgentAssign'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('AgentAssign') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="form-group mb-0 text-center">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Request for Interview') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--  /.modal-dialog modal-dialog-centered  -->
                </div><!--  /.modal fade  -->
                @if($employer->employer_profile->looking_for_dm == 'yes')
                <!-- GW list for Employer -->
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">Domestic Maids</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('sendOffer')}}">
                            @csrf
                            <table id="maids-table" class="my_datatable table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Country</th>
                                        <th>Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>Status</th>
                                        <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Send Offer"></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="hide">Id</th>
                                        <th class="hide">Image</th>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Country</th>
                                        <th>Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>Status</th>
                                        <th class="hide"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                @endif
                @if($employer->employer_profile->looking_for_gw == 'yes' || $employer->employer_profile->looking_for_dm == 'yes')
                <!-- Downloads list -->
                <div class="card mt-4" id="downloads">
                    <h4 class="card-title text-center mt-3">Download files</h4>
                    <div class="card-body">
                        <table id="files-table" class="my_datatable table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="50%" title="File Title">Title</th>
                                    <th width="30%" title=""></th>
                                    <th width="20%" title="Updated">Updated</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <th title="File Title">Title</th>
                                    <th title=""></th>
                                    <th title="Updated">Updated</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                @endif
            </div><!--/.col-md-12-->
        </div>
    </div>
@endsection
@section('script')
<script>


    $(document).on("click", '.btn-interview', function (e) {
        var demandID = $(this).attr('demandID');  
        $("#demandID").attr('value', demandID);
    });

    $('#demands-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllDemands')}}',
        columns: [
            {data: 'id', name: 'id'},
            // {data: 'demand_letter_no', name: 'demand_letter_no', "className": "text-left"},
            // {data: 'company_name', name: 'company_name'},
            {data: 'preferred_country', name: 'preferred_country'}, 
            {data: 'issue_date', name: 'issue_date', "className": "text-center"},
            {data: 'expexted_date', name: 'expexted_date', "className": "text-center"},
            {data: 'demand_qty', name: 'demand_qty', "className": "text-center"},
            {data: 'proposed_qty', name: 'proposed_qty', "className": "text-center"},
            {data: 'day_pending', name: 'day_pending', "className": "text-center"},
            {data: 'confirmed_qty', name: 'confirmed_qty', "className": "text-center"},
            {data: 'final_qty', name: 'final_qty', "className": "text-center"},
            {data: 'status', name: 'status', "className": "text-center"},
            {data: 'interview_date_time', name: 'interview_date_time', "className": "text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });

    // maids table
    $('#maids-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllMaids')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'marital_status', name: 'marital_status'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: 'd-flex'}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });

    // Files table
    $('#files-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getDownloadsFile', 'emp')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"},
            {data: 'updated_at', name: 'updated_at'}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });
</script>
<script>
    $('#jobs-table').DataTable({

        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getJobsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'positions_name', name: 'positions_name'},
            {data: 'worker_type', name: 'worker_type'},
            {data: 'total_number_of_vacancies', name: 'total_number_of_vacancies'},
            {data: 'closing_date', name: 'closing_date'},
            {data: 'job_vacancies_type', name: 'job_vacancies_type'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });
</script>
<script>
    $('#resume-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('employer.getProfessionalsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'profile_image', name: 'profile_image'},
            {data: 'name', name: 'name'},
            {data: 'age', name: 'age'},
            {data: 'education', name: 'education'},
            {data: 'position', name: 'position'},
            {data: 'city', name: 'city'},
            {data: 'action', name: 'action', orderable: false, searchable: false, class: 'd-flex'}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Domestic Maids Registered","Domestic Maids Hired", "General Workers Registered","General Workers Hired"],
            datasets: [{
                label: '',
                data: [856,330, 725,295],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.5)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            legend: { 
                display: false 
            }
        }
    });
</script>
<script type="text/javascript">
    function KeepCount() {                    
        var inputTags = document.getElementsByName('id[]');                  
        var total = 0;

        for (var i = 0; i < inputTags.length; i++) {

            if (inputTags[i].checked) {                      
                    total = total + 1;
            }

            if (total > 1) {
                alert('Please select only 1')
                inputTags[i].checked = false;
                return false;
            }
        }
    }
</script>
@endsection