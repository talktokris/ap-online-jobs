@extends('employer.app')

@section('content')
<div class="container mt-3">
    @auth
    @if(Auth::user()->hasRole('employer'))
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card mt-4">
                <h4 class="card-title text-center mt-3">
                    Applied/Suggested Jobseekers <a target="_blank" href="{{route('availableJobseekers', $job->id)}}" class="btn btn-xs btn-info">View all available Resume</a>
                </h4>
                <div class="card-body">
                    <form method="post" action="{{route('inviteProfessional', $job->id)}}">
                    @csrf
                    <table id="resume-table" class="my_datatable table table-condensed">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="hide">Image</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Education</th>
                                <th>Position</th>
                                <th>City</th>
                                <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Select For Interview"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($applicants) --}}
                            @foreach($applicants as $applicant)
                            <tr>
                                <td></td>
                                @if($applicant->jobseeker->professional_profile['profile_image'])
                                <td><img src="{{$applicant->jobseeker->professional_profile['profile_image']}}" border="0" width="40" class="img-rounded" align="center" /></td>
                                @else
                                <td><img src="{{asset('images/dummy.jpg')}}" border="0" width="40" class="img-rounded" align="center" /></td>
                                @endif
                                <td>{{ $applicant->jobseeker->name}}</td>
                                <td>{{ $applicant->jobseeker->professional_profile->age()}}</td>
                                {{-- <td>{{ $applicant->jobseeker->professional_profile->highest_qualification}}</td> --}}
                                <td>
                                    @foreach ($qualification as $list )
                                    @if($list->user_id==$applicant->jobseeker->professional_profile->user_id)
                                    {{$list->qualification}}
                                    @endif
                                    @endforeach
                                </td>
                                <td>{{ $applicant->jobseeker->professional_profile->job_seeker_job_category_data->name}}</td>
                                <td>{{ $applicant->jobseeker->professional_profile->job_seeker_city_data->name}}</td>
                                <td>
                                    @if($applicant->invited_by_employer == 1)
                                        <span class="bade badge-success p-1">Selected For Interview</span>
                                        <a class="bade badge-primary p-1" href="{{route('professional.accepted.interview',$applicant->jobseeker->id)}}" onclick="return confirm(\'Are you sure?\')">Accepted</a>
                                        <a class="bade badge-danger p-1" href="{{route('professional.rejected.interview',$applicant->jobseeker->id)}}" onclick="return confirm(\'Are you sure?\')">Rejected</a>
                                        {{-- <span class="bade badge-primary p-1">Accepted</span>
                                        <span class="bade badge-danger p-1">Rejected</span> --}}
                                    @elseif($applicant->invited_by_employer == 2)
                                    <span class="bade badge-primary p-1">Selected In Interview</span>
                                    @elseif($applicant->invited_by_employer ==3)
                                    <span class="bade badge-danger p-1">Rejected In Interview</span>
                                    @else
                                        @if($applicant->suggested_by_admin == true)
                                            <span class="bade badge-warning p-1">Suggested By Admin</span>
                                        @elseif($applicant->applied_by_jobseeker == true)
                                            <span class="bade badge-info p-1">Applied by Jobseeker</span>
                                        @endif
                                        <a href="{{route('professional.show', $applicant->jobseeker->id)}}" class="btn btn-sm btn-primary">View</a>
                                        <input class="ml-1" type="checkbox" name="ids[]" value="{{$applicant->jobseeker->id}}">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endauth
    <div class="row">
        @auth
        @if(Auth::user()->hasRole('employer') || Auth::user()->hasRole('superadministrator'))
        <div class="col-md-3">
            <img class="img-fluid" src="{{asset('storage/'.$job->company()->company_logo)}}" alt="">
        </div>
        @endif
        @endauth
        <div class="col-md-5">
            <ul>
                <li class="font-18">
                    <h5 class="font-22">
                        <!-- {{$job->positions_name}}  -->
                        {{$job->job_seeker_job_category_data->name}}
                        @auth
                        @if(Auth::user()->hasRole('employer')) <a href="{{route('job.edit', $job->id)}}">Edit</a> @endif
                        @endauth
                    </h5>
                </li>
                @auth
                @if(Auth::user()->hasRole('employer') || Auth::user()->hasRole('superadministrator'))
                    <li class="font-18">{{$job->company()->company_name ?? 'N/A'}}</li>
                @endif
                @endauth
                <li class="font-18">{{$job->district ? $job->district . ',' : ''}} {{$job->town ? $job->town . ',' : ''}} {{$job->state ? $job->state . ',': ''}} {{$job->postcode}}</li>
                <li class="font-18">{{$job->related_experience_year ?? 'N/A'}} Year Experience</li>
                <li class="font-18">{{$job->total_number_of_vacancies ?? 'N/A'}} Vacancies</li>
                <li class="font-18">Gender: {{$job->gender ?? 'N/A'}}</li>
                <li class="font-18">Marital Status: {{$job->marital_status ?? 'N/A'}}</li>
                <li class="font-18">Race: {{$job->race ?? 'N/A'}}</li>
                <li class="font-18">Age Eligibility: {{$job->age_eligibillity ?? 'N/A'}}</li>
            </ul>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <p class=" my-0 ">Offered Salary</p>
                <p class=" my-0 font-weight-bold">{{$job->salary_offer_currency}} {{$job->salary_offer}} {{$job->salary_offer_period}}</p>
            </div>
            <div>
                <p class=" my-0 ">Type Position</p>
                <p class=" my-0 font-weight-bold">{{$job->job_vacancies_type ?? 'N/A'}}</p>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <p class="mb-0"><strong>Vacancies Description </strong></p>
            <div>
                {{$job->vacancies_description ?? 'N/A'}}
            </div>
        </div>
    </div>
    <div class="row mt-3 d-flex align-items-end">
        <div class="col-md-7">
            <div class="pr-5">
                <p class="mb-0"><strong>Scope of Duties </strong></p>
                <div>
                    {{$job->scope_of_duties ?? 'N/A'}}
                </div>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Academic Qualification</strong></p>

                <p class="mb-0">- {{$job->minimum_academic_qualification}} {{$job->academic_field}}</p>
                @foreach ($job->academics as $academic)
                <p class="mb-0">- {{$academic->academic_qualification}} {{$academic->academic_field}}</p>
                @endforeach
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Required Skills</strong></p>
                <p class="mb-0">{{$job->skills ?? 'N/A'}}</p>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Other Requirements</strong></p>
                <p class="mb-0">{{$job->other_requirements ?? 'N/A'}}</p>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Facilities</strong></p>
                <p class="mb-0">{{$job->facilities ?? 'N/A'}} {{ $job->other_facilities ? ', ' . $job->other_facilities : '' }}</p>
            </div>
            <div class="mt-2">
                <p class="mb-0"><strong>Language</strong></p>
                @if(!empty($job->languages))
                @foreach ($job->languages as $language)
                    <div class="mb-2">
                        <p class="mb-0">{{$language->language_data->name??'N/A'}}</p>
                        <p class="mb-0"><strong>Speaking: </strong> {{$language->speaking??'N/A'}}, <strong>Writing: </strong>{{$language->writing??'N/A'}}</strong></p>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-5 text-right">
            <p class="mb-0">Closing Date</p>
            @if($job->closing_date!='')
            <p class="mb-0"><strong>{{\Carbon\Carbon::parse($job->closing_date)->format('d/m/Y')}}</strong></p>
            @else
            <p class="mb-0"><strong>N/A</strong></p>
            @endif
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
            @guest
            <p class="text-center"><a class="btn btn-success" href="{{route('login')}}">Apply Online</a></p>
            @endguest
            @auth
                @if(Auth::user()->hasRole('professional'))
                    <p class="text-center"><a class="btn btn-success" href="{{route('applyOnline', $job->id)}}">Apply Online</a></p>
                @endif
            @endauth
            {{-- <p class="text-center mb-0">Company Name: {{$job->company()->company_name}}</p> --}}
            <p class="text-center mb-0">{{$job->district ? $job->district . ',': ''}} {{$job->town ? $job->town . ',' : ''}} {{$job->state ? $job->state . ',' : '' }} {{$job->postcode}}</p>
            {{-- <p class="text-center mb-0">{{$job->person_in_charge}}</p> --}}
            {{-- <p class="text-center mb-0">{{$job->telephone_number}}, {{$job->handphone_number}}</p> --}}
            {{-- <p class="text-center mb-0">{{$job->email}}</p> --}}
        </div>
    </div>
</div>
@endsection
