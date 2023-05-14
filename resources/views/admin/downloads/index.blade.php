@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Downloads <a class="btn btn-primary btn-sm" href="{{route('admin.downloads.create')}}">Add New</a></h1>
    </div>
    <section class="section">
        <table id="downloads-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>File Name</th>
                    <th>For</th>
                    <th>Comments</th>
                    <th width="170px">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>File Name</th>
                    <th>For</th>
                    <th>Comments</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#downloads-table').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getDownloadsData')}}',
        columns: [
            {data: 'title', name: 'title'},
            {data: 'file_name', name: 'file_name'},
            {data: 'user_type', name: 'user_type'},
            {data: 'comments', name: 'comments'},
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
        }
    });
</script>
@endsection