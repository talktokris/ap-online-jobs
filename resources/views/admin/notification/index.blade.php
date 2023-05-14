@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> All Notifications </h1>
        <a class="btn btn-success" href="{{route('admin.markAllAsRead')}}">Mark All as Read</a>
    </div>
    <section class="section">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Notification</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                @foreach ($notifications as $notification)
                <tr>
                    <th></th>
                    <th>{{$notification->data['message']}}</th>
                    <th>
                        <a href="{{route('admin.readSingleNotification',$notification->id)}}" class="btn btn-success"> Read</a> {{$notification->read_at ? '' : '(New)'}}
                        <a href="{{route('admin.deleteSingleNotification', $notification->id)}}" class="btn btn-danger">Delete</a>
                    </th>
                </tr>
                @endforeach
            </tfoot>
        </table>
        {{$notifications->links()}}
    </section>
@endsection