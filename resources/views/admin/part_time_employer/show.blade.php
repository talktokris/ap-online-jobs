@extends('employer.app')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="hidefromprint mt-4 mb-3">
                    @if(Auth::user()->hasRole(['superadministrator','employer']))
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print</a>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title text-center mt-3">Part Time Employer Information</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th width="35%">First Name</th>
                                        <th width="5%">:</th>
                                        <td width="60%">{{$employer->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>:</th>
                                        <td>{{$employer->last_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <th>:</th>
                                        <td>{{$employer->phone ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>email</th>
                                        <th>:</th>
                                        <td>{{$employer->email ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <th>:</th>
                                        <td>Malaysia</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <th>:</th>
                                        <td>{{$employer->stateName->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <th>:</th>
                                        <td>{{$employer->cityName->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <th>:</th>
                                        <td>{{$employer->address ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>nric</th>
                                        <th>:</th>
                                        <td>{{$employer->nric ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Looking For Maid</th>
                                        <th>:</th>
                                        <td>
                                            @if($employer->looking_for_maid=='1')
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Looking For Driver</th>
                                        <th>:</th>
                                        <td>
                                            @if($employer->looking_for_driver=='1')
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Looking For Home Nurse</th>
                                        <th>:</th>
                                        <td>
                                            @if($employer->looking_for_home_nurse=='1')
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>service_time</th>
                                        <th>:</th>
                                        <td>{{$employer->service_time ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>service_type</th>
                                        <th>:</th>
                                        <td>{{$employer->service_type ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>service_task</th>
                                        <th>:</th>
                                        <td>{{$employer->service_task ?? 'N/A'}}</td>
                                    </tr>
                                   
                                </table>
                            </div>
                        </div>
                    </div><!--/.card-body-->
                </div><!--/.card-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection