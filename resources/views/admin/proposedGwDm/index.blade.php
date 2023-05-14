@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="title-block">
            <h1 class="title"> General Workers @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)<a class="btn btn-success" href="/agent/createuser?t=gw">Add General Worker</a>@endif</h1>
        </div>
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>GW/DM</th>
                    <th>Employer</th>
                    <th>Agent</th>
                    <th>Proposed by Agent</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>ID</th>
                    <th class="hide">Image</th>
                    <th>GW/DM</th>
                    <th>employer</th>
                    <th>agent</th>
                    <th>Proposed by Agent</th>
                    <th>status</th>
                    <th class="hide">Action</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#users-table').DataTable({
        order: [[ 4, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getProposedGwDm')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'image', name: 'image'},
            {data: 'gw_dm', name: 'gw_dm'},
            {data: 'employer', name: 'employer'},
            {data: 'agent', name: 'agent'},
            {data: 'proposed_time', name: 'proposed_time'},
            {data: 'applicant_status', name: 'applicant_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
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
@endsection