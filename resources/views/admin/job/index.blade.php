@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Jobs </h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Positions Name</th>
                    <th>Work Type</th>
                    <th>Vacancies</th>
                    <th>Closing Date</th>
                    <th>Company Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>Positions Name</th>
                    <th class="hide"></th>
                    <th>Vacancies</th>
                    <th>Closing Date</th>
                    <th>Company Name</th>
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
        ajax: '{{route('admin.getJobsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'positions_name', name: 'positions_name'},
            {data: 'worker_type', name: 'worker_type'},
            {data: 'total_number_of_vacancies', name: 'total_number_of_vacancies'},
            {data: 'closing_date', name: 'closing_date'},
            {data: 'company_name', name: 'company_name'},
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