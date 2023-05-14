<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function publish($table, $id)
    {
        DB::table($table)
            ->where('id', $id)
            ->update(['status' => 1]);

        Session::flash('message', ' Activated!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }

    public function unpublish($table, $id)
    {
        DB::table($table)
            ->where('id', $id)
            ->update(['status' => 0]);

        Session::flash('message', ' Inactivated!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }
    public function block($id)
    {
        $employer = User::where('id', $id)->first();
        $employer->status = 2;
        $employer->save();
        Session::flash('message', 'User has been Blocked!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    public function unblock($id)
    {
        $employer = User::where('id', $id)->first();
        $employer->status = 1;
        $employer->save();
        Session::flash('message', 'User has been  Un Blocked!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function unblockjobseekers($id)
    {
        $employer = User::where('id', $id)->first();
        $employer->status = 0;
        $employer->save();
        Session::flash('message', 'User has been  Un Blocked!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
