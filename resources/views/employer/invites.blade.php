@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h4 class="text-center py-5">Invitaion sent by <a href="{{route('employer.public', $employer->public_id)}}">{{$employer->name}}</a></h4>
                <table id="users-table" class="table table-condensed mb-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($jobseekers as $jobseeker)
                        <tr>
                            <td>{{$jobseeker->code}}</td>
                            <td><img src="{{$jobseeker->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$jobseeker->professional_profile['profile_image']) :  asset('images/dummy.jpg')}}" width="40" class="img-rounded" /></td>
                            <td>{{$jobseeker->name}}</td>
                            <td>{{$jobseeker->email}}</td>
                            <td>{{$jobseeker->professional_profile['city']}}</td>
                            <td><a target="_blank" href="{{route('professional.show', $jobseeker->id)}}" class="btn btn-sm btn-primary">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection