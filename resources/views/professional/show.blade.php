@extends('employer.app')

@section('content')


<div class="container mt-4 mb-5">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            @if($user!='')
                            <!-- <img class="rounded-circle" style="width: 75px; height:75px;" src="{{$user->professional_profile->profile_image != '' ? asset('storage/resume/'.$user->professional_profile->profile_image) :  asset('images/dummy.jpg')}}"> -->
                            @endif
                        </div>
                        <div class="col-md-8">
                            @if($user!='')
                            <h4 class="mb-0">{{$user->name.' ' .$user->last_name}}
                                @if(Auth::id() == $user->id)
                                    <a class="text-white" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            @endif
                            <p><strong><em>{{$user->professional_profile->job_seeker_job_category_data->name ?? 'N/A'}}</em></strong></p>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i>{{$user->professional_profile->job_seeker_city_data->name ?? 'N/A'}}, {{$user->professional_profile->job_seeker_state_data->name ?? 'N/A'}}, {{$user->professional_profile->job_seeker_country_data->name ?? 'N/A'}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-briefcase" aria-hidden="true"></i> {{$user->professional_profile->nric ?? 'N/A'}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-money" aria-hidden="true"></i> {{$user->professional_profile->expected_salary ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-5">
                                    @auth
                                        @if(Auth::user()->hasRole('superadministrator|administrator') || Auth::user()->hasRole('professional'))
                                            @if($user!='')
                                            <p class="mb-0"><i class="mr-2 fa fa-phone" aria-hidden="true"></i> {{$user->professional_profile->phone}}</p>
                                            <p class="mb-0"><i class="mr-2 fa fa-envelope-o" aria-hidden="true"></i> {{$user->professional_profile->email}}</p>
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                                @if($user!='')
                                <!-- <div class="col-md-2">
                                    {{$user->professional_profile->age()}} Years Old
                                    <p class="mb-0 bg-light text-center rounded text-uppercase text-primary">Verify</p>
                                    <p class="mb-0 text-right"><i class="fa-lg fa fa-check-circle-o" aria-hidden="true"></i></i></p>
                                </div> -->
                                @endif
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <span>Profile Strength (Good)</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>                          
                                </div>
                            </div>

                            @auth
                                @if(Auth::user()->hasRole('superadministrator|administrator') || Auth::user()->hasRole('professional'))
                                    @if($user!='')
                                        @if($user->professional_profile->resume_file)
                                            <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->resume_file)}}">View Resume</a>
                                        @endif
                                        @if($user->professional_profile->modified_resume_file)
                                            <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->modified_resume_file)}}">View Modified Resume</a>
                                        @endif
                                    @endif
                                @endif
                                @if(Auth::user()->hasRole('employer'))
                                    @if($user!='')
                                        @if($user->professional_profile->modified_resume_file)
                                            <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->modified_resume_file)}}">View Resume</a>
                                        @endif
                                    @endif
                                @endif
                            @endauth
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <p class="mb-0 font-weight-bold">Tips for getting noticed by recruiters</p>
                                    <p class="mb-0"><small>- Attach updated Resume</small></p>
                                    <p class="mb-0"><small>- Keep profile & contact details updated</small></p>
                                    <p class="mb-0"><small>- Make your resume headline stand out</small></p>
                                </div>
                            </div>
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
                            @if($user!='')
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('professionalExperience.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @endif
                        </h3>
                        <p>{{$totalExperience}} Years of total experience</p>
                        @if($user!='')
                        @if($user->professional_experiences->count() > 0)
                            @foreach($user->professional_experiences as $experience)
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <p class="mb-0">{{\Carbon\Carbon::parse($experience->from)->format('M Y') }} - {{ $experience->to ? \Carbon\Carbon::parse($experience->to)->format('M Y') : 'Present' }}</p>
                                    <p class="mb-0"><small>{{$experience->experienceLength()}}</small></p>
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-0 font-20 font-weight-bold">{{$experience->designation}}</p>
                                    <p class="mb-0 font-20">{{$experience->company}}</p>
                                    <p class="mb-0">{{$experience->work_description}}</p>

                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <th class="pl-0" width="25%">Position Level</th>
                                            <td width="5%">:</td>
                                            <td width="70%">{{$experience->position_level}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pl-0" width="25%">Experience Description</th>
                                            <td width="5%">:</td>
                                            <td width="70%">{{$experience->experience_description}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        @endif
                    </div>
                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i> Education
                            @if($user!='')
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('qualification.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @endif
                        </h3>
                        @if($user!='')
                        @foreach($user->qualifications as $qualification)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="mb-0">{{\Carbon\Carbon::parse($qualification->graduation_date)->format('M Y') }}</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0 font-20 font-weight-bold">{{$qualification->university}}</p>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <th class="pl-0" width="25%">Qualification</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$qualification->qualification}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0" width="25%">Field of Study</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$qualification->subject}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0" width="25%">Specialization</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$qualification->specialization}}</td>
                                    </tr>
                                    <tr>
                                        <th class="pl-0" width="25%">Others</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$qualification->others}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-tasks" aria-hidden="true"></i> Skills
                            @if($user!='')
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @endif
                        </h3>
                        @if($user!='')
                        @php
                            $skills = explode(",",$user->professional_profile->skills);
                        @endphp
                        @foreach ($skills as $skill)
                        <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$skill}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="mt-5">
                        <h3><i class="fa fa-th-list" aria-hidden="true"></i> IT Skills
                            @if($user!='')
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @endif
                        </h3>
                        @if($user!='')
                        @php
                            $it_skills = explode(",",$user->professional_profile->it_skills);
                        @endphp
                        @foreach ($it_skills as $it_skill)
                        <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$it_skill}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="mt-5">
                        <h3><i class="fa fa-bars" aria-hidden="true"></i> Additional Info
                            @if($user!='')
                            @if(Auth::id() == $user->id)
                            <a class="text-black" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @endif
                            @endif
                        </h3>

                        {{-- <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="mb-0">Current Salary</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$user->professional_profile->current_salary}}</p>
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="mb-0">Expected Salary</p>
                            </div>
                            @if($user!='')
                            <div class="col-md-9">
                                <p class="mb-0">{{$user->professional_profile->expected_salary}}</p>
                            </div>
                            @endif
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection