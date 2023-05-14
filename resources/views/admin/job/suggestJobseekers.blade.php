@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> {{ $job->job_seeker_job_category_data->name}}</h1>
        <p>{{ $job->total_number_of_vacancies }} {{ $job->job_vacancies_type }} vacancy open</p>
        <p><span class="badge badge-success">{{count($job->suggested_jobseekers())}} Jobseekers Suggested</span></p>
    </div>
    <section class="section">
        <form method="GET" action="{{ route('admin.job.suggestJobseekers', $job->id) }}">
            <div class="form-row justify-content-center ext-box">
                <div class="col-1">
                    <label class="sr-only" for="age_term">Age</label>
                    <select name="age_term" id="age_term" class="form-control">
                        <option value="">-- Age --</option>
                        <option value="18-24" @if(request('age_term')=="18-24"){{"selected"}} @endif>18-24</option>
                        <option value="25-35" @if(request('age_term')=="25-35"){{"selected"}} @endif>25-35</option>
                        <option value="36-45" @if(request('age_term')=="36-45"){{"selected"}} @endif>36-45</option>
                    </select>
                </div>
                <div class="col-2">
                    <label class="sr-only" for="qualification">Qualification</label>
                    <select name="qualification" id="qualification" class="form-control">
                        <option value="">-- Qualification --</option>
                        @foreach ($qualifications as $qualification)
                            <option value="{{ $qualification->name }}" @if(request('qualification')==$qualification->name){{"selected"}} @endif>{{ $qualification->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label class="sr-only" for="field_of_study">Field of study</label>
                    <select name="field_of_study" id="field_of_study" class="form-control">
                        <option value="">-- Field of study --</option>
                        @foreach ($field_of_studys as $field_of_study)
                            <option value="{{ $field_of_study->name }}" @if(request('field_of_study')==$field_of_study->name){{"selected"}} @endif>{{ $field_of_study->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <label class="sr-only" for="salary">Salary</label>
                    <select name="salary" id="salary" class="form-control">
                        <option value="">-- Salary --</option>
                        @foreach ($salarys as $salary)
                            <option value="{{ $salary->name }}" @if(request('salary')==$salary->name){{"selected"}} @endif>{{ $salary->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-1">
                    <label class="sr-only" for="city">Age</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Type City" value="{{request('city')}}">
                </div>
                
                <div class="col-1">
                    <button type="submit" class="btn btn-primary text-capitalize btn-block">Search</button>
                </div>
                <div class="col-1">
                    <a href="{{ route('admin.job.suggestJobseekers', $job->id) }}" class="btn btn-danger text-capitalize">Clear</a>
                </div>
            </div>
        </form>
        <form method="post" action="{{route('admin.job.sendSuggesion', $job->id)}}">
        @csrf
            <div class="text-center py-2">
                <input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm" type="submit" value="Submit Selected Professionals">
                @if ($errors->has('ids'))
                    <span class="badge badge-danger">Please Select at least one Jobseeker</span>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row verticle-center">
                        @if(!empty($jobseekers))
                        @foreach ($jobseekers as $user)
                        <div class="col-md-2 mb-2 text-center" style="border: 1px solid #e6edee; height: 220px; padding-top: 10px;">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="ids[]" id="userid{{$user->id}}" value="{{$user->id}}">
                                <label class="custom-control-label text-success" for="userid{{$user->id}}">Select</label>
                            </div>
                            <img class="img-thumbnail" src="{{$user->professional_profile->profile_image != '' ? asset('storage/resume/'.$user->professional_profile->profile_image) : asset('images/avatar.jpg')}}" style="height: 130px; width: 130px; border-radius: 50%; margin-bottom: 10px;" alt="{{$user->professional_profile->name ?? ''}}">
                            <br>
                            <a href="{{route('professional.show', $user->id)}}" class="btn btn-sm btn-block btn-primary" target="_blank">Details</a>
                        </div>
                        <div class="col-md-4 mb-2" style="border: 1px solid #e6edee; border-left: none; height: 220px; padding-top: 10px;">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th></th>
                                    <th width="35%">Position</th>
                                    <th width="5%">:</th>
                                    <td width="60%">{{$user->professional_profile->job_seeker_job_category_data->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th width="35%">Name</th>
                                    <th width="5%">:</th>
                                    <td width="60%">{{$user->professional_profile->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th width="35%">Age</th>
                                    <th width="5%">:</th>
                                    <td width="60%">{{$user->professional_profile->age() ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th width="35%">City</th>
                                    <th width="5%">:</th>
                                    <td width="60%">{{$user->professional_profile->job_seeker_city_data->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th width="35%">Salary</th>
                                    <th width="5%">:</th>
                                    <td width="60%">{{$user->professional_profile->expected_salary ?? ''}}</td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            </form>
        {{-- <form method="post" action="{{route('admin.job.sendSuggesion', $job->id)}}">
            @csrf
            <table id="resume-table" class="my_datatable table table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <th class="hide">Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Education</th>
                        <th>City</th>
                        <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Suggest"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="hide"></th>
                        <th class="hide">Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Education</th>
                        <th>City</th>
                        <th class="hide">Action</th>
                    </tr>
                </tfoot>
            </table>
        </form> --}}
    </section>
@endsection
@section('javascript')
{{-- <script>
$('#resume-table').DataTable({
    order: [[ 0, "desc" ]],
    processing: true,
    serverSide: true,
    ajax: '{{route('admin.job.getJobseekerByPosition', $job->id)}}',
    columns: [
        {data: 'id', name: 'id'},
        {data: 'profile_image', name: 'profile_image'},
        {data: 'name', name: 'name'},
        {data: 'age', name: 'age'},
        {data: 'education', name: 'education'},
        {data: 'city', name: 'city'},
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
</script> --}}
@endsection