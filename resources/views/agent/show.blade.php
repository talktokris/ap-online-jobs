@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @if(Session::has('message'))
                <div class="col-md-12">
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-8 ml-auto mr-auto">
        <a class="btn btn-success" href="{{route('agent.createuser')}}">Create Worker/maid</a>
        <a class="btn btn-warning" href="{{route('agent.edit', Auth::user()->agent_profile->id)}}">Edit My Profile</a>
        <div class="card">
            <h4 class="card-title text-center mt-3">Agent Information</h4>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row border-bottom">
                        <div class="col-md-4">
                            <p class="profile-title">Agency Registered Name</p>
                            <p class="profile-content">{{$user->agent_profile->agency_registered_name ?? 'N/A'}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="profile-title">Address</p>
                            <p class="profile-content">{{$user->agent_profile->agency_address ?? 'N/A'}}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="profile-title">City</p>
                            <p class="profile-content">{{$user->agent_profile->agency_city ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div><!--/.panel-body-->
        </div><!--/.panel panel-default-->
        <div class="card">
            <div class="card-heading">
                <h2 class="text-center mt-3">Maids and Workers under {{$user->agent_profile->agency_registered_name}}</h2>
            </div>
            <div class="card-body">
                <ul>
                @foreach ($workers_maids as $workers_maid)
                    <li class="mb-1">{{$workers_maid->name}} <a class="btn btn-info" href="{{route('profile.public', $workers_maid->public_id)}}">View</a> <a class="btn btn-success" href="{{route('profile.edit', $workers_maid->profile->id)}}">Edit </a></li>
                @endforeach
                </ul>
            </div>
        </div>
    </div><!--/.col-md-8-->
@endsection