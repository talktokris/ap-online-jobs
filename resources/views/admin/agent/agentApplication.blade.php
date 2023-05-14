@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Agent Applications </h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Agency Name</th>
                    <th>Email</th>
                    <th>Person Incharge</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>ID</th>
                    <th>Agency Name</th>
                    <th>Email</th>
                    <th>Person Incharge</th>
                    <th>Country</th>
                    <th>City</th>
                    <th class="hide">Registered Date</th>
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
        ajax: '{{route('admin.getAgentsApplicationData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'agency_registered_name', name: 'agency_registered_name'},
            {data: 'agency_email', name: 'agency_email'},
            {data: 'first_name', name: 'first_name'},
            {data: 'country', name: 'country'},
            {data: 'agency_city', name: 'agency_city'},
            {data: 'created_at', name: 'created_at'},
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