@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title">Part Time Employer Application</h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Registered Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th class="hide">Registered Date</th>
                    <th class="hide">Action</th>
                </tr>
            </tfoot>
        </table>
    </section>

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:772px; margin-left:-115px">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Send Mail To User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div><hr>
                <div class="modal-body" style="margin-bottom: -15px;">
                    <div class="md-form" id="ajaxAssesmentdata">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $('#users-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getPartTimeEmployer')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'address', name: 'address'},
            {data: 'country', name: 'country'},
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


    function sendMail(part_time_employer){
        $('#modalLoginForm').modal('show');
        var url='{{url('send-mail')}}'+'/'+part_time_employer;
        $.ajax({
            url: url,
            type: 'Get'
        })
        .done(function(res) {
            $('#ajaxAssesmentdata').html(res)
        })
        .fail(function(a) {
        console.log(a);
        })
    }
</script>
@endsection
