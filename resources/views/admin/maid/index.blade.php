@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Domestic Maids @if((Auth::user()->hasRole('superadministrator|sub-agent|part-timer') || Auth::user()->hasRole('agent')) && Auth::user()->status == 1)<a class="btn btn-success" href="/agent/createuser?t=dm">Add Domestic Maid</a>@endif</h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Passport</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Agent Name</th>
                    <th>Registration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>ID</th>
                    <th class="hide">Image</th>
                    <th>Name</th>
                    <th>Passport</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Agent Name</th>
                    <th>Registration Date</th>
                    <th class="hide">Action</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#users-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getMaidsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'status', name: 'status'},
            {data: 'agent_name', name: 'agent_name'},
            {data: 'created_at',name: 'created_at'},
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