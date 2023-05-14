@extends('employer.app')

@section('content')


<div class="container mt-4 mb-5">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img class="rounded-circle" style="width: 75px; height:75px;" src="{{$user->profile_image != '' ? asset('storage/resume/'.$user->profile_image) :  asset('images/dummy.jpg')}}">
                        </div>
                        <div class="col-md-8">
                            @if($user!='')
                            <h4 class="mb-0">{{$user->full_name}}
                            </h4>
                            @endif
                            <p><strong><em>{{$user->job_seeker_job_category_data->name ?? 'N/A'}}</em></strong></p>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i>{{$user->city->name ?? 'N/A'}}, {{$user->state->name ?? 'N/A'}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-briefcase" aria-hidden="true"></i> {{$user->nric ?? 'N/A'}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-money" aria-hidden="true"></i> {{$user->expected_salary ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-5">
                                    @auth
                                        @if(Auth::user()->hasRole('superadministrator|administrator'))
                                            @if($user!='')
                                            <p class="mb-0"><i class="mr-2 fa fa-phone" aria-hidden="true"></i> {{$user->number ?? 'N/A'}}</p>
                                            <p class="mb-0"><i class="mr-2 fa fa-envelope-o" aria-hidden="true"></i> {{$user->email?? 'N/A'}}</p>
                                            @endif
                                        @endif
                                    @endauth
                                </div>
                            </div>

                            @auth
                            @if(Auth::user()->hasRole('superadministrator|administrator'))
                            @if($user!='')
                            @if($user->resume_file)
                                <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->resume_file)}}">View Resume</a>
                            @endif
                            @if($user->modified_resume_file)
                                <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->modified_resume_file)}}">View Modified Resume</a>
                            @endif
                            @endif
                            @endif
                            @endauth
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
                        </h3>
                        {{-- <p>{{$totalExperience}} Years of total experience</p> --}}
                        @if($user!='')
                        @if($user->count() > 0)
                            @foreach($user->blue_worker_experience as $experience)
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <p class="mb-0">{{\Carbon\Carbon::parse($experience->from)->format('M Y') }} - {{ $experience->to ? \Carbon\Carbon::parse($experience->to)->format('M Y') : 'Present' }}</p>
                                    {{-- <p class="mb-0"><small>{{$experience->experienceLength()}}</small></p> --}}
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-0 font-20 font-weight-bold">{{$experience->designation}}</p>
                                    <p class="mb-0 font-20">{{$experience->company}}</p>

                                    <table class="table table-borderless table-sm">
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
                        </h3>
                        @if($user!='')
                        @foreach($user->blue_worker_education as $qualification)
                        <div class="row mb-3">
                            {{-- <div class="col-md-3">
                                <p class="mb-0">{{\Carbon\Carbon::parse($qualification->graduation_date)->format('M Y') }}</p>
                            </div> --}}
                            <div class="col-md-9">
                                <p class="mb-0 font-20 font-weight-bold">{{$qualification->education_level_data->name}}</p>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <th class="pl-0" width="25%">Description</th>
                                        <td width="5%">:</td>
                                        <td width="70%">{{$qualification->education_remark}}</td>
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
                            $skills = explode(",",$user->skills);
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
                            $it_skills = explode(",",$user->it_skills);
                        @endphp
                        @foreach ($it_skills as $it_skill)
                        <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$it_skill}}</span>
                        @endforeach
                        @endif
                    </div>
                    <div class="mt-5">

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="mb-0">Expected Salary</p>
                            </div>
                            @if($user!='')
                            <div class="col-md-9">
                                <p class="mb-0">{{$user->expected_salary ? 'RM' :''}} {{$user->expected_salary??'N/A'}}</p>
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