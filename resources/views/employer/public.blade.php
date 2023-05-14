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
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <h1>{{$employer->name}}</h1> --}}
                                <p>Offer Sent: {{$employer->employer_profile->offers->count() }} <br/> Hired: {{$employer->employer_profile->hireCount() }}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Address</strong><br/>
                                <span>{{$employer->employer_profile->company_country_data->name ?? 'N/A'}}</span><br/>
                                <span>{{$employer->employer_profile->company_city_data->name ?? ''}}, {{$employer->employer_profile->company_state_data->name ?? ''}}</span><br/>
                                <span>{{$employer->employer_profile->company_address ?? 'N/A'}}</span><br/>
                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title text-center mt-3">Contact Information</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th width="35%">Employer Name</th>
                                        <th width="5%">:</th>
                                        <td width="60%">{{$employer->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact Email </th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->contact_email ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>NRIC </th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->nric ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <th>:</th>
                                        <td>{{$employer->phone ?? 'N/A'}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Employer Address</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->address ?? 'N/A'}}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Employer Country</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->country_data->name ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title text-center mt-3">Company Information</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th width="35%">Company Name</th>
                                        <th width="5%">:</th>
                                        <td width="60%">{{$employer->employer_profile->company_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Registration Number</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->roc ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Company Email</th>
                                        <th>:</th>
                                        <td>{{$employer->email ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Website</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->website ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone number</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->company_phone ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Company Address</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->company_address ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Postcode</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->postcode ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->company_country_data->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->company_state_data->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <th>:</th>
                                        <td>{{$employer->employer_profile->company_city_data->name ?? 'N/A'}}</td>
                                    </tr>
                                   
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="card-title text-center mt-3">Work Place/Company Image</h4>
                                <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->work_place_img != '' ? asset('storage/'.$employer->employer_profile->work_place_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                            </div>   
                            
                            <div class="col-md-3">
                                <h4 class="card-title text-center mt-3">Image of Nature of work</h4>
                                <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->nature_of_work_img != '' ? asset('storage/'.$employer->employer_profile->nature_of_work_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                            </div>
                            
                            <div class="col-md-3">
                                <h4 class="card-title text-center mt-3">Picture of Hostel</h4>
                                <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->hostel_img != '' ? asset('storage/'.$employer->employer_profile->hostel_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
                            </div>
                            
                            <div class="col-md-3">
                                <h4 class="card-title text-center mt-3">Product of Company</h4>
                                <img id="image_preview" style="width: 200px;" src="{{$employer->employer_profile->product_of_company_img != '' ? asset('storage/'.$employer->employer_profile->product_of_company_img) :  asset('images/avatar.jpg')}}" class="img-thumbnail" height="">
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