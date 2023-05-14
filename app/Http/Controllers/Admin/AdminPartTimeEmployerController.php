<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\City;
use App\State;
use App\Country;
use App\PartTimeEmployer;
use DB;
use Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Mail\SendMailFromEmployer;
use Illuminate\Support\Facades\Mail;

class AdminPartTimeEmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function partTimeEmployer()
    {
        // $parttime= partTimeEmployer::all();
        // $part_time_employers = PartTimeEmployer::with('user','countryName')->whereHas('user', function($q) {
        //     $q->where('status','0');
        // })->get();
        // return $part_time_employers;
        return view('admin.part_time_employer.part_time_employer');
    }
    public function getPartTimeEmployer() {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $part_time_employers = PartTimeEmployer::with('user','countryName')->whereHas('user', function($q) {
                $q->where('status','0');
            })->get();
            
            return DataTables::of($part_time_employers)
            ->addColumn('action', function ($part_time_employer) {
                $string  = '<a href="'.route('parttimeemployer.show', $part_time_employer->id).'" class="btn btn-xs btn-primary">View</a> ';
                // if(auth()->user()->hasRole('superadministrator')){
                $string .= '<a class="ml-1 btn btn-xs btn-info" href="'.route('parttimeemployer.edit', $part_time_employer->user->id).'" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('part-time-employer.delete', $part_time_employer->user->id).'" onclick="return confirm(\'Are you sure?\')"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('part-employer.approve', $part_time_employer->user->id).'" onclick="return confirm(\'Are you sure?\')">Approve</a>';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('part-employer.reject', $part_time_employer->user->id).'" onclick="return confirm(\'Are you sure?\')">Reject</a>';
                // $string .= '<a href="'.route('sendmailview', $part_time_employer->id).'" class="ml-1 btn btn-xs btn-primary">Send Mail</a> ';
                $string .= '<button class="ml-1 btn btn-xs btn-primary" onclick="sendMail('.$part_time_employer->id.')">Send Mail</button> ';
                // }
                return $string;
            })
            ->addColumn('code', function($part_time_employer) {
                return $part_time_employer->user->code;
            })
            ->addColumn('country', function($part_time_employer) {
                return $part_time_employer->countryName->name;
            })
            ->addColumn('address', function($part_time_employer) {
                return $part_time_employer->address;
            })
            ->addColumn('name', function($part_time_employer) {
                return $part_time_employer->name;
            })
            ->addColumn('email', function($part_time_employer) {
                return $part_time_employer->email;
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
    }
    public function activePartTimeEmployer()
    {
        return view('admin.part_time_employer.active_part_time_employer');
    }
    public function getActivePartTimeEmployer() {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $part_time_employers = PartTimeEmployer::with('user','countryName')->whereHas('user', function($q) {
                $q->where('status','1');
            })->get();
            
            return DataTables::of($part_time_employers)
            ->addColumn('action', function ($part_time_employer) {
                $string  = '<a href="'.route('parttimeemployer.show', $part_time_employer->id).'" class="btn btn-xs btn-primary">View</a> ';
                // if(auth()->user()->hasRole('superadministrator')){
                $string .= '<a class="ml-1 btn btn-xs btn-info" href="'.route('parttimeemployer.edit', $part_time_employer->user->id).'" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('part-employer.reject', $part_time_employer->user->id).'" onclick="return confirm(\'Are you sure?\')">Reject</a>';
                $string .= '<button class="ml-1 btn btn-xs btn-primary" onclick="sendMail('.$part_time_employer->id.')">Send Mail</button> ';
                // }
                return $string;
            })
            ->addColumn('code', function($part_time_employer) {
                return $part_time_employer->user->code;
            })
            ->addColumn('country', function($part_time_employer) {
                return $part_time_employer->countryName->name;
            })
            ->addColumn('address', function($part_time_employer) {
                return $part_time_employer->address;
            })
            ->addColumn('name', function($part_time_employer) {
                return $part_time_employer->name;
            })
            ->addColumn('email', function($part_time_employer) {
                return $part_time_employer->email;
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
    }
    public function inactivePartTimeEmployer()
    {
        return view('admin.part_time_employer.inactive_part_time_employer');
    }
    public function getInactivePartTimeEmployer() {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $part_time_employers = PartTimeEmployer::with('user','countryName')->whereHas('user', function($q) {
                $q->where('status','-1');
            })->get();
            
            return DataTables::of($part_time_employers)
            ->addColumn('action', function ($part_time_employer) {
                $string  = '<a href="'.route('parttimeemployer.show', $part_time_employer->id).'" class="btn btn-xs btn-primary">View</a> ';
                // if(auth()->user()->hasRole('superadministrator')){
                $string .= '<a class="ml-1 btn btn-xs btn-info" href="'.route('parttimeemployer.edit', $part_time_employer->user->id).'" ><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                $string .= '<a class="ml-1 btn btn-danger" href="'.route('part-time-employer.delete', $part_time_employer->user->id).'" onclick="return confirm(\'Are you sure?\')"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
                $string .= '<a class="ml-1 btn btn-success" href="'.route('part-employer.approve', $part_time_employer->user->id).'" onclick="return confirm(\'Are you sure?\')">Approve</a>';
                // }
                return $string;
            })
            ->addColumn('code', function($part_time_employer) {
                return $part_time_employer->user->code;
            })
            ->addColumn('country', function($part_time_employer) {
                return $part_time_employer->countryName->name;
            })
            ->addColumn('address', function($part_time_employer) {
                return $part_time_employer->address;
            })
            ->addColumn('name', function($part_time_employer) {
                return $part_time_employer->name;
            })
            ->addColumn('email', function($part_time_employer) {
                return $part_time_employer->email;
            })
            ->rawColumns(['action'])
            ->removeColumn('password')
            ->make(true);
        }
    }
    public function unBlockUser($user_id){
        $user = User::findOrFail($user_id);
        $user->status = '1';
        $user->save();
        Session::flash('message', 'User has been  Un Blocked!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    public function blockUser($user_id){
        $user = User::findOrFail($user_id);
        $user->status = '2';
        $user->save();
        Session::flash('message', 'User has been Blocked!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    public function sendMailView($id){
        $employer = PartTimeEmployer::findOrFail($id);
        return view('admin.part_time_employer.mail', compact('employer'));
    }

    public function sendMail(Request $request,$id){
        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required'
        ]);
        $employer = PartTimeEmployer::findOrFail($id);
        if(!empty($employer->email)){
            $data = [
                'subject' => $request->subject,
                'message' =>  strip_tags($request->message)
            ];
        
            Mail::to($employer->email)->send(new SendMailFromEmployer($data));

            Session::flash('message', 'Mail send sucessfully'); 
            return redirect()->back();
        }else{
            Session::flash('message', 'E-mail does not exist for this user'); 
            return redirect()->back();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $employer = PartTimeEmployer::with('stateName','cityName')->findOrFail($id);
        // print_r($employer);die;
        return view('admin.part_time_employer.show', compact('employer'));
    }

    public function edit($id)
    {
        $employer = PartTimeEmployer::where('user_id',$id)->first();
        $state=State::get();
        $city=City::get();
        $countrys = Country::where('status', 1)->get();
        //return $employer->employer_profile;
        return view('admin.part_time_employer.edit', compact('employer','state','countrys','city'));
    }

    public function update(Request $request, $id)
    {
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'mimes:jpg,jpeg,pdf,png|max:1024',
            ]);
        }

        if($request->file('passport_file_back')){
            $this->validate($request, [
                'passport_file_back' => 'mimes:jpg,jpeg,pdf,png|max:1024',
            ]);
        }

        if($request->file('passport_file')){
            $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            $passport_file = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();
            $request->passport_file->storeAs('public', $passport_file);
        }

        if($request->file('passport_file_back')){
            $image_basename = explode('.',$request->file('passport_file_back')->getClientOriginalName())[0];
            $passport_file_back = $image_basename . '-' . time() . '.' . $request->file('passport_file_back')->getClientOriginalExtension();
            $request->passport_file_back->storeAs('public', $passport_file_back);
        }

        if(!empty($request->service_task)){
            $service_task=$request->service_task;
            $final_service_task=implode(",",$service_task);
        }

        try{
            $user=User::where('id',$id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            $pt_employer=PartTimeEmployer::where('user_id',$id)->first();
            $pt_employer->user_id =  $request->user_id;
            $pt_employer->country = '3';
            $pt_employer->address = $request->address;
            $pt_employer->address2 = $request->address2;
            $pt_employer->state = $request->state;
            $pt_employer->city = $request->city;
            $pt_employer->phone = $request->phone;
            $pt_employer->nric = $request->nric;
            $pt_employer->post_code = $request->post_code;
            $pt_employer->home_phone = $request->home_phone;
            $pt_employer->email = $request->email;
            $pt_employer->service_type = $request->service_type;
            $pt_employer->service_time = $request->service_time;
            $pt_employer->service_task = $final_service_task ?? '';
            $pt_employer->looking_for_maid = $request->looking_for_maid ?? '0';
            $pt_employer->looking_for_driver = $request->looking_for_driver ?? '0';
            $pt_employer->looking_for_home_nurse = $request->looking_for_home_nurse ?? '0';
            if($request->file('passport_file')){
                $pt_employer->passport_file = $passport_file;
            }
            if($request->file('passport_file_back')){
                $pt_employer->passport_file_back = $passport_file_back;
            }
            $pt_employer->name = $request->name;
            $pt_employer->last_name = $request->last_name;
            $pt_employer->save();
            Session::flash('message', 'User Updated Successfully!!'); 
            return redirect(route('partTimeEmployer'));
        }catch(\Exception $e){
            Session::flash('message', 'Something Went Wrong'); 
            return redirect(route('partTimeEmployer'));
        }
    }

    public function reject($id)
    {
        $user = User::where('id', $id)->first();

        $user->status = -1;
        $user->save();
        Session::flash('message', 'Application Rejected!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    public function approve($id)
    {
        // return "approve";
        $user = User::where('id', $id)->first();

        $user->status = 1;
        $user->save();

        Session::flash('message', 'Application Approved!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        $part_time_employer = PartTimeEmployer::where('user_id',$id)->first();
        $part_time_employer->delete();
        Session::flash('message', 'User Deleted Successfully!!');
        return redirect()->back();
    }
}
