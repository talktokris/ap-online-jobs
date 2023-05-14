@extends('layouts.app')

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
                    @if($profile->passport_file)
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.$profile->passport_file)}}');return false;">Print Passport</a>
                    @endif
                    @if($profile->medical_certificate)
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.$profile->medical_certificate)}}');return false;">Print Medical Certificate</a>
                    @endif
                    @if($profile->immigration_security_clearence)
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.$profile->immigration_security_clearence)}}');return false;">Print Immigration Security Clearence</a>
                    @endif
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print profile</a>
                </div>
            @endif
            @endauth
            <div class="col-md-4 text-center">
                <div class="card">
                    @auth
                    @if(Auth::user()->id == $profile->user->id)
                        <a href="{{route('profile.edit', $profile->id)}}" class="btn btn-primary">Edit information</a>
                    @endif
                    @endauth
                    <h1 class="card-title">{{$profile->name}}</h1>
                    <div class="card-body">
                        <img style="max-width: 100%;" class="thumbnail center-thumbnail-image" src="{{$profile->image != '' ? asset('storage/'.$profile->image) :  asset('images/dummy.jpg')}}" alt="avatar">
                        <hr>
                        <img style="max-height: 300px; max-width: 100%;" class="thumbnail center-thumbnail-image" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar_full.jpg')}}" alt="avatar">
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
                                <td>{{$profile->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth :</th>
                                <td>{{\Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y')}}</td>
                            </tr>
                            <tr>
                                <th>Age :</th>
                                {{-- <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->diffForHumans() }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years %m months')}}</td>
                            </tr>
                            <tr>
                                <th>Address :</th>
                                <td>{{$profile->address ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>District :</th>
                                <td>{{$profile->district ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>City :</th>
                                <td>{{$profile->city ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>State :</th>
                                <td>{{$profile->state ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Nationality :</th>
                                <td>{{$profile->nationality_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Gender :</th>
                                <td>{{$profile->gender_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Marital Status :</th>
                                <td>{{$profile->marital_status_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Children :</th>
                                <td>{{$profile->children ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Siblings :</th>
                                <td>{{$profile->siblings ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Religion :</th>
                                <td>{{$profile->religion_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Height :</th>
                                <td>{{$profile->height ? $profile->height . ' CM' : 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Weight :</th>
                                <td>{{$profile->weight ? $profile->weight . ' Pound': 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Father Name :</th>
                                <td>{{$profile->father_name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Mother Name :</th>
                                <td>{{$profile->mother_name ?? 'N/A'}}</td>
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
                                        <td>{{$profile->emergency_contact_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Relationship :</th>
                                        <td>{{$profile->emergency_contact_relationship ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Phone :</th>
                                        <td>{{$profile->emergency_contact_phone ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address :</th>
                                        <td>{{$profile->emergency_contact_address ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                        <h4 class="card-title text-center mt-3 text-uppercase">Passport Details</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Passport Number :</th>
                                        <td>{{$profile->passport_number ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Issue Date :</th>
                                        <td>{{\Carbon\Carbon::parse($profile->passport_issue_date)->format('d/m/Y')}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Issue Place :</th>
                                        <td>{{$profile->passport_issue_place ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Expire Date :</th>
                                        <td>{{\Carbon\Carbon::parse($profile->passport_expire_date)->format('d/m/Y')}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                        <h4 class="card-title text-center mt-3 text-uppercase">Language</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-sm">
                                    @if($language_set)
                                        @foreach($languages as $language)
                                        <tr>
                                            <th>{{$language->name}}</th>
                                            <td>{{$language_set[$language->slug]}}</td>
                                        </tr>
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
                        <h4 class="text-uppercase text-center mt-2 ">Skills</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            @if($skill_set)
                                @foreach($skills as $skill)
                                <tr>
                                    <th>{{$skill->name}}</th>
                                    <td>{{$skill_set[$skill->slug]}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
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
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection
