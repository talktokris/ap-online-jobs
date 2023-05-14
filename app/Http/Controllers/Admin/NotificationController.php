<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function showAllNotification()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        // dd($notifications);
        return view('admin.notification.index', [
            'notifications' => $notifications
        ]);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->route('admin.home');
    }

    public function readSingleNotification($id)
    {
        $notification = auth()->user()->notifications()->where('id',$id)->first();
        $notification->markAsRead();
        return redirect($notification->data['link']);
    }

    public function deleteSingleNotification($id)
    {
        $notification = auth()->user()->notifications()->where('id',$id)->first();
        $notification->delete();
        return view('admin.notification.index');
    }
}
