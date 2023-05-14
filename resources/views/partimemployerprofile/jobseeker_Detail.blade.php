@extends('partimemployerprofile.index')
@section('partimemployerprofiles')
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
                    
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print profile</a>
                </div>
            @endif
            @endauth
            <div class="col-md-4 text-center">
                <div class="card">
                    @auth
                   
                    @endauth
                    <h1 class="card-title">{{$user->name}}</h1>
                    <div class="card-body">
                        <img style="max-width: 100%;" class="thumbnail center-thumbnail-image" src="{{$maid->image != '' ? asset('storage/'.$maid->image) :  asset('images/dummy.jpg')}}" alt="avatar">
                        <hr>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-title text-center mt-3 text-uppercase">Basic Information</h4>
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            <tr>
                                <th>Name :</th>
                                <td>{{$user->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Id Number :</th>
                                <td>{{$maid->id_number ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth :</th>
                                <td>{{$maid->date_of_birth ?? 'N/A'}}</td>
                                <!-- <td>{{\Carbon\Carbon::parse($maid->date_of_birth)->format('d/m/Y') ?? 'N/A'}}</td> -->
                            </tr>
                            <tr>
                                <th>Age :</th>
                                {{-- <td>{{ \Carbon\Carbon::parse($maid->date_of_birth)->diffForHumans() }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($maid->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years %m months')}}</td>
                            </tr>

                            <tr>
                                <th>Work As :</th>
                                @if($maid->work_as=='1')
                                <td>Maid</td>
                                @elseif($maid->work_as=='2')
                                <td>Driver</td>
                                @elseif($maid->work_as=='3')
                                <td>Home Nurse</td>
                                @else
                                <td>N0 Data</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Nationality :</th>
                                <td>{{$maid->nationality_data->name ?? 'Malaysia'}}</td>
                            </tr>
                            <tr>
                                <th>State :</th>
                                <td>{{$maid->company_state_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>City :</th>
                                <td>{{$maid->company_city_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>District :</th>
                                <td>{{$maid->district ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Address :</th>
                                <td>{{$maid->address ?? 'N/A'}}</td>
                            </tr>                           
                            <tr>
                                <th>Gender :</th>
                                <td>{{$maid->gender_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Marital Status :</th>
                                <td>{{$maid->marital_status_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Children :</th>
                                <td>{{$maid->children ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Siblings :</th>
                                <td>{{$maid->siblings ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Religion :</th>
                                <td>{{$maid->religion_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Height :</th>
                                <td>{{$maid->height ? $maid->height . ' CM' : 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Weight :</th>
                                <td>{{$maid->weight ? $maid->weight . ' Kg': 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Father Name :</th>
                                <td>{{$maid->father_name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Mother Name :</th>
                                <td>{{$maid->mother_name ?? 'N/A'}}</td>
                            </tr>
                        </table>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
            </div><!--/.col-md-8-->
            <div class="col-md-12 mt-2">
                <div class="card">
                        <h4 class="card-title text-center mt-3 text-uppercase">Emergency Contact</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Emergency Contact Name :</th>
                                        <td>{{$maid->emergency_contact_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Relationship :</th>
                                        <td>{{$maid->emergency_contact_relationship ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    {{-- <tr>
                                        <th>Phone :</th>
                                        <td>{{$maid->emergency_contact_phone ?? 'N/A'}}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Address :</th>
                                        <td>{{$maid->emergency_contact_address ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
           
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="text-uppercase text-center mt-2">Education</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Education Level</th>
                                    <th>Education Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($educations as $education)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$education->education_level_data->name}}</td>
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
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="text-uppercase text-center mt-2">Work Experience</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Country</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Remark</th>
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
                                $other_skills_array = explode(",",$maid->other_skills);
                            @endphp
                            @foreach ($other_skills_array as $other_skill)
                            <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$other_skill}}</span>
                            @endforeach
                    </div>
                </div>
            </div>
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
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
