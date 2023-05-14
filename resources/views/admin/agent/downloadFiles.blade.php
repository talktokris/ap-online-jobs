@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Download Files </h1>
    </div>
    <section class="section">
        <table id="files-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th width="50%" title="File Title">Title</th>
                    <th width="30%" title=""></th>
                    <th width="20%" title="Updated">Updated</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th title="File Title">Title</th>
                    <th title=""></th>
                    <th title="Updated">Updated</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    // Files table
    $('#files-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getDownloadsFile', 'agent')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"},
            {data: 'updated_at', name: 'updated_at'}
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