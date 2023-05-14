
@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Work As</th>
                    <th>Registration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
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
        ajax: '{{route('admin.getBlockedPartTimeMaidsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'country', name: 'country'},
            {data: 'state', name: 'state'},
            {data: 'city', name: 'city'},
            {data: 'work_as', name: 'work_as'},
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