<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\UserProfile;
use DB;
use App\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use App\Education;
use App\Experience;
use App\Gender;
use App\Country;
use App\Religion;
use App\MaritalStatus;
use App\State;
use App\EducationLevel;
use App\Skill;
use App\Language;
use Image;
use Storage;

class PMaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::with('part_time_maid')->where('status', 0)->whereRoleIs('part-time-maid')->get();
        // return $users;
        return view('admin.partTimeMaid.index');
    }
    public function getPartTimeMaidsData()
    {
        $users = User::with('part_time_maid')->where('status', 0)->whereRoleIs('part-time-maid')->get();
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string  = '<a href="'.route('maid.show', $user->public_id).'" class="btn btn-xs btn-primary">View</a> ';
            $string .= '<a href="'.route('maid.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
            $string .= '<a class="ml-1 btn btn-success" href="'.route('maid.approve', $user->id).'" onclick="return confirm(\'Are you sure?\')">Approve</a>';
            $string .= '<a class="ml-1 btn btn-danger" href="'.route('maid.reject', $user->id).'" onclick="return confirm(\'Are you sure?\')">Reject</a>';
            return $string;
        })
        ->addColumn('country', function($user) {
            return $user->part_time_maid->company_country_data['name'] ?? '';
        })
        ->addColumn('state', function($user) {
            return $user->part_time_maid->company_state_data['name'] ?? '';
        })
        ->addColumn('city', function($user) {
            return $user->part_time_maid->company_city_data['name'] ?? '';
        })
        ->addColumn('work_as', function($user) {
            if($user->part_time_maid->work_as == 1){
                return 'Maid';
            }elseif($user->part_time_maid->work_as == 2){
                return 'Driver';
            }elseif($user->part_time_maid->work_as == 3){
                return 'Home Nurse';
            }else{
                return 'No Data';
            }
        })
        ->make(true);
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
    public function show($public)
    {
        // if(auth()->user()->status != 1){
        //     if(auth()->user()->hasRole('employer')){
        //         return redirect()->route('employer.show');
        //     }elseif(auth()->user()->hasRole('agent')){
        //         return redirect()->route('agent.index');
        //     }
        // }
        $user = User::where('public_id', '=', $public)->first();
        $experiences = Experience::where('user_id', $user->id)->get();
        $educations = Education::where('user_id', $user->id)->get();

        $maid = $user->part_time_maid;
        $skill_set = (array) json_decode($maid->skill_set);
        $language_set = (array) json_decode($maid->language_set);
        $do_dont_set = (array) json_decode($maid->do_dont);          //added by milesh 3/26/2020
        $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $do_donts = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Do & Do not')->get();     //added by milesh 3/26/2020
        return view('admin.partTimeMaid.show', compact('skill_set','do_dont_set','skills','do_donts','experiences','educations','user','maid','language_set','languages'));    //added by milesh 3/26/2020
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return "edit";
        $user = User::where('id', $id)->first();
        $maid = $user->part_time_maid;
        $genders = Gender::where('status', '=', 1)->get();
        $marital_statuses = MaritalStatus::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $religions = Religion::where('status', '=', 1)->get();
        $states = State::where('status','=',1)->get();
        $education_levels = EducationLevel::where('status', '=', 1)->get();
        $skills = Skill::where('status', '=', 1)->get();
        $skill_set = (array) json_decode($maid->skill_set);
        $language_set = (array) json_decode($maid->language_set);
        $languages = Language::where('status', '=', 1)->get();
        $do_dont_set = (array) json_decode($maid->do_dont);
        // return $skill_set;
        return view('admin.partTimeMaid.edit', compact('maid','user','genders','marital_statuses','nationalitys','religions','states','education_levels','skills','skill_set','language_set','languages','do_dont_set'));
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
        // return $request;
        $user = User::where('id', $id)->first();
        $maid = $user->part_time_maid;
        $user->name = $request->name;
        $user->email = $request->email ?? time().'@test.com';
        $user->phone = $request->phone;
        $user->save();
        $this->validate($request, [
            'date_of_birth' => 'date'            
        ]);
        if($request->file('image')){
            $this->validate($request, [
                'image' => 'image|max:1024',
            ]);
        }
        //Fetch all skils
        $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $do_donts = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Do & Do not')->get(); 
        foreach($skills as $skill){
            $skill_arr[$skill->slug] = request($skill->slug) ?? 'No';
        }
        $maid->skill_set = json_encode($skill_arr);
        foreach($languages as $language){
            $lang_arr[$language->slug] = request($language->slug) ?? 'No';
        }
        $maid->language_set = json_encode($lang_arr);
        foreach($do_donts as $do_dont){
            $do_dont_arr[$do_dont->slug] = request($do_dont->slug) ?? 'No';
        }
        $maid->do_dont = json_encode($do_dont_arr);
        $maid->other_skills = $request->other_skills;
        // $maid->name = $request->name;
        $maid->date_of_birth = $request->date_of_birth;
        $maid->address = $request->address;
        $maid->id_number = $request->id_number;
        $maid->district = $request->district;
        $maid->country = $request->company_country;
        $maid->city = $request->company_city;
        $maid->state = $request->company_state;
        $maid->nationality = $request->nationality;
        $maid->gender = $request->gender;
        $maid->marital_status = $request->marital_status;
        $maid->children = $request->children;
        $maid->siblings = $request->siblings;
        $maid->religion = $request->religion;
        $maid->height = $request->height;
        $maid->weight = $request->weight;
        $maid->work_as = $request->work_as;
        $maid->email = $request->email;
        $maid->phone = $request->phone;
        $maid->father_name = $request->father_name;
        $maid->mother_name = $request->mother_name;
        // $maid->father_contact_number = $request->father_contact_number;
        // $maid->sector_id = $request->sector;
        // $maid->sub_sector_id = $request->sub_sector;

        /*Emergency Contact*/
        $maid->emergency_contact_name = $request->emergency_contact_name;
        $maid->emergency_contact_relationship = $request->emergency_contact_relationship;
        $maid->emergency_contact_phone = $request->emergency_contact_phone;
        $maid->emergency_contact_address = $request->emergency_contact_address;

        if($request->file('image')){
            $image_basename = explode('.',$request->file('image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($maid->image != ''){
                Storage::disk('local')->delete('public/'.$profile->image);
            }

            //add new image path to database
            $maid->image = $image;
            
        }
        $maid->save();
        if($request->employer_name){
            foreach($user->experiences as $experience){
                $experience->delete();
            }

            for($i=0; $i< count($request->employer_name); $i++){
                $experience = new Experience;
                $experience->user_id = $user->id;
                $experience->employer_name = $request->employer_name[$i];
                $experience->country = $request->country[$i];
                $experience->from_date = $request->from_date[$i];
                $experience->to_date = $request->to_date[$i];
                $experience->remark = $request->remark[$i];
                $experience->save();
            }
        }
        if($request->education_level){
            foreach($user->educations as $education){
                $education->delete();
            }
            for($i=0; $i< count($request->education_level); $i++){
                $education = new Education;
                $education->user_id = $user->id;
                $education->education_level = $request->education_level[$i];
                $education->education_remark = $request->education_remark[$i];
                $education->save();
            }
        }
        Session::flash('message', 'Information saved successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('maid.index');

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
    public function reject($id)
    {
        $user = User::where('id', $id)->first();

        $user->status = -1;
        $user->save();
        Session::flash('message', 'Application Rejected!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }
    public function ActivePartTimeMaids(){
        // return "active";
        return view('admin.partTimeMaid.active');
    }
    public function getActivePartTimeMaidsData(){
        $users = User::with('part_time_maid')->where('status', 1)->whereRoleIs('part-time-maid')->get();
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string  = '<a href="'.route('maid.show', $user->public_id).'" class="btn btn-xs btn-primary">View</a> ';
            $string .= '<a href="'.route('maid.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
            $string .= '<a class="ml-1 btn btn-danger" href="'.route('maid.block', $user->id).'" onclick="return confirm(\'Are you sure?\')">Block</a>';
            return $string;
        })
        ->addColumn('country', function($user) {
            return $user->part_time_maid->company_country_data['name'] ?? '';
        })
        ->addColumn('state', function($user) {
            return $user->part_time_maid->company_state_data['name'] ?? '';
        })
        ->addColumn('city', function($user) {
            return $user->part_time_maid->company_city_data['name'] ?? '';
        })
        ->addColumn('work_as', function($user) {
            if($user->part_time_maid->work_as == 1){
                return 'Maid';
            }elseif($user->part_time_maid->work_as == 2){
                return 'Driver';
            }elseif($user->part_time_maid->work_as == 3){
                return 'Home Nurse';
            }else{
                return 'No Data';
            }
        })
        ->make(true);
    }
    public function BlockedPartTimeMaids(){
        // return "active";
        return view('admin.partTimeMaid.blocked');
    }
    public function getBlockedPartTimeMaidsData(){
        $users = User::with('part_time_maid')->where('status', 2)->whereRoleIs('part-time-maid')->get();
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string  = '<a href="'.route('maid.show', $user->public_id).'" class="btn btn-xs btn-primary">View</a> ';
            $string .= '<a href="'.route('maid.edit', $user->id).'" class="btn btn-xs btn-info">Edit</a> ';
            $string .= '<a class="ml-1 btn btn-danger" href="'.route('maid.unblock', $user->id).'" onclick="return confirm(\'Are you sure?\')">UnBlock</a>';
            return $string;
        })
        ->addColumn('country', function($user) {
            return $user->part_time_maid->company_country_data['name'] ?? '';
        })
        ->addColumn('state', function($user) {
            return $user->part_time_maid->company_state_data['name'] ?? '';
        })
        ->addColumn('city', function($user) {
            return $user->part_time_maid->company_city_data['name'] ?? '';
        })
        ->addColumn('work_as', function($user) {
            if($user->part_time_maid->work_as == 1){
                return 'Maid';
            }elseif($user->part_time_maid->work_as == 2){
                return 'Driver';
            }elseif($user->part_time_maid->work_as == 3){
                return 'Home Nurse';
            }else{
                return 'No Data';
            }
        })
        ->make(true);
    }
}
