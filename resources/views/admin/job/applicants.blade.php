@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="title-block">
            <h1 class="title">Position: {{ $job->job_seeker_job_category_data->name}} </h1>
            <p>{{ $job->total_number_of_vacancies }} {{ $job->job_vacancies_type }} vacancy open</p>
            <p>Comapny: <a href="{{ route('employer.public', $job->company()->user->public_id)}}">{{ $job->company()->company_name}}</a></p>
        </div>
        <h1>Applicants</h1>
        <table id="resume-table" class="my_datatable table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th class="hide">Image</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Education</th>
                    <th>Position</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th class="hide">Image</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Education</th>
                    <th>Position</th>
                    <th>City</th>
                    <th>Status</th>
                    <th class="hide">Action</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
$('#resume-table').DataTable({
    order: [[ 0, "desc" ]],
    processing: true,
    serverSide: true,
    ajax: '{{route('getJobApplicants', $job->id)}}',
    columns: [
        {data: 'id', name: 'id'},
        {data: 'profile_image', name: 'profile_image'},
        {data: 'name', name: 'name'},
        {data: 'age', name: 'age'},
        {data: 'education', name: 'education'},
        {data: 'position', name: 'position'},
        {data: 'city', name: 'city'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action', orderable: false, searchable: false, class: 'd-flex'}
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