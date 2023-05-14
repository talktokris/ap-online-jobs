@extends('employer.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            @auth
            @if(Auth::user()->can('print'))
                <div class="col-md-12 hidefromprint mb-3">
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print</a>
                </div>
            @endif
            @endauth
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title text-center mt-3 text-uppercase">Demand Information</h4>
                    @if(Auth::user()->hasRole('superadministrator'))
                        <p class="text-center hidefromprint"><a class="btn btn-warning btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#demandFileForAgent" href="#">Add Demand file for agent</a></p>
                    @endif
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            <tr>
                                <th width="15%">Hiring Package</th>
                                <th>:</th>
                                <td width="25%">{{$offer->hiring_package ?? 'N/A'}}</td>
                                <th width="15%">Company Name</th>
                                <th>:</th>
                                <td>{{$offer->company_name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th width="15%">Job Position</th>
                                <th>:</th>
                                <td width="25%">{{$offer->job_position ?? 'N/A'}}</td>
                                <th width="15%">Gender</th>
                                <th>:</th>
                                @if($offer->gender==1)
                                <td>Male</td>
                                @elseif($offer->gender==2)
                                <td>Female</td>
                                @elseif($offer->gender==3)
                                <td>Others</td>
                                @else
                                <td>Any</td>
                                @endif
                            </tr>
                            <tr>
                                <th width="15%">Marital Status</th>
                                <th>:</th>
                                <td width="25%">{{$offer->marital_status ?? 'N/A'}}</td>
                                <th width="15%">Highest Education</th>
                                <th>:</th>
                                <td>{{$offer->highest_education ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th width="15%">Job Location</th>
                                <th>:</th>
                                <td width="25%">{{$offer->job_location ?? 'N/A'}}</td>
                                <th width="15%">Preferred Language</th>
                                <th>:</th>
                                <td>{{$offer->preferred_language ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th width="15%">Reading</th>
                                <th>:</th>
                                <td width="25%">{{$offer->reading ?? 'N/A'}}</td>
                                <th width="15%">Written</th>
                                <th>:</th>
                                <td>{{$offer->written ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <th>:</th>
                                <td>{{\Carbon\Carbon::parse($offer->issue_date)->format('d/m/Y')}}</td>
                                <th>Expected Join Date</th>
                                <th>:</th>
                                <td>{{$offer->expexted_date ? \Carbon\Carbon::parse($offer->expexted_date)->format('d/m/Y') : 'N/A '}}</td>
                                <!-- <td>{{\Carbon\Carbon::parse($offer->expexted_date)->format('d/m/Y')}}</td> -->
                            </tr>
                            <tr>
                                <th>Demand Letter No</th>
                                <th>:</th>
                                <td>{{$offer->demand_letter_no ?? 'N/A'}}</td>
                                <th>Demand Quantity</th>
                                <th>:</th>
                                <td>{{$offer->demand_qty ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Preferred Country</th>
                                <th>:</th>
                                <td>{{$offer->preferred_country_data->name ?? ''}} {{$offer->preferred_country_data2 ? ', '.$offer->preferred_country_data2->name : ''}} {{$offer->preferred_country_data3? ', '.$offer->preferred_country_data3->name : ''}}</td>
                            </tr>
                            <tr>
                                <th>Comments</th>
                                <th>:</th>
                                <td colspan="4">{{$offer->comments ?? 'N/A'}}</td>
                            </tr>
                            @if(Auth::user()->hasRole(['superadministrator','employer']))
                                <tr>
                                    <th>Demand Letter</th>
                                    <th>:</th>
                                    <td>
                                        @if ($offer->demand_file != '')
                                            <a href="{{ asset('storage/demand_letter/' . $offer->demand_file) }}" target="_blank">{{ $offer->demand_file }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <th>KDN, Quota Approval</th>
                                    <th>:</th>
                                    <td>
                                        @if ($offer->approvalQuotaAndLevy != '')
                                            <a href="{{ asset('storage/demand_letter/' . $offer->approvalQuotaAndLevy) }}" target="_blank">{{ $offer->approvalQuotaAndLevy }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endif
                            @if(Auth::user()->hasRole(['superadministrator','agent']))
                                <tr>
                                    <th>Demand Letter for Agent</th>
                                    <th>:</th>
                                    <td colspan="4">
                                        @if ($offer->demand_file_for_agent != '')
                                            <a href="{{ asset('storage/demand_letter/' . $offer->demand_file_for_agent) }}" target="_blank">{{ $offer->demand_file_for_agent }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div><!--/.panel-body-->

                    <h4 class="card-title text-center mt-3 text-uppercase">Workers Details</h4>
                    <div class="card-body">

                    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                        <form method="post" action="{{route('admin.finalizeGWToDemand')}}">
                    @else
                        <form method="post" action="{{route('confirmGWToDemand')}}">
                    @endif
                            @csrf
                            <input type="hidden" id="gws" name="gws" value="">
                            <table id="workers-table" class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Country</th>
                                        <th>Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>Status</th>
                                        @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                                            <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Finalize"></th>
                                        @else
                                            <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Confirm"></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="hide">Id</th>
                                        <th class="hide">Image</th>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Country</th>
                                        <th>Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>Status</th>
                                        <th class="hide"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </div><!--/.container-->

    <!-- Demand Entry Modal -->
    <div class="modal fade" id="demandFileForAgent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered role="document">
            <div class="modal-content tex-center">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle"> Add Demand file for agent </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row justify-content-md-center">
                        <div class="col-md-11">
                            <form method="POST" action="{{ route('admin.demandFileForAgent', $offer->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="pull-left" for="">Demand File for agent</label>
                                        <input id="DemandFile" type="file" class="form-control-file{{ $errors->has('DemandFile') ? ' is-invalid' : '' }}" name="demand_file_for_agent">
                                        <p class="text-left small">Supported file PDF, JPG and PNG. Max file size: 1MB</p>
                                    </div>

                                    @if ($errors->has('DemandFile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('DemandFile') }}</strong>
                                        </span>
                                    @endif
                                </div>
        
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-warning btn-block">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--  /.modal-dialog modal-dialog-centered  -->
    </div><!--  /.modal fade  -->
@endsection



@section('script')
<script>

    // maids table
    $('#workers-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: '{{route('proposedGW', ['damand_id' => $offer->id])}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'marital_status', name: 'marital_status'},
            {data: 'status', name: 'status', "className": "text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-left"}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });
</script>
<script type="text/javascript">
    function KeepCount() {                    
        var inputTags = document.getElementsByName('id[]');                  
        var total = 0;

        for (var i = 0; i < inputTags.length; i++) {

            if (inputTags[i].checked) {                      
                    total = total + 1;
            }

            if (total > {{$offer->demand_qty}}) {
                alert('Please select {{$offer->demand_qty}} only')
                inputTags[i].checked = false;
                return false;
            }
        }
    }
</script>
<script>
    ids = [];

    function updateId(id){
        if(id.checked == true){
            ids.push(id.value);
        }else if(id.checked == false){
            var index = ids.indexOf(id.value);
            if (index > -1) {
                ids.splice(index, 1);
            }
        }
        console.log(ids);
        document.querySelector("#gws").value = ids;
    }

    document.querySelector("#workers-table_paginate").addEventListener('click', function(){
        
        setTimeout(function(){
            for (var i = 0; i < ids.length; i++) {
                checkbox = document.querySelector("#gw"+ ids[i])

                if(checkbox !=null){
                    checkbox.checked = true;
                }
            }
        }, 1000);

    });
</script>
@endsection
