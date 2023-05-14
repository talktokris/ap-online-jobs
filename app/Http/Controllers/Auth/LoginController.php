<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AgentApplication;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/';
    public function redirectTo(){
        if(Auth::user()->hasRole(['superadministrator', 'administrator','cadmin','sub-agent'])){
            if(Auth::user()->status == 1){
                return '/admin';
            }
        }elseif(Auth::user()->hasRole('agent','part-timer')){
            if(Auth::user()->status == 1){
                //Send notification to admins [Test Purpose]
                // $data = auth()->user()->agent_profile;
                // $admins = User::whereRoleIs('superadministrator')->get();
                // Notification::send($admins, new AgentApplication($data));
                return '/admin';
            }else{
                return '/agent';
            }
        }elseif(Auth::user()->hasRole('employer')){
            if(Auth::user()->status == 1)
            {
                return '/employer/profile';
            }elseif(Auth::user()->status == 2){
                \Session::flush();
                return route('login');
            }
            
        }elseif(Auth::user()->hasRole('part_time_employer')){
            if(Auth::user()->status == 1){
                return route('partimemployerprofile.edit',Auth::user()->id);
            }
        }
        elseif(Auth::user()->hasRole('professional')){
            if(Auth::user()->status == 0){
                return route('professional.index');
            }elseif(Auth::user()->status == 2){
                \Session::flush();
                return route('login');
            }
            
        }
        else{
            return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        // return $request->only($this->username(), 'password');
        return ['email'=>$request->{$this->username()},'password'=>$request->password]; 
    }
}
