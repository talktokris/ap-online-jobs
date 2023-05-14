<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserProfile;
use App\AgentProfile;
use DB;
use App\Applicant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $agent_code = AgentProfile::where('user_id',auth()->user()->id)->pluck('agent_code');
        // $users=DB::table('profiles')
        //         ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
        //         ->leftjoin('countries','countries.id','=','profiles.nationality')
        //         ->leftjoin('users','users.id','=','profiles.user_id')
        //         ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //         ->leftjoin('role_user','role_user.user_id','=','users.id')
        //         ->leftjoin('applicants','applicants.user_id','=','users.id')
        //         ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
        //         ->where('users.status','=',1)
        //         ->where('role_user.role_id','=',6)
        //         ->where('profiles.agent_code','=',$agent_code)
        //         ->count();
        //     return $users;
        return view('admin.maid.index');
    }

    public function getMaidsData()
    {
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('profiles')
                ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                ->leftjoin('countries','countries.id','=','profiles.nationality')
                ->leftjoin('users','users.id','=','profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->leftjoin('role_user','role_user.user_id','=','users.id')
                ->leftjoin('applicants','applicants.user_id','=','users.id')
                ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
                ->where('users.status','=',1)
                ->where('role_user.role_id','=',6)
                ->where('profiles.nationality','=',$user_country)
                ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string  = '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                $string .= '<a target="_blank" class="btn btn-xs btn-info mr-1" href="'.route('profile.edit', $user->id).'">Edit</a>';
                $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.maid.delete', $user->id).'">Delete</a>';
                return $string;
            })
            ->addColumn('status', function($user) {
                if($user->app_id){
                    return 'Offered';
                };
                return 'Active';
            })
            ->addColumn('country', function($user) {
                return $user->country;
            })
            // ->addColumn('date_of_birth', function($user) {
            //     return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
            // })
            ->addColumn('passport', function($user) {
                return $user->passport;
            })
            // ->addColumn('marital_status', function($user) {
            //     return $user->profile->marital_status_data['name'];
            // })
            ->addColumn('agent_name', function($user) {
                if(isset($user->agency_registered_name)){
                    return $user->agency_registered_name;
                }
                else{
                    return $user->user_name;
                }
            })
            ->addColumn('image', function($user) {
                $img = $user->image != '' ? asset('storage/'.$user->image) :  asset('images/dummy.jpg');
                return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('created_at', function($user) {
                return $user->created_at;
            })
            ->rawColumns(['image', 'action'])
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('sub-agent')){
            $users=DB::table('profiles')
                ->leftjoin('user_profiles','user_profiles.user_id','=','profiles.agent_code')
                ->leftjoin('countries','countries.id','=','profiles.nationality')
                ->leftjoin('users','users.id','=','profiles.user_id')
                ->leftjoin('role_user','role_user.user_id','=','users.id')
                ->leftjoin('applicants','applicants.user_id','=','users.id')
                ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','user_profiles.name as agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at')
                ->where('users.status','=',1)
                ->where('role_user.role_id','=',6)
                ->where('profiles.agent_code','=',auth()->user()->id)
                ->get();
                return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        
                    $string =  '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                    $string .= '<a target="_blank" class="btn btn-xs btn-info mr-2" href="'.route('profile.edit', $user->id).'">Edit</a>';
                    $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.worker.delete', $user->id).'">Delete</a>';
                    return $string;
                })
                    ->addColumn('code', function ($user) {
                        return $user->code ?? '';
                    })
                    ->addColumn('image', function($user) {
                        $img = $user->image != '' ? asset('storage/'.$user->image) :  asset('images/dummy.jpg');
                        return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('name', function ($user) {
                        return $user->name ?? '';
                    })
                    ->addColumn('passport', function ($user) {
                        return $user->passport;
                    })
                    ->addColumn('country', function($user) {
                        return $user->country;
                    })
                    ->addColumn('status', function($user) {
                        if($user->app_id){
                            return 'Offered';
                        };
                        return 'Active';
                    })
                    ->addColumn('agent_name', function($user) {
                        return $user->agency_registered_name;
                    })
                    ->addColumn('created_at', function($user) {
                        return $user->created_at;
                    })
                    ->rawColumns(['image', 'action', 'selectQW'])
                    ->removeColumn('password')
                    ->make(true);
        }
        if(auth()->user()->hasRole('part-timer')){
            $agent_code = AgentProfile::where('user_id',auth()->user()->id)->pluck('agent_code');
            $users=DB::table('profiles')
                    ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',6)
                    ->where('profiles.agent_code','=',$agent_code)
                    ->get();
                    return DataTables::of($users)
                    ->addColumn('action', function ($user) {
                        //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        $string  = '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                        $string .= '<a target="_blank" class="btn btn-xs btn-info mr-1" href="'.route('profile.edit', $user->id).'">Edit</a>';
                        // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.maid.delete', $user->id).'">Delete</a>';
                        return $string;
                    })
                    ->addColumn('status', function($user) {
                        if($user->app_id){
                            return 'Offered';
                        };
                        return 'Active';
                    })
                    ->addColumn('country', function($user) {
                        return $user->country;
                    })
                    // ->addColumn('date_of_birth', function($user) {
                    //     return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
                    // })
                    ->addColumn('agent_name', function($user) {
                        return $user->agency_registered_name;
                    })
                    ->addColumn('passport', function($user) {
                        return $user->passport;
                    })
                    // ->addColumn('marital_status', function($user) {
                    //     return $user->profile->marital_status_data['name'];
                    // })
                    ->addColumn('image', function($user) {
                        $img = $user->image != '' ? asset('storage/'.$user->image) :  asset('images/dummy.jpg');
                        return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('created_at', function($user) {
                        return $user->created_at;
                    })
                    ->rawColumns(['image', 'action'])
                    ->removeColumn('password')
                    ->make(true);

        }
        if(auth()->user()->hasRole('agent')){
            // $users = User::whereRoleIs('maid')->whereHas('profile', function ($q) {
            //     $agent = auth()->user();
            //     $q->where('agent_code', $agent->agent_profile->agent_code);
            // })->get();

            $agent_code = AgentProfile::where('user_id',auth()->user()->id)->pluck('agent_code');
            $users=DB::table('profiles')
                    ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',6)
                    ->where('profiles.agent_code','=',$agent_code)
                    ->get();
                    return DataTables::of($users)
                    ->addColumn('action', function ($user) {
                        //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        $string  = '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                        $string .= '<a target="_blank" class="btn btn-xs btn-info mr-1" href="'.route('profile.edit', $user->id).'">Edit</a>';
                        $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.maid.delete', $user->id).'">Delete</a>';
                        return $string;
                    })
                    ->addColumn('status', function($user) {
                        if($user->app_id){
                            return 'Offered';
                        };
                        return 'Active';
                    })
                    ->addColumn('country', function($user) {
                        return $user->country;
                    })
                    // ->addColumn('date_of_birth', function($user) {
                    //     return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
                    // })
                    ->addColumn('agent_name', function($user) {
                        return $user->agency_registered_name;
                    })
                    ->addColumn('passport', function($user) {
                        return $user->passport;
                    })
                    // ->addColumn('marital_status', function($user) {
                    //     return $user->profile->marital_status_data['name'];
                    // })
                    ->addColumn('image', function($user) {
                        $img = $user->image != '' ? asset('storage/'.$user->image) :  asset('images/dummy.jpg');
                        return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('created_at', function($user) {
                        return $user->created_at;
                    })
                    ->rawColumns(['image', 'action'])
                    ->removeColumn('password')
                    ->make(true);

        }else{
            // $users = User::where('status', 1)->whereRoleIs('maid')->get();
            $users=DB::table('profiles')
                    ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',6)
                    ->get();
                    return DataTables::of($users)
                    ->addColumn('action', function ($user) {
                        //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        $string  = '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                        $string .= '<a target="_blank" class="btn btn-xs btn-info mr-1" href="'.route('profile.edit', $user->id).'">Edit</a>';
                        if(auth()->user()->hasRole('superadministrator')){
                            $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.maid.delete', $user->id).'">Delete</a>';
                        }
                        
                        return $string;
                    })
                    ->addColumn('status', function($user) {
                        if($user->app_id){
                            return 'Offered';
                        };
                        return 'Active';
                    })
                    ->addColumn('country', function($user) {
                        return $user->country;
                    })
                    // ->addColumn('date_of_birth', function($user) {
                    //     return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
                    // })
                    ->addColumn('agent_name', function($user) {
                        if(isset($user->agency_registered_name)){
                            return $user->agency_registered_name;
                        }
                        else{
                            return $user->user_name;
                        }
                    })
                    ->addColumn('passport', function($user) {
                        return $user->passport;
                    })
                    // ->addColumn('marital_status', function($user) {
                    //     return $user->profile->marital_status_data['name'];
                    // })
                    ->addColumn('image', function($user) {
                        $img = $user->image != '' ? asset('storage/'.$user->image) :  asset('images/dummy.jpg');
                        return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('created_at', function($user) {
                        return $user->created_at;
                    })
                    ->rawColumns(['image', 'action'])
                    ->removeColumn('password')
                    ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function delete(User $user)
    {
        if($user->profile){
            $user->profile->delete();
        }

        $applications = Applicant::where('user_id', $user->id) ->get();
        if($applications){
            foreach($applications as $application){
                $application->delete();
            }
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.maid.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
