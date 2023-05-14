@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if(Request()->q == 'location')
                <h4 class="text-center pb-3 pt-4">Jobs by Location</h4>
                <a class="btn btn-sm btn-success" href="/job?q=location&c=Malaysia">Malaysia</a>
                <a class="btn btn-sm btn-success" href="/job?q=location&c=Bangladesh">Bangladesh</a>
                <a class="btn btn-sm btn-success" href="/job?q=location&c=Cambodia">Cambodia</a>
                <hr>
                @elseif(Request()->q == 'skill')
                    <h4 class="text-center pb-3 pt-4">Jobs by Skill</h4>
                @elseif(Request()->q == 'designation')
                    <h4 class="text-center pb-3 pt-4">Jobs by Designation</h4>
                @elseif(Request()->q == 'category')
                    <h4 class="text-center pb-3 pt-4">Jobs by Category</h4>
                @else
                    <h4 class="text-center pb-3 pt-4">All Jobs</h4>
                @endif
            
                @forelse ($jobs as $job)

                <div class="mb-5">
                    <h4 class="text-info"><a href="{{route('job.show', $job->id)}}">{{$job->positions_name}}</a></h4>
                    <p class="mb-1 text-info">{{$job->company()->company_name}}</p>
                    <div class="pl-4">
                        <p class="my-0 text-secondary"> {{$job->district ? $job->district . ',' : ''}} {{$job->town ? $job->town . ',' : '' }} {{$job->state ?? '' }}</p>
                        @auth
                        <p class="my-0 text-secondary"> {{$job->salary_offer_currency }} {{$job->salary_offer}}</p>
                        @else
                        <p class="my-0"> <a href="/login">Login to view Salary</a> </p>
                        @endif
                    </div>
                    <p class="text-secondary"><small> {{\Carbon\Carbon::parse($job->created_at)->format('d M - g:i A')}}</small></p>
                </div>

                @empty
                <div class="card auth-form mb-5">
                    <div class="card-body">
                        No Jobs Found
                    </div>
                </div>
                @endforelse
                
        </div>
    </div>
</div>
@endsection
