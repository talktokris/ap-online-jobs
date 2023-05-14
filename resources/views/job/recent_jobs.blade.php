@extends('layouts.app')
@section('content')
{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" /> --}}
<div class="container py-5" style="margin-top:55px">
    <div class="row" style="justify-content: center;"><h4>All Jobs</h4></div><hr>
    <form method="GET" class="" action="{{route('recent.job')}}">
        <div class="row">
            <div class="col-md-6" style="margin-left: -28px;">
                <div class="form-group col-md-12">
                    <input type="text" id="filter_title" placeholder="Search By Position Name" name="positon_name" value="{{ isset($_GET['positon_name'])?$_GET['positon_name']:'' }}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-xs">Search </button>
                <a type="button" href="{{route('recent.job')}}" class="btn btn-xs" style="background-color: #E05024 !important; border: none !important; color:white; border-radius: 0;">Reset </a>
            </div>
        </div>
    </form>
    <div class="row">
        <table class="table table-bordered">
            <thead >
              <tr style="background-color: #157efb; color:white">
                <th scope="col">#</th>
                <th scope="col">Position Name</th>
                <th scope="col">Location Name</th>
                <th scope="col">Vacancies</th>
                <th scope="col">Closing Date</th>
                <th scope="col">Experience Required</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @if(!$jobs->isEmpty())
                <?php $count = ($jobs->currentpage()-1)*$jobs->perpage()+1; ?>
                    @foreach ($jobs as $list )
                        <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$list->option_name}}</td>
                            <td>{{$list->country_name ?? 'N/A'}},{{$list->state_name ?? 'N/A' }}</td>
                            <td>{{$list->total_number_of_vacancies}}</td>
                            <td>{{$list->closing_date}}</td>
                            <td>{{$list->related_experience_year}}</td>
                            <td>
                                <a type="button" class="btn btn-primary btn-sm" href="{{route('recent.job.details',$list->j_id)}}">View Details</a>|
                                @guest
                                <a href="{{route('login')}}" style="background-color: #E05024 !important; border: none !important;" type="button" class="btn btn-primary">Apply Now</a>
                                @endguest
                                @auth
                                @if(Auth::user()->hasRole('professional'))
                                <a href="{{route('applyOnline',$jobs_details->job_id)}}" style="background-color: #E05024 !important; border: none !important;" type="button" class="btn btn-primary">Apply Now</a>
                                @endif
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
          <div class="pagination">
            {{ $jobs->links()}}
        </div>
    </div>
</div>
@endsection
