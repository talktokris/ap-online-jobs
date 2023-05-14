<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use App\UserProfile;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AgentApplicationApproved;
use App\Notifications\AgentApplicantApproved;
use App\Notifications\AgentApplicantRejected;
use App\Notifications\AgentApplicationRejected;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
        // $users = DB::table('agent_profiles')
        //         ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
        //         ->leftjoin('cities','cities.id','=','agent_profiles.agency_city')
        //         ->leftjoin('users','users.id','=','agent_profiles.user_id')
        //         ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //         ->select('agent_profiles.agency_registered_name','cities.name as agency_city','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
        //         ->where('users.status','=',2)
        //         ->where('agent_profiles.agency_country','=',$user_country)
        //         ->get();
        // return $users;


        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
        //     $users = DB::table('agent_profiles')
        //             ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
        //             ->leftjoin('cities','cities.id','=','agent_profiles.agency_city')
        //             ->leftjoin('users','users.id','=','agent_profiles.user_id')
        //             ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //             ->select('agent_profiles.agency_registered_name','cities.name as agency_city','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
        //             ->where('users.status','=',1)
        //             ->where('agent_profiles.agency_country','=',$user_country)
        //             ->get();
        // return $users;

        $active_agent_count = User::with('agent_profile')->whereHas('roles', function($q){$q->whereIn('name', ['part-timer','agent']);})->where('status', 1)->count();
        // dd($active_agent_count);
        return view('admin.agent.index', compact('active_agent_count'));
    }

    public function getAgentsData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('agent_profile')->whereHas('roles', function($q){$q->whereIn('name', ['part-timer','agent']);})->where('status', 1)->get();
            // $users = User::with('agent_profile')->whereRoleIs('agent')->orwhereRoleIs('part-timer')->where('status', 1)->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a href="'.route('agent.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    
                    $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.agent.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';         //block button added by milesh 3/11/2020
                    
                    // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.agent.delete', $user->id).'">Delete</a>';
                }
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->agent_profile['country_data']['name'];
            })
            ->addColumn('agency_registered_name', function($user) {
                return $user->agent_profile['agency_registered_name'];
            })
            ->addColumn('agency_email', function($user) {
                return $user->agent_profile['agency_email'];
            })
            ->addColumn('agency_city', function($user) {
                return $user->agent_profile['company_city_data']['name'];
            })
            ->addColumn('first_name', function($user) {
                return $user->agent_profile['first_name'];
            })
            ->addColumn('phone', function($user) {
                return $user->agent_profile['contact_phone'];
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('cities','cities.id','=','agent_profiles.agency_city')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','cities.name as agency_city','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',1)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->get();
                return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                    $string = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                    if(auth()->user()->hasRole('superadministrator|administrator')){
                        $string .= '<a href="'.route('agent.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                        $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.agent.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';         //block button added by milesh 3/11/2020
                        
                        // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.agent.delete', $user->id).'">Delete</a>';
                    }
                    return $string;
                })
                ->addColumn('country', function($user) {
                    return $user->company_country;
                })
                ->addColumn('agency_registered_name', function($user) {
                    return $user->agency_registered_name;
                })
                ->addColumn('agency_email', function($user) {
                    return $user->email ?? '';
                })
                ->addColumn('agency_city', function($user) {
                    return $user->agency_city;
                })
                ->addColumn('first_name', function($user) {
                    return $user->name ?? '';
                })
                ->addColumn('phone', function($user) {
                    return $user->contact_phone ?? '';
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->removeColumn('password')
                ->make(true);
        }
    }

    // New controller added for agent blocked --3/11/2020
    public function agentBlocked()
    {
        return view('admin.agent.agentBlocked');
    }

    public function geBlockedtAgentsData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('agent_profile')->whereHas('roles', function($q){$q->whereIn('name', ['part-timer','agent']);})->where('status', 2)->get();

            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.agent.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
                    $string .= '<a class="btn btn-xs btn-info" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.agent.delete', $user->id).'">Delete</a>';
                }
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->agent_profile['country_data']['name'];
            })
            ->addColumn('agency_registered_name', function($user) {
                return $user->agent_profile['agency_registered_name'];
            })
            ->addColumn('agency_email', function($user) {
                return $user->agent_profile['agency_email'];
            })
            ->addColumn('agency_city', function($user) {
                return $user->agent_profile['company_city_data']['name'];
            })
            ->addColumn('first_name', function($user) {
                return $user->agent_profile['first_name'];
            })
            ->addColumn('phone', function($user) {
                return $user->agent_profile['contact_phone'];
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('cities','cities.id','=','agent_profiles.agency_city')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','cities.name as agency_city','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',2)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->get();
                return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $string = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                    if(auth()->user()->hasRole('superadministrator')){
                        $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.agent.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
                    }
                    return $string;
                })
                ->addColumn('country', function($user) {
                    return $user->company_country;
                })
                ->addColumn('agency_registered_name', function($user) {
                    return $user->agency_registered_name;
                })
                ->addColumn('agency_email', function($user) {
                    return $user->email ?? '';
                })
                ->addColumn('agency_city', function($user) {
                    return $user->agency_city ?? '';
                })
                ->addColumn('first_name', function($user) {
                    return $user->name ?? '';
                })
                ->addColumn('phone', function($user) {
                    return $user->contact_phone ?? '';
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->removeColumn('password')
                ->make(true);
        }
    }
    // end 3/11/2020


    public function agentApplication()
    {
        return view('admin.agent.agentApplication');
    }

    public function getAgentsApplicationData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            // $users = User::where('status', 0) 
            //             ->whereRoleIs('agent')  
            //             ->orwhereRoleIs('part-timer')                     
            //             ->get();



            $users = User::where(function($query){
                                $query->whereRoleIs('agent')
                                        ->orwhereRoleIs('part-timer');
                            })  
                            ->where('status', 0)                 
                            ->get();
            // $users = User::with(['roles' => function($q){
            //     $q->where('name', 'agent');
            // }])
            // ->where('status',0)
            // ->get();

            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View </a> ';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('admin.agent.approve', $user->id).'" onclick="return confirm(\'Are you sure?\')">Approve </a> ';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.agent.reject', $user->id).'" onclick="return confirm(\'Are you sure?\')">Reject </a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a href="'.route('agent.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                }
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->agent_profile['country_data']['name'];
            })
            ->addColumn('agency_registered_name', function($user) {
                return $user->agent_profile['agency_registered_name'];
            })
            ->addColumn('agency_email', function($user) {
                return $user->agent_profile['agency_email'];
            })
            ->addColumn('agency_city', function($user) {
                return $user->agent_profile['company_city_data']['name'];
            })
            ->addColumn('first_name', function($user) {
                return $user->agent_profile['first_name'];
            })
            ->addColumn('phone', function($user) {
                return $user->agent_profile['contact_phone'];
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('cities','cities.id','=','agent_profiles.agency_city')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','cities.name as agency_city','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',0)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View </a> ';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('admin.agent.approve', $user->id).'" onclick="return confirm(\'Are you sure?\')">Approve </a> ';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.agent.reject', $user->id).'" onclick="return confirm(\'Are you sure?\')">Reject </a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a href="'.route('agent.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                }
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->company_country;
            })
            ->addColumn('agency_registered_name', function($user) {
                return $user->agency_registered_name;
            })
            ->addColumn('agency_email', function($user) {
                return $user->email ?? '';
            })
            ->addColumn('agency_city', function($user) {
                return $user->agency_city ?? '';
            })
            ->addColumn('first_name', function($user) {
                return $user->name ?? '';
            })
            ->addColumn('phone', function($user) {
                return $user->contact_phone ?? '';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
    }

    public function rejectedAgentApplication()
    {
        return view('admin.agent.rejectedAgentApplication');
    }

    public function getRejectedAgentApplicationData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::where('status', -1)->whereRoleIs('agent')->get();

            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View </a> ';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('admin.agent.restore', $user->id).'" onclick="return confirm(\'Are you sure?\')">Restore </a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a href="'.route('agent.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                }
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->agent_profile['country_data']['name'];
            })
            ->addColumn('agency_registered_name', function($user) {
                return $user->agent_profile['agency_registered_name'];
            })
            ->addColumn('agency_email', function($user) {
                return $user->agent_profile['agency_email'];
            })
            ->addColumn('agency_city', function($user) {
                return $user->agent_profile['company_city_data']['name'];
            })
            ->addColumn('first_name', function($user) {
                return $user->agent_profile['first_name'];
            })
            ->addColumn('phone', function($user) {
                return $user->agent_profile['contact_phone'];
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('cities','cities.id','=','agent_profiles.agency_city')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','cities.name as agency_city','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',-1)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('admin.agent.show', $user->id).'" class="btn btn-xs btn-primary">View </a> ';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('admin.agent.restore', $user->id).'" onclick="return confirm(\'Are you sure?\')">Restore </a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a href="'.route('agent.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                }
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->company_country;
            })
            ->addColumn('agency_registered_name', function($user) {
                return $user->agency_registered_name;
            })
            ->addColumn('agency_city', function($user) {
                return $user->agency_city ?? '';
            })
            ->addColumn('agency_email', function($user) {
                return $user->email ?? '';
            })
            ->addColumn('first_name', function($user) {
                return $user->name ?? '';
            })
            ->addColumn('phone', function($user) {
                return $user->contact_phone ?? '';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
    
    }

    public function approve($id)
    {
        $agent = User::where('id', $id)->first();

        $agent->status = 1;
        $agent->save();

        //Send notification to the agent
        $data = $agent->agent_profile;
        Notification::send($agent,new AgentApplicantApproved('DefPassAgent',$agent->email,$data->agency_registered_name));

        // Notification::send($agent, new AgentApplicationApproved($data));

        Session::flash('message', 'Application Approved!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function reject($id)
    {
        $agent = User::where('id', $id)->first();

        $agent->status = -1;
        $agent->save();

        //Send notification to the agent
        $data = $agent->agent_profile;
        Notification::send($agent, new AgentApplicantRejected($data,$data->agency_registered_name));
        // Notification::send($agent, new AgentApplicationRejected($data));

        Session::flash('message', 'Application Rejected!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    public function restore($id){
        $agent = User::where('id', $id)->first();

        $agent->status = 0;
        $agent->save();
        Session::flash('message', 'Application Restored!!'); 
        Session::flash('alert-class', 'alert-warning');
        return redirect()->back();
    }

    public function downloadFiles()
    {
        return view('admin.agent.downloadFiles');
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
        // dd('test');
        $user = User::where('id', $id)->first();
        $profile = $user->agent_profile;
        $data = 'details';
        return view('agent.print', compact('data', 'profile','user'));
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
        if($user->agent_profile){
            $user->agent_profile->delete();
        }

        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.agent.index');
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
