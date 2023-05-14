<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\UserProfile;
use DB;
use App\State;
use App\Country;
use App\Option;
use App\ProfessionalProfile;
use App\Mail\SendPasswordAfterRegistration;
use App\Notifications\NewJobSeekerRegistered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\AgentProfile;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::with('professional_profile.job_seeker_job_category_data')->where('status', 0)->whereRoleIs('professional')->get();
        // dd($users->professional_profile->job_seeker_job_category_data->name);
        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
        // $users=DB::table('professional_profiles')
        //             ->leftjoin('countries','countries.id','=','professional_profiles.country')
        //             ->leftjoin('users','users.id','=','professional_profiles.user_id')
        //             ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //             ->select('professional_profiles.name','professional_profiles.profile_image','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
        //             ->where('users.status','=',1)
        //             ->where('professional_profiles.agent_code','=',auth()->user()->id)
        //             ->get();
        //     return $users;


        // $professional_count = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->count();
        // return view('admin.professional.index', compact('professional_count'));
        return view('admin.professional.index');
    }

    public function getProfessionalsData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a href="'.route('professional.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                if(auth()->user()->hasRole('superadministrator')){
                    $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.professional.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';   //block button addde by milesh 3/11/2020
                }
                
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->professional_profile->job_seeker_country_data['name'] ?? '';
            })
            ->addColumn('city', function($user) {
                return $user->professional_profile->job_seeker_city_data['name'] ?? '';
            })
            ->addColumn('profile_image', function($user) {
                $img = $user->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$user->professional_profile['profile_image']) :  asset('images/dummy.jpg');
                return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('name', function($user) {
                return $user->professional_profile['name'];
            })
            ->addColumn('email', function($user) {
                return $user->professional_profile['email'];
            })
            ->addColumn('created_at', function($user) {
                $date=$user->professional_profile['created_at'];
                // $createDate=new DateTime($date);
                // $strip = $createDate->format('Y-m-d');
                $timeStamp = date( "m/d/Y", strtotime($date));
                // return $date;
                return $timeStamp;
            })

            ->addColumn('position_name', function($user) {
                if($user->professional_profile['job_category']!=''){
                return $user->professional_profile->job_seeker_job_category_data['name'];
                }else{
                    return 'N/A';
                }
            })
            ->rawColumns(['profile_image', 'action'])
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('professional_profiles')
                        ->leftjoin('countries','countries.id','=','professional_profiles.country')
                        ->leftjoin('cities','cities.id','=','professional_profiles.city')
                        ->leftjoin('users','users.id','=','professional_profiles.user_id')
                        ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                        ->select('professional_profiles.name','cities.name as city','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','professional_profiles.country','users.created_at','users.name')
                        ->where('users.status','=',0)
                        ->where('professional_profiles.country','=',$user_country)
                        ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.professional.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';   //block button addde by milesh 3/11/2020
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->company_country ?? '';
            })
            ->addColumn('city', function($user) {
                return $user->city ?? '';
            })
            ->addColumn('profile_image', function($user) {
                $img = $user->profile_image != '' ? asset('storage/resume/'.$user->profile_image) :  asset('images/dummy.jpg');
                return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->addColumn('email', function($user) {
                return $user->email;
            })
            ->rawColumns(['profile_image', 'action'])
            ->removeColumn('password')
            ->make(true);
        }
        if(auth()->user()->hasRole('sub-agent')){
            $users=DB::table('professional_profiles')
                ->leftjoin('countries','countries.id','=','professional_profiles.country')
                ->leftjoin('cities','cities.id','=','professional_profiles.city')
                ->leftjoin('users','users.id','=','professional_profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('professional_profiles.name','cities.name as city','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                ->where('users.status','=',0)
                ->where('professional_profiles.agent_code','=',auth()->user()->id)
                ->get();
                return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                    
                    // $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.professional.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';   //block button addde by milesh 3/11/2020
                    // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
                    return $string;
                })
                ->addColumn('country', function($user) {
                    return $user->company_country ?? '';
                })
                ->addColumn('city', function($user) {
                    return $user->city ?? '';
                })
                ->addColumn('profile_image', function($user) {
                    $img = $user->profile_image != '' ? asset('storage/resume/'.$user->profile_image) :  asset('images/dummy.jpg');
                    return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('name', function($user) {
                    return $user->name;
                })
                ->addColumn('email', function($user) {
                    return $user->email;
                })
                ->rawColumns(['profile_image', 'action'])
                ->removeColumn('password')
                ->make(true);
    
        }
        if(auth()->user()->hasRole('part-timer')){
            $users=DB::table('professional_profiles')
                ->leftjoin('countries','countries.id','=','professional_profiles.country')
                ->leftjoin('cities','cities.id','=','professional_profiles.city')
                ->leftjoin('users','users.id','=','professional_profiles.user_id')
                ->leftjoin('agent_profiles','agent_profiles.user_id','=','users.id')
                ->select('professional_profiles.name','cities.name as city','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                ->where('users.status','=',0)
                ->where('professional_profiles.agent_code','=',auth()->user()->id)
                ->get();
                return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                    $string .= '<a href="'.route('professional.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                    // $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.professional.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';   //block button addde by milesh 3/11/2020
                    // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
                    return $string;
                })
                ->addColumn('country', function($user) {
                    return $user->company_country ?? '';
                })
                ->addColumn('city', function($user) {
                    return $user->city ?? '';
                })
                ->addColumn('profile_image', function($user) {
                    $img = $user->profile_image != '' ? asset('storage/resume/'.$user->profile_image) :  asset('images/dummy.jpg');
                    return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('name', function($user) {
                    return $user->name;
                })
                ->addColumn('email', function($user) {
                    return $user->email;
                })
                ->rawColumns(['profile_image', 'action'])
                ->removeColumn('password')
                ->make(true);
    
        }
    }
    // add by milesh 3/11/2020
    public function professionalBlocked()
    {
        // $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
        // $users=DB::table('professional_profiles')
        //             ->leftjoin('countries','countries.id','=','professional_profiles.country')
        //             ->leftjoin('users','users.id','=','professional_profiles.user_id')
        //             ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
        //             ->select('professional_profiles.name','professional_profiles.profile_image','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
        //             ->where('users.status','=',2)
        //             ->where('professional_profiles.country','=',$user_country)
        //             ->get();
        //     return $users;
        return view('admin.professional.professionalBlocked');
    }
    public function getBlockedProfessionalsData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = User::with('professional_profile')->where('status', 2)->whereRoleIs('professional')->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                    if(auth()->user()->hasRole('superadministrator')){
                        $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.professional.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';   //block button addde by milesh 3/11/2020
                        $string .= '<a class="btn btn-xs btn-info" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
                    }
                    
                    // 
                    return $string;
                })
                ->addColumn('country', function($user) {
                    return $user->professional_profile->job_seeker_country_data['name'] ?? '';
                })
                ->addColumn('city', function($user) {
                    return $user->professional_profile->job_seeker_city_data['name'] ?? '';
                })
                ->addColumn('profile_image', function($user) {
                    $img = $user->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$user->professional_profile['profile_image']) :  asset('images/dummy.jpg');
                    return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('name', function($user) {
                    return $user->professional_profile['name'];
                })
                ->addColumn('email', function($user) {
                    return $user->professional_profile['email'];
                })
                ->rawColumns(['profile_image', 'action'])
                ->removeColumn('password')
                ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');
            $users=DB::table('professional_profiles')
                        ->leftjoin('countries','countries.id','=','professional_profiles.country')
                        ->leftjoin('cities','cities.id','=','professional_profiles.city')
                        ->leftjoin('users','users.id','=','professional_profiles.user_id')
                        ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                        ->select('professional_profiles.name','cities.name as city','professional_profiles.profile_image','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                        ->where('users.status','=',2)
                        ->where('professional_profiles.country','=',$user_country)
                        ->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('admin.professional.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';   //block button addde by milesh 3/11/2020
                // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
                return $string;
            })
            ->addColumn('country', function($user) {
                return $user->country ?? '';
            })
            ->addColumn('city', function($user) {
                return $user->city ?? '';
            })
            ->addColumn('profile_image', function($user) {
                $img = $user->profile_image != '' ? asset('storage/resume/'.$user->profile_image) :  asset('images/dummy.jpg');
                return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->addColumn('email', function($user) {
                return $user->email;
            })
            ->rawColumns(['profile_image', 'action'])
            ->removeColumn('password')
            ->make(true);
        }
    }

    // 3/11/2020
    public function delete(User $user)
    {
        if($user->professional_profile){
            $user->professional_profile->delete();
        }

        foreach($user->professional_experiences as $experience){
            $experience->delete();
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.professional.index');
    }
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
        $options= Option::where([
            ['status','=','1'],
            ['type','=','Position Name'],
            ])->get();
        return view('admin.professional.create',compact('countrys','states','options'));
    }
    public function store(Request $request){
        // return $request;

        $user = new User;
        $user->public_id = time().md5($request->email);
        $user->name = $request->name;
        $user->last_name = $request->lname ?? '';
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('DefPassRetired');
        $user->status= '0';
        $user_country = $request->country;
        $user->code = $this->user_code($user_country);
        $user->save();
        $user->attachRole('professional');

        $professional = new ProfessionalProfile;
        $professional->user_id = $user->id;
        $professional->agent_code = auth()->user()->id;
        $professional->name = $request->name;
        $professional->last_name = $request->lname ?? '';
        
        $professional->address=$request->address;
        $professional->nric=$request->nric ?? '';
        $professional->job_category=$request->job_category;
        $professional->country=$request->country;
        $professional->state=$request->state;
        $professional->city=$request->city;
        $professional->phone = $request->phone;
        $professional->email = $request->email;
        if($request->file('resume_file')){
            $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

            $request->resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $professional->resume_file = $image;
        }
        $professional->save();
        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');
        Mail::to($user)->send(new SendPasswordAfterRegistration('DefPassRetired'));
        // Auth::login($user);
        //Send notification to admins
        $data = $user;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new NewJobSeekerRegistered($data));
        return view('admin.professional.index');
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
