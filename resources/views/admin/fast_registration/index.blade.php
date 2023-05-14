@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <div class="title-block">
            <h1 class="title"> Blue Color Job Seeker @if((Auth::user()->hasRole('sub-agent|part-timer')) && Auth::user()->status == 1)<a class="btn btn-success" href="/admin/professional/create">Add Job Seeker</a>@endif</h1>
        </div>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Job Category</th>
                    <th>Number</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>Name</th>
                    <th>Number</th>
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
        ajax: '{{route('admin.fast.registration.data')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'full_name', name: 'full_name'},
            {data: 'job_category', name: 'job_category'},
            {data: 'number', name: 'number'},
            {data: 'city_name', name: 'city_name'},
            {data: 'state_name', name: 'state_name'},
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