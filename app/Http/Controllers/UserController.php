<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function showPasswordChangeForm()
    {
        return view('user.passwordChangeForm');
    }

    public function changePassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();

            return redirect()->route('login');
        }else{
            Session::flash('message', 'Old Password Does not match!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }
}
