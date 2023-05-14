<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use Session;
use App\User;
use App\UserProfile;
use App\EmployerProfile;
use App\Offer;
use App\Country;
use App\State;
use App\Applicant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Notifications\GWProposedByAgent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DemandLetterIssueToAgent;
use App\Notifications\EmployerApplicationApproved;
use App\Notifications\EmployerApplicationApproved1;
use App\Notifications\EmployerApplicationRejected;
use App\Notifications\EmployerApplicationRejected1;
use App\Notifications\EmployersSelectedGWConfirmByAgent;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmployerApplication;
use App\Notifications\SendPasswordAfterRegistration;
use App\AgentProfile;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
        // $users=DB::table('employer_profiles')
        // ->leftjoin('countries','countries.id','=','employer_profiles.country')
        // ->leftjoin('users','users.id','=','employer_profiles.user_id')
        // ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        // ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
        // ->where('users.status','=',1)
        // ->where('employer_profiles.agent_code','=',auth()->user()->id)
        // ->get();

        // return $users;
        return view('admin.employer.index');
    }

    public function getEmployersData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('employer_profile')->where('status', 1)->whereRoleIs('employer')->get();
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->employer_profile->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->employer_profile->company_country_data['name'] ?? '';
            })
            ->addColumn('action', function ($user) {
                // $str = '<a href="" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $str  = '<a class="btn btn-xs btn-primary mr-2" href="'.route('employer.public', $user->public_id).'">View</a>';
                $str .= '<a href="'.route('employer.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                if(auth()->user()->hasRole('superadministrator'))
                {
                    $str .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';         //block button addde by milesh 3/11/2020
                }
                    // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Block</a>';
                return $str;
            })
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('employer_profiles')
            ->leftjoin('countries','countries.id','=','employer_profiles.country')
            ->leftjoin('users','users.id','=','employer_profiles.user_id')
            ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
            ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
            ->where('users.status','=',1)
            ->where('employer_profiles.country','=',$user_country)
            ->get();
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('action', function ($user) {
                //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $str  = '<a class="btn btn-xs btn-primary mr-2" href="'.route('employer.public', $user->public_id).'">View</a>';
                // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Delete</a>';
                if(auth()->user()->hasRole('superadministrator|administrator|cadmin'))
                {
                    $str .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';         //block button addde by milesh 3/11/2020
                }
                    // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Block</a>';
                return $str;
            })
            ->removeColumn('password')
            ->make(true);
        }    
        if(auth()->user()->hasRole('sub-agent')){
            $users=DB::table('employer_profiles')
            ->leftjoin('countries','countries.id','=','employer_profiles.country')
            ->leftjoin('users','users.id','=','employer_profiles.user_id')
            ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
            ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
            ->where('users.status','=',1)
            ->where('employer_profiles.agent_code','=',auth()->user()->id)
            ->get();
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('action', function ($user) {
                //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $str  = '<a class="btn btn-xs btn-primary mr-2" href="'.route('employer.public', $user->public_id).'">View</a>';
                // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Delete</a>';
                // if(auth()->user()->hasRole('superadministrator|administrator|cadmin'))
                // {
                //     $str .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';         //block button addde by milesh 3/11/2020
                // }
                    // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Block</a>';
                return $str;
            })
            ->removeColumn('password')
            ->make(true);
        }  
        if(auth()->user()->hasRole('part-timer')){
            $users=DB::table('employer_profiles')
            ->leftjoin('countries','countries.id','=','employer_profiles.country')
            ->leftjoin('users','users.id','=','employer_profiles.user_id')
            ->leftjoin('agent_profiles','agent_profiles.user_id','=','users.id')
            ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
            ->where('users.status','=',1)
            ->where('employer_profiles.agent_code','=',auth()->user()->id)
            ->get();
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('action', function ($user) {
                //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $str  = '<a class="btn btn-xs btn-primary mr-2" href="'.route('employer.public', $user->public_id).'">View</a>';
                $str .= '<a href="'.route('employer.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Delete</a>';
                // if(auth()->user()->hasRole('superadministrator|administrator|cadmin'))
                // {
                //     $str .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';         //block button addde by milesh 3/11/2020
                // }
                    // $str .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Block</a>';
                return $str;
            })
            ->removeColumn('password')
            ->make(true);
        }  
    }

    public function employerBlocked()
    {
        return view('admin.employer.employerBlocked');
    }

    public function getBlockedEmployersData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('employer_profile')->where('status', 2)->whereRoleIs('employer')->get();
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->employer_profile->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->employer_profile->company_country_data['name'] ?? '';
            })
            ->addColumn('action', function ($user) {
                //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $str  = '<a class="btn btn-xs btn-primary mr-2" href="'.route('employer.public', $user->public_id).'">View</a>';
                if(auth()->user()->hasRole('superadministrator')){
                    $str .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
                    $str .= '<a class="btn btn-xs btn-info" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.employer.delete', $user->id).'">Delete</a>';
                }
                
                return $str;
            })
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('employer_profiles')
            ->leftjoin('countries','countries.id','=','employer_profiles.country')
            ->leftjoin('users','users.id','=','employer_profiles.user_id')
            ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
            ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
            ->where('users.status','=',2)
            ->where('employer_profiles.country','=',$user_country)
            ->get();
    
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $str  = '<a class="btn btn-xs btn-primary mr-2" href="'.route('employer.public', $user->public_id).'">View</a>';
            $str .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
            return $str;
        })
            ->removeColumn('password')
            ->make(true);
        }
    }

    public function employerApplication()
    {
        return view('admin.employer.employerApplication');
    }

    public function getEmployersApplicationData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('employer_profile')->where('status', 0)->whereRoleIs('employer')->get();
        
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->employer_profile->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->employer_profile->company_country_data['name'] ?? '';
            })
            ->addColumn('action', function ($user) {
                $string  = '<a class="btn btn-xs btn-primary" href="'.route('employer.public', $user->public_id).'">View</a>';
                $string .= '<a class="ml-1 btn btn-xs btn-info" href="'.route('employer.edit', $user->id).'" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('admin.employer.approve', $user->id).'" onclick="return confirm(\'Are you sure?\')">Approve</a>';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.reject', $user->id).'" onclick="return confirm(\'Are you sure?\')">Reject</a>';
                return $string;
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('employer_profiles')
            ->leftjoin('countries','countries.id','=','employer_profiles.country')
            ->leftjoin('users','users.id','=','employer_profiles.user_id')
            ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
            ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
            ->where('users.status','=',0)
            ->where('employer_profiles.country','=',$user_country)
            ->get();
            return DataTables::of($users)
            ->addColumn('company_name', function ($user) {
                return $user->company_name ?? '';
            })
            ->addColumn('company_country', function ($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('action', function ($user) {
                $string  = '<a class="btn btn-xs btn-primary" href="'.route('employer.public', $user->public_id).'">View</a>';
                $string .= '<a class="ml-1 btn btn-xs btn-info" href="'.route('employer.edit', $user->id).'" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('admin.employer.approve', $user->id).'" onclick="return confirm(\'Are you sure?\')">Approve</a>';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.employer.reject', $user->id).'" onclick="return confirm(\'Are you sure?\')">Reject</a>';
                return $string;
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
        }
    }

    // Demand
    public function employerDemands()
    {

       
        // get all agetns
        $agents = User::with('agent_profile')->where('status', 1)->whereRoleIs('agent')->get();
        // return to demand view
        return view('admin.employer.employerDemands', compact('agents'));
    }

    //get agentdata according country wise
    public function getAgentData($country_id){
        // $agents = AgentProfile::where('agency_country', $country_id)->get();

        $agents = DB::table('agent_profiles')
            ->leftjoin('users','users.id','=','agent_profiles.user_id')  
            ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
            ->where('users.status','=',1)
            ->where('agent_profiles.agency_country','=',$country_id)
            ->get(['users.id','agent_profiles.agency_registered_name']);
            return $agents;
        
    }

    public function getEmployersDemandData()
    {
        if(auth()->user()->hasRole('agent'))
        {
            // Demand letters agent wise
            $loggedInUserId = auth()->user()->id;

            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->where('assigned_agent', $loggedInUserId)->get();
        } else {
            // all demand letters for super admin
            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->get();
        }

        return DataTables::of($demands)
        ->addColumn('company_name', function($demand) {
            return $demand->employer->employer_profile->company_name;
        })
        ->addColumn('preferred_country', function($demand) {
            return $demand->preferred_country_data->name;
        })
        ->addColumn('roc', function($demand) {
            return $demand->employer->employer_profile->roc;
        })
        ->addColumn('person_incharge', function($demand) {
            return $demand->employer->name;
        })
        ->addColumn('expexted_date', function($demand) {
            return $demand->expexted_date ? \Carbon\Carbon::parse($demand->expexted_date)->format('d/m/Y') : '';
        })
        ->addColumn('proposed_qty', function($demand) {

            $countProposedGW = count( $demand->applicants()->where('proposed', 1)->get() );

            $countProposedGW = $countProposedGW ?: '...';

            $string = '<span title="Proposed Date: '. (($demand->proposed_date != '') ? \Carbon\Carbon::parse($demand->proposed_date)->format('d/m/Y') : 'N/A') .'">'. $countProposedGW .'</span>';

            return $string;
        })
        ->addColumn('day_pending', function($demand) {

            if ($demand->expexted_date)
            {
                $date1 = date_create(date('Y-m-d'));
                
                $proposed_date = strtotime($demand->expexted_date);
                // $proposed_date7 = strtotime("+6 day", $proposed_date);
                $date2 = date_create(date('Y-m-d', $proposed_date));

                //difference between two dates
                $diff = date_diff($date1,$date2);

                //count days
                $diff = $diff->format("%a");
                return $diff;
            } else {
                return '...';
            }

        })
        ->addColumn('confirmed_qty', function($demand) {
            return count( $demand->applicants()->where('confirmed', 1)->get() ) ?: '...';
        })
        ->addColumn('final_qty', function($demand) {
            return count( $demand->applicants()->where('finalized', 1)->get() ) ?: '...';
        })
        ->addColumn('interview_status', function($demand) {
            return $demand->interview_date_time ?? 'N/A' ;
        })
        ->addColumn('status', function($demand) {
            $status = '';

            if ($demand->status == 2) {
                $status = 'Submitted';
            } elseif ($demand->status == 3) {
                $status = 'Assigned Agent';
            } elseif ($demand->status == 4) {
                $status = 'Proposed GW';
            } elseif ($demand->status == 5) {
                $status = 'Confirmed GW';
            } elseif ($demand->status == 6) {
                $status = 'Finalized GW';
            } elseif ($demand->status == 7) {
                $status = 'Closed';
            } else {
                $status = '';
            }

            return $status;
        })
        
        ->addColumn('assigned_agent', function($demand) {
            if ($demand->assigned_agent) {
                return $demand->agent->name;
            } else {
                return '<a class="btn btn-sm btn-warning btn-assign-agent" demandID="'. $demand->id .'" onclick="getAgent('.$demand->preferred_country .')"  href="#">Assign</a>';
                // return '<a class="btn btn-sm btn-warning btn-assign-agent" data-toggle="modal" onclick="agent_list_by_country()" countryId="'.$demand->preferred_country.'" demandID="'. $demand->id .'" data-backdrop="static" data-keyboard="false" data-target="#assignDemandAgentModal" href="#">Assign</a>';
                // return '<a class="btn btn-sm btn-warning btn-assign-agent" data-toggle="modal" onclick="agent_list_by_country()" countryId="'.$demand->preferred_country.'" demandID="'. $demand->id .'" data-backdrop="static" data-keyboard="false" href="#">Assign</a>';
            }
        })
        ->addColumn('proposed_gw', function($demand) {
            // if ($demand->assigned_agent) {
            //     return $demand->agent->name;
            // } else {
                return '<a class="btn btn-sm btn-warning btn-selectGW" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#selectGWModal" href="#" demandID="'. $demand->id .'">Select GW</a>';
            // }
        })
        ->addColumn('action', function ($demand) {
            $string =  '<a class="btn btn-sm btn-primary" href="'.route('demand', $demand->id).'">View</a>';

            return $string;
        })
        ->rawColumns(['proposed_qty', 'assigned_agent', 'proposed_gw', 'action'])
        ->make(true);
    }

    public function assignDemandAgent(Request $request)
    {

        // return $request;
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->assigned_agent = $request->AgentAssign;
        $demandUpdate->status = 3;  // assigned agent
        $demandUpdate->save();

        Session::flash('message', 'Demand letter assigned to agent successfully!'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to the Agent
        $agent = User::where('id', $request->AgentAssign)->first();
        $data = $demandUpdate;
        Notification::send($agent, new DemandLetterIssueToAgent($data,$agent->name));

        return redirect('/admin/employer-demands');
    }

    public function proposeGWToDemand(Request $request)
    {
        // dd($request->gws);
        if(!$request->gws) {
            Session::flash('message', 'No General Worker Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        // update demand
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->status = 4;  // proposed GW
        $demandUpdate->proposed_date = date('Y-m-d');  // proposed GW
        $demandUpdate->save();

        // $ids = explode(",",$request->gws);
        $ids = $request->gws;
        // dd($ids);
        foreach($ids as $id){
            $applicant = new Applicant;
            $applicant->offer_id = $request->demandID;
            $applicant->user_id = $id;
            $applicant->proposed = 1; // Proposed GW
            $applicant->status = 1; // Proposed GW
            // dd($applicant);
            $applicant->save();
        }

        Session::flash('message', 'Proposed GW successfully!'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to the Employer
        $employer = $demandUpdate->employer;
        $admins = User::whereRoleIs('superadministrator')->get();
        $data = $demandUpdate;
        Notification::send($employer, new GWProposedByAgent($data,$demandUpdate->company_name));
        Notification::send($admins, new GWProposedByAgent($data,$demandUpdate->company_name));

        return redirect('/admin/employer-demands');
    }

    public function finalizeGWToDemand(Request $request)
    {
        if(!$request->gws) {
            Session::flash('message', 'No General Worker were Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        // update demand
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->status = 6;  // finalized GW
        $demandUpdate->save();

        $ids = explode(",",$request->gws);
        foreach($ids as $id){
            $applicantUpdate = Applicant::where('id', $id)->first();
            $applicantUpdate->finalized = 1;  // finalized GW
            $applicantUpdate->status = 3;  // finalized GW
            $applicantUpdate->save();
        }

        Session::flash('message', 'Worker(s) finalized successfully!'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to the Employer
        $employer = $demandUpdate->employer;
        $admins = User::whereRoleIs('superadministrator')->get();
        $data = $demandUpdate;
        Notification::send($employer, new EmployersSelectedGWConfirmByAgent($data,$demandUpdate->company_name));
        Notification::send($admins, new EmployersSelectedGWConfirmByAgent($data,$demandUpdate->company_name));

        return redirect('/admin/employer-demands');
    }

    public function approve($id)
    {
        $employer = User::where('id', $id)->first();

        $employer->status = 1;
        $employer->save();
        // dd($employer->password);
        //Send notification to the employer
        $data = $employer->employer_profile;
        if($data['looking_for_pro']=="yes" || $data['looking_for_gw'] =="yes" || $data['looking_for_rp']=="yes" ){
            Notification::send($employer,new EmployerApplicationApproved1('DefPassEmployer',$employer->email,$data->company_name));
        }else{
            Notification::send($employer,new EmployerApplicationApproved1('DefPassEmployer',$employer->email,$employer->name));
        }
        // Notification::send($employer,new EmployerApplicationApproved1('DefPassEmployer',$employer->email,$data->company_name));

        Session::flash('message', 'Application Approved!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function reject($id)
    {
        $employer = User::where('id', $id)->first();

        $employer->status = -1;
        $employer->save();

        //Send notification to the Employer
        $data = $employer->employer_profile;
        if($data['looking_for_pro']=="yes" || $data['looking_for_gw'] =="yes" || $data['looking_for_rp']=="yes" ){
            Notification::send($employer, new EmployerApplicationRejected1($data,$data->company_name));
        }else{
            Notification::send($employer, new EmployerApplicationRejected1($data,$employer->name));
        }
        // Notification::send($employer, new EmployerApplicationRejected1($data,$data->company_name));

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

    public function demandFileForAgent($id, Request $request)
    {
        $offer = Offer::where('id', $id)->first();
        if($request->file('demand_file_for_agent')){
            $this->validate($request, [
                'demand_file_for_agent' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);

            $file_basename = explode('.',$request->file('demand_file_for_agent')->getClientOriginalName())[0];
            $file_name = $file_basename . '-' . time() . '.' . $request->file('demand_file_for_agent')->getClientOriginalExtension();

            $request->demand_file_for_agent->storeAs('public/demand_letter', $file_name);
            //add new image path to database
            $offer->demand_file_for_agent = $file_name;

            $offer->demand_file_for_agent_owner = auth()->user()->id;
            $offer->save();

            Session::flash('message', 'Demand file for agent added successfully!!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('demand', $id);
        }else{
            Session::flash('message', 'No file Selected!!'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('demand', $id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        if(auth()->user()->hasRole('sub-agent')){
            $user_country=UserProfile::where('user_id',$user_id)->pluck('company_country');
        }
        if(auth()->user()->hasRole('part-timer')){
            $user_country=AgentProfile::where('user_id',$user_id)->pluck('agency_country');
        }
        // return $user_country;
        $countrys = Country::where('status', 1)
                            ->where('id',$user_country)
                            ->get();
        $country_id=Country::where('status', 1)
                            ->where('id',$user_country)
                            ->pluck('id');
            // return $countrys;
        $states = State::where('status',1)
                            ->where('country_id',$country_id)
                            ->get();
        // return $states;
        return view('admin.employer.create',compact('countrys','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        if(isset($request['employer_type'])!=3){
            $this->validate($request, [
                'email' => 'email|max:255|unique:users',
                'company_name' => 'required',
                'company_phone' => 'required',
                'employer_type' => 'required',
                'roc' => 'required|unique:employer_profiles'
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required',
                'employer_type' => 'required',
                // 'person_country' => 'required'
            ]);
        }

        // return $request['company_name'];
        $user = new User;
        if(isset($request['contact_email'])){
            $com_email=$request['contact_email'];
        }
        elseif($request['email'])
        {
            $com_email=$request['email'];
        }
        $user->public_id = time().md5($com_email);
        $user->name = $request['name'] ?? '';
        $user->email = $request['contact_email'] ?? $request['email'];
        if(isset($request['company_phone'])){
            $phone=$request['company_phone'];
        }
        elseif($request['phone']){
            $phone=$request['phone'];
        }
        $user->phone = $phone;
        $user->password = Hash::make('DefPassEmployer');
        $user->status='0';
        if(isset($request['company_country'])){
            $user_country=$request['company_country'];
        }
        elseif($request['person_country']){
            $user_country=$request['person_country'];
        }
        $user->code = $this->user_code($user_country);
        $user->save();
        $user->attachRole($request['role']);

        $employer = new EmployerProfile;
        $employer->user_id = $user->id;
        $employer->agent_code = auth()->user()->id;
        $employer->address=$request['company_address'] ?? '';
        $employer->country=$user_country;
        // if(isset($request['company_name'])){
        //     $company_name= $request['company_name'];
        // }
        // elseif($request['name']){
        //     $company_name = $request['name'];
        // }
        $employer->company_name = $request['company_name'] ?? $request['name'];
        $employer->company_address=$request['company_address'] ?? '';
        $employer->company_country = $user_country;
        $employer->roc = $request['roc'];
        if(isset($request['company_phone'])){
            $contact_number = $request['company_phone'];
        }
        elseif(isset($request['phone'])){
            $contact_number = $request['phone'];
        }
        $employer->company_phone = $request['company_phone'] ?? $request['phone'] ?? '';
        $employer->company_email = $request['contact_email'] ?? $request['email'];
        $employer->contact_email = $request['contact_email'] ?? $request['email'];
        $employer->website = $request['website'] ?? '';
        if(isset($request['company_state'])){
            $com_state=$request['company_state'];
        }
        elseif(isset($request['state'])){
            $com_state=$request['state'];
        }
        if(isset($request['company_city'])){
            $com_city= $request['company_city'];
        }
        elseif(isset($request['city'])){
            $com_city=$request['city'];
        }
        $employer->company_city = $com_city;
        $employer->state = $com_state;
        $employer->looking_for_pro = $request['looking_for_pro'] ?? null;
        $employer->looking_for_gw = $request['looking_for_gw'] ?? null;
        $employer->looking_for_dm = $request['looking_for_dm'] ?? null;
        $employer->looking_for_rp=$request['looking_for_rp'] ?? null;

        $employer->save();
        Session::flash('message', 'Employer has been created'); 
        Session::flash('alert-class', 'alert-success');
        $data = $employer;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new EmployerApplication($data));
        return view('admin.employer.index');
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
        if($user->employer_profile){
            $user->employer_profile->delete();
        }
        $offers = Offer::where('employer_id', $user->id)->get();

        if($offers){
            foreach($offers as $offer){
                if($offer->applicants){
                    foreach($offer->applicants as $applicant){
                        $applicant->delete();
                    }
                }
                $offer->delete();
            }
        }

        $jobs = Job::where('user_id', $user->id)->get();
        if($jobs){
            foreach($jobs as $job){
                $job->delete();
            }
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.employer.index');
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

    public function employerOffers()
    {
        $offers = Offer::with('employer')->get();
        $offers = $offers->filter(function ($offer){
            return $offer->title == null;
        });
        // dd($offers);
        return view('admin.employer.offers', [
            'offers' => $offers
        ]);
    }

    public function user_code($country_id)
    {
        $country = Country::where('id', $country_id)->first();
        for($i=1; $i<10000; $i++){
            if($i < 10){
                //00009
                $j = '0000' . $i;
            }elseif($i >= 10 && $i < 100){
                //00099
                $j = '000' . $i;
            }elseif($i >= 100 && $i < 1000){
                //00999
                $j = '00' . $i;
            }elseif($i >= 1000 && $i < 10000){
                //09999
                $j = '0' . $i;
            }else{
                //99999
                $j = $i;
            }
            $user_code = $country->code . $j;
            if(!User::where('code', '=', $user_code)->exists()){
                break;
            }
        }
        return $user_code;
    }
}
