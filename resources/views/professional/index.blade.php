@extends('layouts.app')

<style>
    .ftco-navbar-light {
  background: transparent !important;
  position: relative !important;
  top: 0px !important;
  left: 0;
  right: 0;
  z-index: 3; }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row bg-dark">
            <div class="col-12">
                <h4 class="text-center text-white pb-3 pt-4">Tell US about yourself</h4>
            </div>
        </div>
    </div>
    <div class="container mt-4 mb-5">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <p class="text-center">Find the right job on Online Jobs. You are only few steps away from millions of jobs</p>
            </div>
            {{-- <div class="col-3 text-center">
                <p><img style="width:100px; height:100px" src="{{asset('images/fresher.png')}}" alt=""></p>
                <p class="mt-2"><a class="btn btn-warning" href="{{route('professional.create')}}?type=new">New Graduate</a></p>
                <p>I have just graduated/I haven't worked after graduation</p>
            </div> --}}
            <div class="col-3 text-center">
                <p><img style="width:100px; height:100px" src="{{asset('images/professional.png')}}" alt=""></p>
                <p class="mt-1"><a class="btn btn-warning" href="{{route('professional.create')}}?type=pro">I am Job Seeker</a></p>
                {{-- <p>I have at least 1 month of work experience</p> --}}
            </div>
            <div class="col-12 mt-5 mb-5">
                <div class="row justify-content-md-center">
                    <div class="col-7">
                        <p class="text-center">After you register, you can:</p>
                        <ul>
                            <li>Apply to jobs from the site while keeping your resume hidden from all recruiters.</li>
                            <li>Mark yourself as a 'passive jobseeker' if you are not actively looking for a job.</li>
                            <li>Block your company or other specific companies from viewing your profile.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection