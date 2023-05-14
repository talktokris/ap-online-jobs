@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
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
            <div class="col-12">
                <div class="jumbotron">
                    <!-- @if(Auth::user()->unreadNotifications->count() > 0)
                    <p>New Notifications</p>
                        @foreach (Auth::user()->unreadNotifications as $notification)
                            <p><a href="{{route('admin.readSingleNotification',$notification->id)}}" class="notification-item">
                                <i class="fa fa-commenting fa-2x text-danger"></i> {{$notification->data['message']}}
                            </a></p>
                        @endforeach
                    @endif -->
                    <h1 class="display-4"> <br>
                        Hello, 
                        @if($user->agent_profile->agency_registered_name!='')
                            {{$user->agent_profile->agency_registered_name}}
                        @else
                            {{$user->name}}
                        @endif
                    </h1>
                    <hr class="my-4">
                    <p>Your account need to be approved by admin for further action</p>
                    <a class="btn btn-success" href="{{route('agent.edit', Auth::user()->id)}}">Edit Profile</a>
                    {{-- <a class="btn btn-success" href="{{route('agent.print', [Auth::user()->id, 'details'])}}">Print Details</a>
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.Auth::user()->agent_profile->license_file)}}');return false;">Print License</a>
                    <a class="btn btn-success" href="" onclick="printJS('{{asset('storage/'.Auth::user()->agent_profile->passport_file)}}');return false;">Print Passport/NIC</a> --}}
                </div>
                <!-- <div>
                    <p>All Notifications</p>
                    @foreach (Auth::user()->notifications as $notification)
                        <p><a href="{{route('admin.readSingleNotification',$notification->id)}}" class="notification-item">
                            <i class="fa fa-commenting fa-2x text-danger"></i> {{$notification->data['message']}}
                        </a></p>
                    @endforeach
                </div> -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection