@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Gallery <a class="btn btn-primary btn-sm" href="{{route('admin.gallery.create')}}">Add New Image</a></h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide">Id</th>
                    <th>Image</th>
                    <th>Caption</th>
                    <th class="hide">Updated At</th>
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
        ajax: '{{route('admin.getGalleryData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image_name', name: 'image_name'},
            {data: 'caption', name: 'caption'},
            {data: 'updated_at', name: 'updated_at'},
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