@extends('employer.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="hidefromprint mt-4 mb-3">
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    <!-- @if(Auth::user()->hasRole(['agent']))
                    <a class="btn btn-success {{$profile->license_file ? '' : 'disabled'}}" href="" onclick="printJS('{{asset('storage/'.$profile->license_file)}}');return false;">Print License</a>
                    <a class="btn btn-success {{$profile->passport_file ? '' : 'disabled'}}" href="" onclick="printJS('{{asset('storage/'.$profile->passport_file)}}');return false;">Print Passport/NIC</a>
                    @endif
                    @if(Auth::user()->hasRole(['superadministrator','agent']))
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print</a>
                    @endif -->
                </div>
                @if($data == 'license')
                    <p class="text-center">
                        @if($profile->license_file != null)
                        <img src="{{asset('storage/'.$profile->license_file)}}" alt="">
                        @else
                        No License File Found
                        @endif
                    </p>
                @elseif($data == 'passport')
                    <p class="text-center">
                        @if($profile->passport_file != null)
                        <img src="{{asset('storage/'.$profile->passport_file)}}" alt="">
                        @else
                        No Passport/NIC File Found
                        @endif
                    </p>
                @elseif($data == 'details')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">Company Information</h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th width="45%">Company Name</th>
                                            <td width="5%">:</td>
                                            <td width="50%">{{$profile->agency_registered_name ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>:</td>
                                            <td>{{$profile->agency_registered_name ? $profile->agency_address :'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>:</td>
                                            <td>{{$profile->agency_registered_name ? $profile->agency_city : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td>:</td>
                                            <td>{{$profile->agency_registered_name ? $profile->country_data->name : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Office Phone</th>
                                            <td>:</td>
                                            <td>{{ $profile->agency_registered_name ? $profile->agency_phone : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td>{{ $profile->agency_registered_name ? $profile->agency_email : 'N/A'}}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Agency Fax :</th>
                                            <td>{{$profile->agency_fax}}</td>
                                        </tr> --}}
                                        <tr>
                                            <th>License No</th>
                                            <td>:</td>
                                            <td>{{ $profile->agency_registered_name ? $profile->license_no : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>License Issue Date</th>
                                            <td>:</td>
                                            <td>{{$profile->agency_registered_name ? \Carbon\Carbon::parse($profile->license_issue_date)->format('d/m/Y') : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>License Expire Date</th>
                                            <td>:</td>
                                            <td>{{$profile->agency_registered_name ? \Carbon\Carbon::parse($profile->license_expire_date)->format('d/m/Y') : 'N/A'}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">Contact Information</h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th width="45%">First Name</th>
                                            <td width="5%">:</td>
                                            <td width="50%">{{$profile->first_name}}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Middle Name :</th>
                                            <td>{{$profile->middle_name}}</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Last Name</th>
                                            <td>:</td>
                                            <td>{{$profile->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td>:</td>
                                            <td>{{$profile->designation}}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Address:</th>
                                            <td>{{$profile->address}}</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Nationality</th>
                                            <td>:</td>
                                            <td>{{$profile->nationality_data->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Passport/NIC</th>
                                            <td>:</td>
                                            <td>{{$profile->passport}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile Number</th>
                                            <td>:</td>
                                            <td>{{$profile->contact_phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Address</th>
                                            <td>:</td>
                                            <td>{{$profile->email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row hidefromprint">
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">License</h4>
                                    <p class="text-center">
                                        @if($profile->license_file != null)
                                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$profile->license_file)}}">View License File</a>
                                        @else
                                        No License File Found
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">Passport/NIC</h4>
                                    <p class="text-center">
                                        @if($profile->passport_file != null)
                                            <a class="btn btn-sm btn-secondary mt-2" target="_blank" href="{{asset('storage/'.$profile->passport_file)}}">View Passport File</a>
                                        @else
                                        No Passport/NIC File Found
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div><!--/.card-body-->
                    </div><!--/.card-->
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection