@extends('employer.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
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
            @auth
            @if(Auth::user()->can('print'))
            <div class="col-md-12 hidefromprint mb-3">
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    @if(!Auth::user()->hasRole('employer'))
                        <a class="btn btn-success {{$profile->passport_file ? '' : 'disabled'}}" href="" onclick="printJS('{{asset('storage/'.$profile->passport_file)}}');return false;">Print Passports</a>
                        <a class="btn btn-success {{$profile->medical_certificate ? '' : 'disabled'}}" href="" onclick="printJS('{{asset('storage/'.$profile->medical_certificate)}}');return false;">Print Medical Certificate</a>
                        <a class="btn btn-success {{$profile->immigration_security_clearence ? '' : 'disabled'}}" href="" onclick="printJS('{{asset('storage/'.$profile->immigration_security_clearence)}}');return false;">Print Immigration Security Clearence</a>
                    @endif
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print profile</a>
                </div>
            @endif
            @endauth
            <div class="col-md-12 d-none d-print-block pb-3">
               <h3 class="text-center"> Online Jobs Sdn. Bhd.</h3>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <h4 class="card-title text-center mt-3 mb-0 text-uppercase">Basic Information</h4>
                    <div class="card-body pb-0">
                        <table class="table table-striped table-sm">
                            <tr>
                                <th width="25%">Name</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$profile->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>:</td>
                                <td>{{$profile->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y') : 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>:</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->diffForHumans() }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years %m months')}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>:</td>
                                <td>{{$profile->country_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>:</td>
                                <td>{{$profile->state_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>:</td>
                                <td>{{$profile->city_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>:</td>
                                <td>{{$profile->district ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>:</td>
                                <td>{{$profile->address ?? 'N/A'}}</td>
                            </tr>
                          
                         
                           
                            <tr>
                                <th>Nationality</th>
                                <td>:</td>
                                <td>{{$profile->nationality_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>:</td>
                                <td>{{$profile->gender_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Marital Status</th>
                                <td>:</td>
                                <td>{{$profile->marital_status_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Children</th>
                                <td>:</td>
                                <td>{{$profile->children ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Siblings</th>
                                <td>:</td>
                                <td>{{$profile->siblings ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Religion</th>
                                <td>:</td>
                                <td>{{$profile->religion_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Height</th>
                                <td>:</td>
                                <td>{{$profile->height ? $profile->height . ' CM' : 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td>:</td>
                                <td>{{$profile->weight ? $profile->weight . ' Kg': 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Father Name</th>
                                <td>:</td>
                                <td>{{$profile->father_name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Mother Name</th>
                                <td>:</td>
                                <td>{{$profile->mother_name ?? 'N/A'}}</td>
                            </tr>
                            @if($profile->user->hasRole('worker'))
                            <tr>
                                <th>Sector</th>
                                <td>:</td>
                                <td>{{$profile->sector()->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Sub Sector</th>
                                <td>:</td>
                                <td>{{$profile->sub_sector()->name ?? 'N/A'}}</td>
                            </tr>
                            @endif
                        </table>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
            </div><!--/.col-md-8-->
            <div class="col-md-5 text-center">
                <div class="card">
                    @auth
                    @if(Auth::user()->id == $profile->user->id)
                        <a href="{{route('profile.edit', $profile->id)}}" class="btn btn-primary">Edit information</a>
                    @endif
                    @endauth
                    <h4 class="card-title text-center mt-3 text-uppercase">{{$profile->name}}</h4>
                    <div class="card-body">
                        <img style="width: 100%;" class="thumbnail center-thumbnail-image" src="{{$profile->image != '' ? asset('storage/'.$profile->image) :  asset('images/dummy.jpg')}}" alt="avatar">
                    </div>
                </div>
            </div>
            @if(!Auth::user()->hasRole('employer'))
            <div class="col-md-12 mt-2">
                <div class="card">
                        <h4 class="card-title text-center mb-0 mt-3 text-uppercase">Emergency Contact</h4>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="45%">Emergency Contact Name</th>
                                        <td width="5%">:</td>
                                        <td width="50%">{{$profile->emergency_contact_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Relationship</th>
                                        <td>:</td>
                                        <td>{{$profile->emergency_contact_relationship ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="25%">Phone</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$profile->emergency_contact_phone ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>:</td>
                                        <td>{{$profile->emergency_contact_address ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-12 mt-2">
                <div class="card">
                        <h4 class="card-title text-center mt-3 mb-0 text-uppercase">Passport Details</h4>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="45%">Passport Number</th>
                                        <td width="5%">:</td>
                                        <td width="50%">{{$profile->passport_number ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Issue Date</th>
                                        <td>:</td>
                                        <td>{{$profile->passport_issue_date ? \Carbon\Carbon::parse($profile->passport_issue_date)->format('d/m/Y') : 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="25%">Issue Place</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$profile->passport_issue_place ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Expire Date</th>
                                        <td>:</td>
                                        <td>{{$profile->passport_expire_date ? \Carbon\Carbon::parse($profile->passport_expire_date)->format('d/m/Y') : 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                        <h4 class="card-title text-center mt-3 mb-0 text-uppercase">Language</h4>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-sm">
                                    @if($language_set)
                                        @foreach($languages as $language)
                                        @if(isset($language_set[$language->slug]) && $language_set[$language->slug] == 'Yes')
                                            <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$language->name}}</span>
                                        @endif
                                        {{-- <tr>
                                            <th width="50%">{{$language->name}}</th>
                                            <td width="50%">{{$language_set[$language->slug] ?? 'no'}}</td>
                                        </tr> --}}
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="text-uppercase text-center mt-2 mb-0 ">Skills</h4>
                    </div>
                    <div class="card-body pb-0">
                            @if($skill_set)
                                @foreach($skills as $skill)
                                @if(isset($skill_set[$skill->slug]) && $skill_set[$skill->slug] == 'Yes')
                                    <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$skill->name}}</span>
                                @endif
                                {{-- {{$skill_set[$skill->slug] == 'yes' ? $skill->name}} --}}
                                {{-- <tr>
                                    <th width="50%">{{$skill->name}}</th>
                                    <td width="50%">{{$skill_set[$skill->slug] ?? 'no'}}</td>
                                </tr> --}}
                                @endforeach
                            @endif
                            @php
                                $other_skills_array = explode(",",$profile->other_skills);
                            @endphp
                            @foreach ($other_skills_array as $other_skill)
                            <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$other_skill}}</span>
                            @endforeach
                    </div>
                </div>
            </div>
            <!-- do and don't added for domestic maid by milesh 3/26/2020 -->
            @if($profile->user->hasRole('maid'))
                <div class="col-md-12 mt-2">
                    <div class="card">
                            <h4 class="card-title text-center mt-3 mb-0 text-uppercase">Do and Don't</h4>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-sm">
                                        @if($do_dont_set)
                                            @foreach($do_donts as $do_dont)
                                            @if(isset($do_dont_set[$do_dont->slug]) && $do_dont_set[$do_dont->slug] == 'Yes')
                                                <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$do_dont->name}}</span>
                                            @endif
                                            {{-- <tr>
                                                <th width="50%">{{$do_dont->name}}</th>
                                                <td width="50%">{{$do_dont_set[$do_dont->slug] ?? 'no'}}</td>
                                            </tr> --}}
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end 3/26/2020 -->
            @if($educations->count() > 0)
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="text-uppercase text-center mt-2">Education</h4>
                    </div>
                    <div class="card-body pb-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="45%">Education Level</th>
                                    <th width="50%">Education Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($educations as $education)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$education->education_level_data->name ?? ''}}</td>
                                    <td>{{$education->education_remark}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            @if($experiences->count() > 0)
            <div class="col-md-12 mt-2 mb-2">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="text-uppercase text-center mt-2">Work Experience</h4>
                    </div>
                    <div class="card-body ">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Employer Name</th>
                                    <th width="15%">Country</th>
                                    <th width="15%">From</th>
                                    <th width="15%">To</th>
                                    <th width="30%">Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($experiences as $experience)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$experience->employer_name}}</td>
                                    <td>{{$experience->country_data->name ?? ''}}</td>
                                    <td>{{\Carbon\Carbon::parse($experience->from_date)->format('d/m/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($experience->to_date)->format('d/m/Y')}}</td>
                                    <td>{{$experience->remark}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-12">
                    <img class="rounded mx-auto d-block" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar_full.jpg')}}" alt="avatar">
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
