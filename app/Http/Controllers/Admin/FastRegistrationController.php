<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\FastRegistratin;
use App\Traits\OptionTrait;
use App\Country;
use App\State;
use App\City;
use App\BlueWorkerExperience;
use App\BlueWorkerEducation;
use App\EducationLevel;
use Yajra\DataTables\Facades\DataTables;
use Session;

class FastRegistrationController extends Controller
{
    use OptionTrait;

    public function index()
    {
        // $users = FastRegistratin::with('state','city')->orderBy('id','desc')->get();
        // dd($users);
        return view('admin.fast_registration.index');
    }

    public function getFastRegistrationData()
    {
        if(auth()->user()->hasRole('superadministrator|administrator')){
            $users = FastRegistratin::with('state','city','job_seeker_job_category_data')->orderBy('id','desc')->get();
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('admin.fast.registration.detail', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a href="'.route('admin.fast.registration.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
                $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.fast.registration.delete', $user->id).'">Delete</a>';
                
                return $string;
            })
            ->addColumn('full_name', function($user) {
                return $user->full_name ?? '';
            })
            ->addColumn('job_category', function($user) {
                return $user->job_seeker_job_category_data->name ?? '';
            })
            ->addColumn('number', function($user) {
                return $user->number ?? '';
            })
            ->addColumn('state_name', function($user) {
                return $user->state->name;
            })
            ->addColumn('city_name', function($user) {
                return $user->city->name;
            })
            ->addColumn('created_at', function($user) {
                $date=$user->created_at->format('Y-m-d');
                return $date;
            })
            ->rawColumns(['action'])
            // ->rawColumns(['profile_image', 'action'])
            // ->removeColumn('password')
            ->make(true);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // return response()->json(['success'=>$request], 200); 
        try{
            $crud=new FastRegistratin;
            $crud->full_name = $request->full_name;
            $crud->email = $request->email;
            $crud->number = $request->number;
            $crud->job_category = $request->job_category;
            $crud->state_id = $request->company_state;
            $crud->person_country = '3';
            $crud->city_id = $request->company_city;
            $crud->save();
            return response()->json(['success'=>$crud], 200); 
            // Session::flash('message', 'User Created Successfully!!'); 
            // return redirect(route('home'));
        }catch(\Exception $e){ 
            return response()->json(['status'=>$e->getMessage()], 500);
            // Session::flash('message', 'Something went wrong!!'); 
            // dd($e->getMessage());
        }

    }
    public function show($id)
    {
        $professional = FastRegistratin::with('city','state','job_seeker_job_category_data','blue_worker_experience','blue_worker_education')->where('id', $id)->first();
        return view('admin.fast_registration.show',[
            'user' => $professional,
        ]);
    }

    public function edit($id)
    {
        // dd('test');
        $professional = FastRegistratin::with('city','state','job_seeker_job_category_data','blue_worker_experience','blue_worker_education')->where('id', $id)->first();
        $PositionNames = $this->getOptions('Blue Worker Position Name');
        $countrys = Country::where('status', 1)->where('id',3)->get();
        $citys= City::where('status',1)->get();
        $state= State::where('status',1)->where('country_id',3)->get();
        $education_levels = EducationLevel::where('status', '=', 1)->get();
        return view('admin.fast_registration.edit',[
            'user' => $professional,
            'countrys' => $countrys,
            'citys'=>$citys,
            'state'=>$state,
            'PositionNames' => $PositionNames,
            'education_levels' => $education_levels
        ]);
    }

    public function update(Request $request, $id)
    {
        //  dd($request->all());
        // if($request->file('resume_file')){
        //     $this->validate($request, [
        //         'resume_file' => 'mimes:pdf,doc,docx|max:1024',
        //     ]);
        // }
        // if($request->file('profile_image')){
        //     $this->validate($request, [
        //         'profile_image' => 'image|max:1024',
        //     ]);
        // }
        
        // return $professional;
        $professional = FastRegistratin::where('id', $id)->first();
        // $professional = $professional->professional_profile;
        $professional->full_name = $request->full_name;
        $professional->address = $request->address;
        $professional->nric=$request->nric;
        $professional->job_category=$request->job_category;
        // $professional->job_category=$request->resume_headline;
        // $professional->resume_headline = $request->resume_headline;
        $professional->skills = $request->skills;
        $professional->it_skills = $request->it_skills;
        $professional->person_country = $request->country;
        $professional->state_id=$request->state;
        $professional->city_id = $request->city;
        // $professional->current_salary = $request->current_salary;
        $professional->expected_salary = $request->expected_salary;
        $professional->email = $request->email;
        $professional->number = $request->phone;

        $professional->dob = $request->dob;
        if($request->file('resume_file')){
            $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

            $request->resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $professional->resume_file = $image;
            
        }
        if($request->file('modified_resume_file')){
            $image_basename = explode('.',$request->file('modified_resume_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('modified_resume_file')->getClientOriginalExtension();

            $request->modified_resume_file->storeAs('public/resume', $image);

            //add new image path to database
            $professional->modified_resume_file = $image;
        }
        if($request->file('profile_image')){
            $image_basename = explode('.',$request->file('profile_image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('profile_image')->getClientOriginalExtension();

            $request->profile_image->storeAs('public/resume', $image);

            //add new image path to database
            $professional->profile_image = $image;
            
        }
        $professional->save();

        if($request->company_name){
            // dd('test');
            foreach($professional->blue_worker_experience as $experience){
                $experience->delete();
            }

            for($i=0; $i< count($request->company_name); $i++){
                $experience = new BlueWorkerExperience;
                $experience->blue_worker_registration_id = $professional->id;
                $experience->company = $request->company_name[$i];
                $experience->designation = $request->designation[$i];
                $experience->from = $request->from_date[$i];
                $experience->to = $request->to_date[$i];
                $experience->experience_description = $request->experience_description[$i];
                $experience->save();
            }
        }

        if($request->education_level){
            foreach($professional->blue_worker_education as $education){
                $education->delete();
            }
            for($i=0; $i< count($request->education_level); $i++){
                $education = new BlueWorkerEducation;
                $education->blue_worker_registration_id = $professional->id;
                $education->education_level = $request->education_level[$i];
                $education->education_remark = $request->education_remark[$i];
                $education->save();
            }
        }
        Session::flash('message', 'Profile Updated Successfully!'); 
        Session::flash('alert-class', 'alert-success');
        // return redirect()->route('professional.profile');
        return redirect()->route('admin.fast.registration');
    }

    public function destroy($id)
    {
        $blue_worker = FastRegistratin::find($id);
        $blue_worker->blue_worker_experience()->delete();
        $blue_worker->blue_worker_education()->delete();
        $blue_worker->delete();
        return redirect()->route('admin.fast.registration');
    }
}
