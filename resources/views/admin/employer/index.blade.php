@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <!-- <h1 class="title"> Employers </h1> -->
        <div class="title-block">
            <h1 class="title"> Employers @if((Auth::user()->hasRole('sub-agent|part-timer')) && Auth::user()->status == 1)<a class="btn btn-success" href="/admin/employer/create">Add Employer</a>@endif</h1>
        </div>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Person Incharge</th>
                    <th>Location</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Person Incharge</th>
                    <th>Location</th>
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
        ajax: '{{route('admin.getEmployersData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'company_name', name: 'company_name'},
            {data: 'email', name: 'email'},
            {data: 'name', name: 'name'},
            {data: 'company_country', name: 'company_country'},
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