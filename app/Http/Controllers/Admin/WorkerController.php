<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserProfile;
use DB;
use App\AgentProfile;
use App\Offer;
use App\Applicant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');

        // $agent_code = AgentProfile::where('user_id',auth()->user()->id)->pluck('agent_code');
        // $users=DB::table('profiles')
        //         ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
        //         ->leftjoin('countries','countries.id','=','profiles.nationality')
        //         ->leftjoin('users','users.id','=','profiles.user_id')
        //         ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //         ->leftjoin('role_user','role_user.user_id','=','users.id')
        //         ->leftjoin('applicants','applicants.user_id','=','users.id')
        //         ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','user_profiles.name as agencyname','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at')
        //         ->where('users.status','=',1)
        //         ->where('role_user.role_id','=',5)
        //         ->where('profiles.agent_code','=',auth()->user()->id)
        //         ->get();
        // return $users;


        // $users=DB::table('profiles')
        //         ->leftjoin('user_profiles','user_profiles.user_id','=','profiles.agent_code')
        //         ->leftjoin('countries','countries.id','=','profiles.nationality')
        //         ->leftjoin('users','users.id','=','profiles.user_id')
        //         ->leftjoin('role_user','role_user.user_id','=','users.id')
        //         ->leftjoin('applicants','applicants.user_id','=','users.id')
        //         ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','user_profiles.name as agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at')
        //         ->where('users.status','=',1)
        //         ->where('role_user.role_id','=',5)
        //         ->where('profiles.agent_code','=',auth()->user()->id)
        //         ->get();
        // return $users;
        return view('admin.worker.index');
    }

    public function getWorkersData()
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
                // ->leftjoin('offer','offer.id','=','applicants.offer_id')
                // ->leftjoin('employer_profiles','employer_profiles.id','=','offer.employer_id')
                ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
                ->where('users.status','=',1)
                ->where('role_user.role_id','=',5)
                ->where('profiles.nationality','=',$user_country)
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
                        return 'Available';
                    })
                    ->addColumn('agent_name', function($user) {
                        if(isset($user->agency_registered_name)){
                            return $user->agency_registered_name;
                        }
                        else{
                            return $user->user_name;
                        }
                    })
                    ->addColumn('created_at', function($user) {
                        return $user->created_at;
                    })
                    ->rawColumns(['image', 'action', 'selectQW'])
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
                ->where('role_user.role_id','=',5)
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
                        return 'Available';
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
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',5)
                    ->where('profiles.agent_code','=',$agent_code)
                    ->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        
                    $string =  '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                    $string .= '<a target="_blank" class="btn btn-xs btn-info mr-2" href="'.route('profile.edit', $user->id).'">Edit</a>';
                    // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.worker.delete', $user->id).'">Delete</a>';
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
                        return 'Available';
                    })
                    ->addColumn('agent_name', function($user) {
                        if(isset($user->agency_registered_name)){
                            return $user->agency_registered_name;
                        }
                        else{
                            return $user->user_name;
                        }
                    })
                    ->addColumn('created_at', function($user) {
                        return $user->created_at;
                    })
                    ->rawColumns(['image', 'action', 'selectQW'])
                    ->removeColumn('password')
                    ->make(true);
        }
        if(auth()->user()->hasRole('agent')){
            // $users = User::whereRoleIs('worker')->whereHas('profile', function ($q) {
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
                    ->select('applicants.updated_at','applicants.status','profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',5)
                    ->where('profiles.agent_code','=',$agent_code)
                    ->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        
                    $string =  '<div class="row"><div class="col-md-4"><a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'"><i class="fa fa-eye"></i></a></div>';
                    $string .= '<div class="col-md-4"><a target="_blank" class="btn btn-xs btn-info mr-2" href="'.route('profile.edit', $user->id).'"><i class="fa fa-edit"></i></a></div>';
                    $string .= '<div class="col-md-4"><a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.worker.delete', $user->id).'"><i class="fa fa-trash"></i></a></div></div>';
                    return $string;
                })
                // '<input class="ml-1" type="checkbox" name="ids[]" value="'.$user->id.'">';
                    ->addColumn('code', function ($user) {
                        return $user->code ?? '';
                    })
                    ->addColumn('selectQW', function ($user) {
                        // $data=User::with('applicants')->get();
                        // $status = $data->applicants()->first();
                        // return $user->status;
                        if($user->status==3){
                           return 'Hired'; 
                        }
                        return '<input class="ml-1" type="checkbox" name="gws[]" value="'.$user->id.'">';
                    })
                    ->addColumn('image', function($user) {
                        $img = $user->image != '' ? asset('storage/'.$user->image) :  asset('images/dummy.jpg');
                        return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('employer', function ($user) {
                        $demands= Offer::with('employer')->whereHas('applicants', function($query){
                            $query->where('finalized', 1);
                        })->first();
                        if($user->status==3){
                            
                        $employer=$demands->employer->name;
                            return $employer ?? '';
                        }else{
                            return 'N/A';
                        }
                        
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
                        if ($user->status == 1) {
                            $statusLabel = 'Proposed';
                        } elseif ($user->status == 2) {
                            $statusLabel = 'Confirmed';
                        } elseif ($user->status == 3) {
                            $statusLabel = 'Hired';
                        } else {
                            $statusLabel = 'Available';
                        }
                        return $statusLabel;
                        // if($user->app_id){
                        //     return 'Offered';
                        // };
                        // return 'Active';
                    })
                    ->addColumn('agent_name', function($user) {
                        if(isset($user->agency_registered_name)){
                            return $user->agency_registered_name;
                        }
                        else{
                            return $user->user_name;
                        }
                    })
                    ->addColumn('updated_at', function($user) {
                        if($user->status==3){
                        $date = $user->updated_at;
                        return date("d-m-Y", strtotime($date));
                        }else{
                            return '-';
                        }
                    })
                    ->addColumn('created_at', function($user) {
                        $date = $user->created_at;
                        return date("d-m-Y", strtotime($date));
                    })
                    ->rawColumns(['image', 'action', 'selectQW'])
                    ->removeColumn('password')
                    ->make(true);
        }else{
            // $users = User::where('status', 1)->whereRoleIs('worker')->get();
            $users=DB::table('profiles')
            ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
            ->leftjoin('countries','countries.id','=','profiles.nationality')
            ->leftjoin('users','users.id','=','profiles.user_id')
            ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
            ->leftjoin('role_user','role_user.user_id','=','users.id')
            ->leftjoin('applicants','applicants.user_id','=','users.id')
            ->select('applicants.updated_at','applicants.status','profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
            ->where('users.status','=',1)
            ->where('role_user.role_id','=',5)
            // ->where('profiles.agent_code','=',$agent_code)
            ->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        
                    $string =  '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
                    $string .= '<a target="_blank" class="btn btn-xs btn-info mr-2" href="'.route('profile.edit', $user->id).'">Edit</a>';
                    if(auth()->user()->hasRole('superadministrator')){
                        $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.worker.delete', $user->id).'">Delete</a>';
                    }
                    
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
                    ->addColumn('employer', function ($user) {
                        $demands= Offer::with('employer')->whereHas('applicants', function($query){
                            $query->where('finalized', 1);
                        })->first();
                        if($user->status==3){
                            
                        $employer=$demands->employer->name;
                            return $employer ?? '';
                        }else{
                            return 'N/A';
                        }
                        
                    })
                    ->addColumn('country', function($user) {
                        return $user->country;
                    })
                    ->addColumn('status', function($user) {
                        if ($user->status == 1) {
                            $statusLabel = 'Proposed';
                        } elseif ($user->status == 2) {
                            $statusLabel = 'Confirmed';
                        } elseif ($user->status == 3) {
                            $statusLabel = 'Hired';
                        } else {
                            $statusLabel = 'Available';
                        }
            
                        return $statusLabel;
                        // if($user->app_id){
                        //     return 'Offered';
                        // };
                        // return 'Active';
                    })

                    ->addColumn('agent_name', function($user) {
                        if(isset($user->agency_registered_name)){
                            return $user->agency_registered_name;
                        }
                        else{
                            return $user->user_name;
                        }
                    })
                    ->addColumn('created_at', function($user) {
                        $date = $user->created_at;
                        return date("d-m-Y", strtotime($date));
                    })
                    ->addColumn('updated_at', function($user) {
                        if($user->status==3){
                        $date = $user->updated_at;
                        return date("d-m-Y", strtotime($date));
                        }else{
                            return '-';
                        }
                    })
                    ->rawColumns(['image', 'action', 'selectQW'])
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
        return redirect()->route('admin.worker.index');
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
