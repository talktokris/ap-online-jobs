@extends('employer.app')

@section('content')


<div class="container mt-4 mb-5">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            {{-- <img class="rounded-circle" style="width: 75px; height:75px;" src="http://localhost:8076/images/dummy.jpg"> --}}
                        </div>
                        <div class="col-md-12">
                            <h4 class="mb-0">{{$job->user->name ?? 'N/A'}}
                                                            </h4>
                            <p><strong><em>{{$job->job_seeker_job_category_data->name ?? 'N/A'}}</em></strong></p>
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i>{{$job->town ?? 'N/A'}}, {{$job->district ?? 'N/A'}}, {{$job->state ?? 'N/A'}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-briefcase" aria-hidden="true"></i> {{$job->telephone_number}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-money" aria-hidden="true"></i>{{$job->salary_offer_currency ?? 'N/A'}} {{$job->salary_offer ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-5">
                                <p class="mb-0"><i class="mr-2 fa fa-phone" aria-hidden="true"></i> {{$job->handphone_number ?? 'N/A'}}</p>
                                            <p class="mb-0"><i class="mr-2 fa fa-envelope-o" aria-hidden="true"></i> {{$job->email ?? 'N/A'}}</p>
                                    </div>
                                <div class="col-md-2">
                                {{$job->closing_date ?? 'Any'}} Closing date
                                    {{-- <p class="mb-0 bg-light text-center rounded text-uppercase text-primary">Verify</p>
                                    <p class="mb-0 text-right"><i class="fa-lg fa fa-check-circle-o" aria-hidden="true"></i></p> --}}
                                </div>
                                </div>
                            {{-- <div class="row mt-2">
                                <div class="col-md-12">
                                    <span>Profile Strength (Good)</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>                          
                                </div>
                            </div> --}}

                        </div>
                        {{-- <div class="col-md-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <p class="mb-0 font-weight-bold">Tips for getting noticed by recruiters</p>
                                    <p class="mb-0"><small>- Attach updated Resume</small></p>
                                    <p class="mb-0"><small>- Keep profile &amp; contact details updated</small></p>
                                    <p class="mb-0"><small>- Make your resume headline stand out</small></p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h3><i class="fa fa-briefcase" aria-hidden="true"></i> Experience</h3>
                        <p>{{$job->related_experience_year ?? 'N/A'}} Years of total experience</p>
                    </div>
                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Minimum Education Qualification</h3>
                        <p>{{$job->minimum_academic_qualification ?? 'N/A'}} </p>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Academic</h3>
                        <p>{{$job->academic_field ?? 'N/A'}} </p>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Vacency Description</h3>
                        <p>{{$job->vacancies_description ?? 'N/A'}} </p>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Scope Of Duties</h3>
                        <p>{{$job->scope_of_duties ?? 'N/A'}} </p>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Other Requirement</h3>
                        <p>{{$job->other_requirements ?? 'N/A'}} </p>
                    </div>
                    <div class="mt-5">
                        <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Facilities</h3>
                        <p>{{$job->facilities ?? 'N/A'}} </p>
                    </div>

                    <div class="mt-5">
                        <h3><i class="fa fa-tasks" aria-hidden="true"></i>Other Skills </h3>
                    <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$job->other_skills ?? 'N/A'}}</span>
                    </div>
                    {{-- <div class="mt-5">
                        <h3><i class="fa fa-th-list" aria-hidden="true"></i> IT Skills</h3>
                        <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary"></span>
                    </div> --}}
                    {{-- <div class="mt-5">
                        <h3><i class="fa fa-bars" aria-hidden="true"></i> Additional Info</h3>
                        <div class="row mb-3"> --}}
                            {{-- @if($job->languages!='')
                            @foreach ($job->languages as $list ) --}}
                                {{-- <div class="col-md-3">
                                    <p class="mb-0">Speaking :</p>
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-0">{{$job->languages->speaking ?? 'N/A'}}</p>
                                </div>

                                <div class="col-md-3">
                                    <p class="mb-0">Writing :</p>
                                </div>
                                <div class="col-md-9">
                                    <p class="mb-0">{{$job->languages->writing ?? 'N/A'}}</p>
                                </div> --}}
                            {{-- @endforeach
                            @endif --}}
                        {{-- </div>
                    </div> --}}

                    <div class="mt-5">
                        <h3><i class="fa fa-bars" aria-hidden="true"></i> Additional Info</h3>
                        <div class="row mb-3">

                            <div class="col-md-3">
                                <p class="mb-0">Post Code :</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$job->postcode ?? 'N/A'}}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-0">Gender :</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$job->gender ?? 'N/A'}}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-0">Marital Status :</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$job->marital_status ?? 'N/A'}}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-0">Race :</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$job->race ?? 'N/A'}}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-0">Age Eligibility :</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$job->age_eligibillity ?? 'N/A'}}</p>
                            </div>

                            <div class="col-md-3">
                                <p class="mb-0">Salary offer Period :</p>
                            </div>
                            <div class="col-md-9">
                                <p class="mb-0">{{$job->salary_offer_period ?? 'N/A'}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection