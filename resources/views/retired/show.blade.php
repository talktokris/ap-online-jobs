@extends('employer.app')
@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img class="rounded-circle" style="width: 75px; height:75px;" src="{{$user->retired_personnel->profile_image != '' ? asset('storage/'.$user->retired_personnel->profile_image) :  asset('images/dummy.jpg')}}">
                        </div>
                        <div class="col-md-11">
                        <!-- last name concatenate by milesh on 2/14/2020 -->
                            <h4 class="mb-0">{{$user->name.' '.$user->last_name}}      
                                @if(Auth::id() == $user->id)
                                    <a class="text-white" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            <!-- job category added by milesh on 2/18/2020 -->
                            <p><strong><em>{{$user->retired_personnel->retired_job_category_data->name}}</em></strong></p>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i> {{$user->retired_personnel->address}}</p>
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i>{{$user->retired_personnel->company_city_data->name}}, {{$user->retired_personnel->company_state_data->name}} , {{$user->retired_personnel->company_country_data->name}}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-2 fa fa-phone" aria-hidden="true"></i> {{$user->retired_personnel->phone}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-envelope-o" aria-hidden="true"></i> {{$user->retired_personnel->email}}</p>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-0 bg-light text-center rounded text-uppercase text-primary">Verify</p>
                                    <p class="mb-0 text-right"><i class="fa-lg fa fa-check-circle-o" aria-hidden="true"></i></i></p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <span>Profile Strength (Good)</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>                          
                                </div>
                            </div>
                            @if($user->retired_personnel->resume)
                                <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->retired_personnel->resume)}}">View Resume</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h3><i class="fa fa-briefcase" aria-hidden="true"></i> Experience
                            @if(Auth::id() == $user->id)
                                <a class="text-black" href="{{route('retiredPersonnelExperience.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                        </h3>
                        <p>{{$totalExperience}} Years of total experience</p>
    
                        @foreach($user->retired_personnel_experiences as $experience)
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <p class="mb-0">{{\Carbon\Carbon::parse($experience->from)->format('M Y') }} - {{\Carbon\Carbon::parse($experience->to)->format('M Y') }}</p>
                                    <p class="mb-0"><small>{{$experience->experienceLength()}}</small></p>
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-0 font-20 font-weight-bold">{{$experience->position}}</p>
                                    <p class="mb-0 font-20">{{$experience->company_name}} | {{$experience->address}}</p>
                                    <p class="mb-0"><strong>Industry:</strong> {{$experience->nature_of_company_business}}</p>
                                    <p class="mb-0"><strong>Experience Description:</strong> {{$experience->work_description}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i> Education
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                        </h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="50%">Academic Qualification</th>
                                    <th width="50%">Specialization</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <tr>
                                    <td>{{$user->retired_personnel->highest_academic_qualification ?? 'N/A'}}</td>
                                    <td>{{$user->retired_personnel->specialization ?? 'N/A'}}</td>
                                </tr>
                                @if($user->retired_personnel_educations->count() > 0)
                                    @foreach($user->retired_personnel_educations as $education)
                                    <tr>
                                        <td>{{$education->academic_qualification ?? 'N/A'}}</td>
                                        <td>{{$education->specialization ?? 'N/A'}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-language" aria-hidden="true"></i> Language
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('retiredPersonnelsLanguage.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                        </h3>
                        <p>Proficiency Level: Fluent > Good > Poor</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Language</th>
                                    <th>Spoken</th>
                                    <th>Written</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @if($user->retired_personnel_language->count() > 0)
                                    @foreach($user->retired_personnel_language as $language)
                                    <tr>
                                        <td>{{$language->language}}</td>
                                        <td>{{$language->speaking}}</td>
                                        <td>{{$language->writing}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-5">
                        <h3><i class="fa fa-medkit" aria-hidden="true"></i> Health
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                        </h3>
                        <table class="table table-sm">
                            <tr>
                                <th width="25%">Fit to work ?</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->fit_to_work}}</td>
                            </tr>
                            <tr>
                                <th width="25%">Have blood pressure ?</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->have_blood_pressure }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Have diabetes ?</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->have_diabetes }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Additional Health Information</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->additional_health_statement }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Other Info
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                        </h3>
                        <table class="table table-sm">
                            <tr>
                                <th width="25%">Were you government servent ?</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->government_employee}}</td>
                            </tr>
                            <tr>
                                <th width="25%">Department</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->govt_department}}</td>
                            </tr>
                            <tr>
                                <th width="25%">Prefer Working hours</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->full_time == 'yes' ? 'Full Time' : 'Part Time : ' . $user->retired_personnel->describe_working_hours }}</td>
                            </tr>
                            <tr>
                                <th width="25%">NRIC</th>
                                <td width="5%">:</td>
                                <td width="70%">{{$user->retired_personnel->nric }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection