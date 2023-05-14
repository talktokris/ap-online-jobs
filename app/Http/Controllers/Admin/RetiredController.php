<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserProfile;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Country;
use App\State;
use App\Option;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\RetiredPersonnel;
use App\Mail\SendPasswordAfterRegistration;
use App\Notifications\RetiredPersonnelRegistration;
use App\AgentProfile;

class RetiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');

        // $users=DB::table('retired_personnels')
        //         ->leftjoin('countries','countries.id','=','retired_personnels.country')
        //         ->leftjoin('users','users.id','=','retired_personnels.user_id')
        //         ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //         ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
        //         ->where('users.status','=',1)
        //         ->where('retired_personnels.agent_code','=',auth()->user()->id)
        //         ->get();
        // return $users;

        $retired_count = User::with('retired_personnel')->where('status', 0)->whereRoleIs('retired')->count();
        return view('admin.retired.index', compact('retired_count'));
    }

    public function getRetiredPersonnelsData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('retired_personnel')->where('status', 0)->whereRoleIs('retired')->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a href="'.route('retiredPersonnel.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';
                }
           
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
                return $string;
                })
            ->addColumn('address', function($user) {
                return $user->retired_personnel['address'];
            })
            ->addColumn('country', function($user) {
                return $user->retired_personnel->company_country_data['name'] ?? '';
            })
            ->addColumn('name', function($user) {
                return $user->retired_personnel['name'];
            })
            ->addColumn('email', function($user) {
                return $user->retired_personnel['email'];
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('retired_personnels')
                    ->leftjoin('countries','countries.id','=','retired_personnels.country')
                    ->leftjoin('users','users.id','=','retired_personnels.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                    ->where('users.status','=',0)
                    ->where('retired_personnels.country','=',$user_country)
                    ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
            $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
            $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';
            
            // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
            return $string;
            })
            ->addColumn('address', function($user) {
                return $user->address ?? '';
            })
            ->addColumn('country', function($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->addColumn('email', function($user) {
                return $user->email;
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('sub-agent')){
                $users=DB::table('retired_personnels')
                ->leftjoin('countries','countries.id','=','retired_personnels.country')
                ->leftjoin('users','users.id','=','retired_personnels.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('retired_personnels.agent_code','=',auth()->user()->id)
                ->get();
                return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';
                
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
                return $string;
                })
                ->addColumn('address', function($user) {
                    return $user->address ?? '';
                })
                ->addColumn('country', function($user) {
                    return $user->company_country ?? '';
                })
                ->addColumn('name', function($user) {
                    return $user->name;
                })
                ->addColumn('email', function($user) {
                    return $user->email;
                })
                ->rawColumns(['action'])
                ->removeColumn('password')
                ->make(true);
        }
        if(auth()->user()->hasRole('sub-agent')){
                $users=DB::table('retired_personnels')
                ->leftjoin('countries','countries.id','=','retired_personnels.country')
                ->leftjoin('users','users.id','=','retired_personnels.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('retired_personnels.agent_code','=',auth()->user()->id)
                ->get();
                return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';
                
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
                return $string;
                })
                ->addColumn('address', function($user) {
                    return $user->address ?? '';
                })
                ->addColumn('country', function($user) {
                    return $user->company_country ?? '';
                })
                ->addColumn('name', function($user) {
                    return $user->name;
                })
                ->addColumn('email', function($user) {
                    return $user->email;
                })
                ->rawColumns(['action'])
                ->removeColumn('password')
                ->make(true);
        }
        if(auth()->user()->hasRole('part-timer')){
            $users=DB::table('retired_personnels')
            ->leftjoin('countries','countries.id','=','retired_personnels.country')
            ->leftjoin('users','users.id','=','retired_personnels.user_id')
            // ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
            ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
            ->where('users.status','=',1)
            ->where('retired_personnels.agent_code','=',auth()->user()->id)
            ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
            $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
            $string .= '<a href="'.route('retiredPersonnel.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
            // $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';
            
            // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
            return $string;
            })
            ->addColumn('address', function($user) {
                return $user->address ?? '';
            })
            ->addColumn('country', function($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->addColumn('email', function($user) {
                return $user->email;
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
        
    }
    // added by milesh 3/11/2020
    public function retiredBlocked()
    {
        return view('admin.retired.retiredBlocked');
    }
    public function getBlockedRetiredPersonnelsData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('retired_personnel')->where('status', 2)->whereRoleIs('retired')->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
                }
                
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
                return $string;
            })
            ->addColumn('address', function($user) {
                return $user->retired_personnel['address'];
            })
            ->addColumn('country', function($user) {
                return $user->retired_personnel->company_country_data['name'] ?? '';
            })
            ->addColumn('name', function($user) {
                return $user->retired_personnel['name'];
            })
            ->addColumn('email', function($user) {
                return $user->retired_personnel['email'];
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('retired_personnels')
                    ->leftjoin('countries','countries.id','=','retired_personnels.country')
                    ->leftjoin('users','users.id','=','retired_personnels.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                    ->where('users.status','=',2)
                    ->where('retired_personnels.country','=',$user_country)
                    ->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.retiredPersonnel.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
                
        
            // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
                return $string;
                })
                ->addColumn('address', function($user) {
                    return $user->address ?? '';
                })
                ->addColumn('country', function($user) {
                    return $user->company_country ?? '';
                })
                ->addColumn('name', function($user) {
                    return $user->name;
                })
                ->addColumn('email', function($user) {
                    return $user->email;
                })
                ->rawColumns(['action'])
                ->removeColumn('password')
                ->make(true);
        }
    }
    // 3/11/2020
    public function delete(User $user)
    {
        if($user->retired_personnel){
            $user->retired_personnel->delete();
        }

        if($user->retired_personnel_language){
            foreach($user->retired_personnel_language as $language){
                $language->delete();
            }
        }
        if($user->retired_personnel_experiences){
            foreach($user->retired_personnel_experiences as $experience){
                $experience->delete();
            }
        }
        if($user->retired_personnel_educations){
            foreach($user->retired_personnel_educations as $education){
                $education->delete();
            }
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.retired.index');
    }
    public function create(){
        // return "retired";
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
        $options= Option::where([
            ['status','=','1'],
            ['type','=','Position Name'],
            ])->get();
        return view('admin.retired.create',compact('countrys','states','options'));
    }
    public function store(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->last_name = $request->lname;     //last name added 2/14/2020 by milesh
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('DefPassRetired');
        $user->public_id = time().md5($request->email);
        $user->status = '1';
        $user_country = $request->country;
        $user->code = $this->user_code($user_country);
        $user->save();

        $user->attachRole('retired');

        $retiredPersonnel = new RetiredPersonnel;
        $retiredPersonnel->user_id = $user->id;
        $retiredPersonnel->agent_code = auth()->user()->id;
        $retiredPersonnel->name = $request->name;
        $retiredPersonnel->last_name = $request->lname;    //last name added 2/14/2020 by milesh
        $retiredPersonnel->nric = $request->nric;
        $retiredPersonnel->address = $request->address;
        $retiredPersonnel->job_category=$request->job_category;  //job_category added 2/14/2020 by milesh
        $retiredPersonnel->state = $request->state;
        $retiredPersonnel->city = $request->person_city;
        $retiredPersonnel->age = $request->age;
        $retiredPersonnel->email = $request->email;
        $retiredPersonnel->phone = $request->phone;
        $retiredPersonnel->country = $request->country;
        if($request->file('resume_file')){
            $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

            $request->resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $retiredPersonnel->resume = $image;
        }
        $retiredPersonnel->save();
        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');
        Mail::to($user)->send(new SendPasswordAfterRegistration('DefPassRetired'));
        // Auth::login($user);
        //Send notification to admins
        $data = $user;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new RetiredPersonnelRegistration($data));
        return view('admin.retired.index');     //redirect to profile addeb by milesh 2/18/2020
        // return redirect()->route('retiredPersonnelExperience.create');
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
