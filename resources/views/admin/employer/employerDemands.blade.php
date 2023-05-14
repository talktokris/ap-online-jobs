@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Employer Demands</h1>
    </div>
    <section class="section">
        <table id="demands-table" class="table table-condensed">
            <thead>
                <tr>
                    <th >ID</th>
                    <th title="Company Name">Company Name</th>
                    <th title="Nationality">Nationality</th>
                    {{-- <th >ROC Number</th> --}}
                    <th >Person Incharge</th>
                    <!-- <th title="Demand Letter No">DLN</th> -->
                    <th title="Expected Join Date">EJD</th>
                    <th title="Total Demand">No of Worker</th>
                    <th title="Proposed Quantity">Proposed</th>
                    <th title="Day Pending">Day Pending</th>
                    <th title="Confirmed Quantity">Confirmed</th>

                    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                        <th title="Hired Quantity">Hired</th>
                        <th title="Status">Status</th>
                        <th title="Proposed General Worker">Proposed GW</th>
                    @else
                        <th title="Final Quantity">Final</th>
                        <th title="Status">Status</th>
                        <th title="Assigned Agent">Assigned Agent</th>
                    @endif
                    <th title=""></th>
                    <th title="Interview Date">Interview Date</th>
                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide">ID</th>
                    <th title="Company Name">Company Name</th>
                    <th title="Nationality">Nationality</th>
                    {{-- <th>ROC Number</th> --}}
                    <th >Person Incharge</th>
                    <!-- <th title="Demand Letter No">DLN</th> -->
                    <th class="hide" title="Expected Join Date">EJD</th>
                    <th class="hide" title="Total Demand">No of Worker</th>
                    <th class="hide" title="Proposed Quantity">Proposed Qty</th>
                    <th class="hide" title="Day Pending">Day Pending</th>
                    <th title="Confirmed Quantity">Confirmed Qty</th>

                    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                        <th title="Hired Quantity">Hired Qty</th>
                        <th title="Status">Status</th>
                        <th class="hide" title="Proposed General Worker">Proposed GW</th>
                    @else
                        <th class="hide" title="Final Quantity">Final Qty</th>
                        <th title="Status">Status</th>
                        <th title="Assigned Agent">Assigned Agent</th>
                    @endif
                    <th title="Interview Date">Interview Date</th>
                    <th class="hide" title=""></th>
                </tr>
            </tfoot>
        </table>
    </section>

    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
    <!-- Select GW Modal -->
    <div class="modal fade" id="selectGWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content tex-center">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle"> Select General Workers </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">

                            <form method="post" action="{{route('admin.proposeGWToDemand')}}">
                            @csrf
                                <input type="hidden" id="gws" name="gws" value="">
                                <input type="hidden" id="demandID" name="demandID" value="">
                                <table id="workers-table" class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            {{-- <th>Passport</th> --}}
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Propose GW"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th class="hide">Image</th>
                                            <th class="hide">ID</th>
                                            <th>Name</th>
                                            {{-- <th>Passport</th> --}}
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th class="hide"></th>
                                            <th class="hide"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div><!--  /.modal-dialog modal-dialog-centered  -->
    </div><!--  /.modal fade  -->
    <!-- /.Login Modal -->
    @else
    <!-- Assign Agent Modal -->
    <div class="modal fade" id="assignDemandAgentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tex-center">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle"> Assign an Agent </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row justify-content-md-center">
                        <div class="col-md-11">
                            <form method="POST" action="{{ route('admin.assignDemandAgent') }}" aria-label="{{ __('Assign Demand Agent') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="demandID" name="demandID" value="">
                                    <select name="AgentAssign" id="AgentAssign" class="form-control{{ $errors->has('AgentAssign') ? ' is-invalid' : '' }}">
                                        
                                    </select>

                                    @if ($errors->has('AgentAssign'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('AgentAssign') }}</strong>
                                        </span>
                                    @endif
                                </div>
        
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-warning btn-block">
                                        {{ __('Assign Demand Agent') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--  /.modal-dialog modal-dialog-centered  -->
    </div><!--  /.modal fade  -->
    <!-- /.Login Modal -->
    @endif

@endsection
@section('javascript')
<script>
    // get Demand Id as hidden value
    $(document).on("click", '.btn-assign-agent, .btn-selectGW', function (e) {
        var demandID = $(this).attr('demandID');  
        $("#demandID").attr('value', demandID);
    });


    // demand table list
    $('#demands-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getEmployersDemandData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'company_name', name: 'company_name'},
            {data: 'preferred_country', name: 'preferred_country'},
            
            // {data: 'roc', name: 'roc'},
            {data: 'person_incharge', name: 'person_incharge'},
            // {data: 'demand_letter_no', name: 'demand_letter_no'},
            {data: 'expexted_date', name: 'expexted_date', "className": "text-center"},
            {data: 'demand_qty', name: 'demand_qty', "className": "text-center"},
            {data: 'proposed_qty', name: 'proposed_qty', "className": "text-center"},
            {data: 'day_pending', name: 'day_pending', "className": "text-center"},
            {data: 'confirmed_qty', name: 'confirmed_qty', "className": "text-center"},
            {data: 'final_qty', name: 'final_qty', "className": "text-center"},
            {data: 'status', name: 'status', "className": "text-center"},
            
            @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                {data: 'proposed_gw', name: 'proposed_gw', "className": "text-center"},
            @else
                {data: 'assigned_agent', name: 'assigned_agent', "className": "text-center"},
            @endif
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"},
            {data: 'interview_status', name: 'interview_status', "className": "text-center"},
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



    // workers table
workersTable = $('#workers-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: '{{route('admin.getWorkersData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            // {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'status', name: 'status', "className": "text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"},
            {data: 'selectQW', name: 'selectQW', orderable: false, searchable: false, "className": "text-center"}
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
            $('tr td:nth-child(1)').hide();
            $('tr th:nth-child(1)').hide();
        }
    });



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

function getAgent(country_id){
    let url="{{route('admin.getAgentData', [':country_id'])}}".replace(':country_id', country_id)
    $.ajax({
        url: url, 			
        method: "GET",    
        error: function(err) {
        console.log(err)					
        },
        success: function(response) {
            console.log(response);
            $('#assignDemandAgentModal').modal('show');
            $('#AgentAssign').empty();
            $('#AgentAssign').append('<option value="0" disable="true" selected="true">-------  Select an Agent -------</option>');

            $.each(response,function(index, regenciesObj){
                $('#AgentAssign').append('<option value="'+regenciesObj.id +'">'+ regenciesObj.agency_registered_name +'</option>');

                // $('#AgentAssign').append('<option value="'+regenciesObj.agent_profiles.id +'">'+ regenciesObj.agency_registered_name +'</option>');
            });              
        }
    })
}
</script>
@endsection