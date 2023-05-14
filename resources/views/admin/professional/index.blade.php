@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <div class="title-block">
            <h1 class="title"> Job Seeker @if((Auth::user()->hasRole('sub-agent|part-timer')) && Auth::user()->status == 1)<a class="btn btn-success" href="/admin/professional/create">Add Job Seeker</a>@endif</h1>
        </div>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position Name</th>
                    <th>Email</th>
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
                    <th class="hide">Image</th>
                    <th>Name</th>
                    <th>Email</th>
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
        ajax: '{{route('admin.getProfessionalsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'profile_image', name: 'profile_image'},
            {data: 'name', name: 'name'},
            {data: 'position_name', name: 'position_name'},
            {data: 'email', name: 'email'},
            {data: 'country', name: 'country'},
            {data: 'city', name: 'city'},
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