<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;

use Session;
use Storage;
use App\User;
use App\Skill;
use App\Gender;
use App\Sector;
use App\Country;
use App\State;
use App\UserProfile;
use App\Profile;
use App\Language;
use App\Religion;
use App\Education;
use App\Experience;
use App\SkillLevel;
use App\AgentProfile;
use App\MaritalStatus;
use App\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendPasswordAfterRegistration;
use App\Notifications\AgentDataUpdate;
use App\Notifications\MaidWorkerEntry;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AgentApplication;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image; /* https://github.com/Intervention/image */

class AgentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // use RegistersUsers;
      /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    public function redirectTo()
    {
        if(Auth::user()->hasRole('employer')){
            return '/employer/profile';
        }elseif(Auth::user()->hasRole('agent','part-timer')){
            // dd('test');
            return '/agent';
        }elseif(Auth::user()->hasRole('professional')){
            Session::flash('message', 'Information saved successfully!!'); 
            Session::flash('alert-class', 'alert-success');
            return route('qualification.edit', Auth::user()->id).'?type='.request('type');
        }else{
            return '/';
        }
    }

    public function index()
    {
        if(!auth()->user()){
            abort(404);
        }
        $user = auth()->user();
        if($user->status != 1){
            $user=User::with('agent_profile')->where('id',Auth::user()->id)->first();
            return view('agent.review', compact('user'));
        }
        $workers_maids = User::whereHas('profile', function ($q) {
            $user = auth()->user();
            $q->where('agent_code', $user->agent_profile->agent_code);
        })->get();
        if(Session::has('message')){
            Session::flash('message', Session::get('message')); 
            Session::flash('alert-class', Session::get('alert-class'));
        }
        return redirect('/admin');
        //return view('agent.show', compact('user', 'workers_maids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(auth()->user()){
        //     return redirect('/');
        // }
        $countrys = Country::where('status', 1)->get();
        $nationalitys = $countrys;
        return view('agent.create_test', compact('countrys','nationalitys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->business_partner=='company'){
            $user = new User;
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;     //last name added 2/14/2020 by milesh
            $user->email = $request->company_email;
            $user->phone = $request->contact_phone;
            $password=Hash::make('DefPassAgent');
            $user->password = $password;
            $user->public_id = time().md5($request->company_email);
            $user_country = $request->company_country;
            $user->code = $this->user_code($user_country);
            $user->save();
            $user->attachRole('retired');
            $agent = new AgentProfile;
            $agent->agent_type=$request->business_partner;
            $agent->user_id = $user->id;
            $agent->agent_code = time();
            $agent->agency_registered_name = $request->agency_registered_name;
            $agent->agency_registration_no =$request->agency_registration_no;
            $agent->license_no=$request->agency_license_no;
            $agent->agency_country=$request->company_country;
            $agent->agency_state=$request->company_state;
            $agent->agency_city=$request->company_city;
            $agent->agency_address=$request->company_address ?? '';
            $agent->agency_phone =$request->company_phone;
            $agent->agency_email=$request->company_email;
            $agent->first_name=$request->first_name;
            $agent->last_name=$request->last_name ?? '';
            $agent->contact_phone=$request->contact_phone;
            $agent->save();
         
        }
        if($request->business_partner=='individual'){
            $user = new User;
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;     //last name added 2/14/2020 by milesh
            $user->email = $request->per_email;
            $user->phone = $request->contact_phone;
            $password=Hash::make('DefPassAgent');
            $user->password = $password;
            $user->public_id = time().md5($request->company_email);
            $user_country = $request->per_country;
            $user->code = $this->user_code($user_country);
            $user->save();
            $user->attachRole('agent');



            $agent = new AgentProfile;
            $agent->agent_type=$request->business_partner;
            $agent->user_id = $user->id;
            $agent->agent_code = time();
            $agent->agency_registered_name = $request->first_name.' '.$request->last_name;
            $agent->agency_registration_no =$request->passport ?? '';
            $agent->license_no=$request->passport ?? '';
            $agent->agency_country=$request->per_country;
            $agent->agency_state=$request->per_state;
            $agent->agency_city=$request->per_city;
            $agent->agency_address=$request->per_address ?? '';
            $agent->agency_phone =$request->contact_phone;
            $agent->agency_email=$request->per_email;
            $agent->first_name=$request->first_name;
            $agent->last_name=$request->last_name ?? '';
            $agent->contact_phone=$request->contact_phone;
            $agent->contact_phone2=$request->contact_phone2;
            $agent->nic=$request->passport;
            $agent->contact_email=$request->per_email;
            $agent->address=$request->per_address;
            

            $agent->save();
        }
        Notification::send($user, new SendPasswordAfterRegistration($password));
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new AgentApplication($agent));
        return redirect('admin.agent.index');
        // return 'user'user()->hasRole('agent');
        // return view('admin.index')->;
        // return redirect()->route('admin');
        // return view(admin.index);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(AgentProfile $agentProfile)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(User $agent)
    {
        // dd($agent->agent_profile->user_id);
        //return $agent->agent_profile;
        $countrys = Country::where('status', 1)->get();
        $user = User::where('id', $agent->agent_profile->user_id)->first();
        $nationalitys = $countrys;
        $agentProfile = $agent->agent_profile;
        return view('agent.edit', compact('agent','agentProfile','countrys','nationalitys','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $agent)
    {
        // dd($agent->id);

        // $this->validate($request, [
        //     'email' => 'required|string|email|max:255|unique:users',
        // ]);
        $user = User::where('id', $agent->id)->first();
        $user->name = $request->first_name;
        $user->email = $request->per_email;
        $user->phone = $request->phone;
        $user->save();

        //return $agent;
        $agent_profile = $agent->agent_profile;
        $agent_profile->agency_registered_name = $request->agency_registered_name;
        $agent_profile->agency_registration_no=$request->agency_registration_no;
        $agent_profile->license_no = $request->license_no;
        $agent_profile->agency_country = $request->agency_country??$request->per_country;
        $agent_profile->agency_state = $request->agency_state ?? $request->per_state;
        $agent_profile->agency_city = $request->agency_city ?? $request->per_city;
        $agent_profile->agency_address = $request->agency_address;
        $agent_profile->agency_phone = $request->agency_phone;
        // $agent_profile->agency_fax = $request->agency_fax;
        $agent_profile->agency_email = $request->email ?? $request->per_email;
     
        $agent_profile->license_issue_date = $request->license_issue_date;
        $agent_profile->license_expire_date = $request->license_expire_date;

        if($request->file('license_file')){
            $this->validate($request, [
                'license_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
            
            $image_basename = explode('.',$request->file('license_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('license_file')->getClientOriginalExtension();

            $request->license_file->storeAs('public', $image);

            // $img = Image::make($request->file('license_file')->getRealPath());
            // $img->stream();

            // //Upload image
            // Storage::disk('local')->put('public/'.$image, $img);

            //remove existing file
            if($agent_profile->license_file != ''){
                Storage::disk('local')->delete('public/'.$agent_profile->license_file);
            }
            //add new image path to database
            $agent_profile->license_file = $image;
            
        }
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
            $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

            $request->passport_file->storeAs('public', $image);
            // $img = Image::make($request->file('passport_file')->getRealPath());
            // $img->stream();

            // //Upload image
            // Storage::disk('local')->put('public/'.$image, $img);

            //remove existing file
            if($agent_profile->passport_file != ''){
                Storage::disk('local')->delete('public/'.$agent_profile->passport_file);
            }
            //add new image path to database
            $agent_profile->passport_file = $image;
            
        }
        //Point of Contact
        $agent_profile->first_name = $request->first_name;
        // $agent_profile->middle_name = $request->middle_name;
        $agent_profile->last_name = $request->last_name;
        $agent_profile->contact_phone = $request->contact_phone;
        $agent_profile->contact_phone2 = $request->contact_phone2;
        $agent_profile->passport = $request->passport;
        $agent_profile->contact_email = $request->contact_email;
        
        $agent_profile->address = $request->per_address;
        $agent_profile->designation = $request->designation;
        $agent_profile->nationality = $request->nationality;
        
        
       
        $agent_profile->save();

        Session::flash('message', 'Profile Updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to admins
        $data = $agent_profile;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new AgentDataUpdate($data));

        if(auth()->user()->hasRole('superadministrator')){
            return redirect()->route('admin.agent.index');
        }
        return redirect()->route('agent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgentProfile $agentProfile)
    {
        //
    }

    public function createuser()
    {
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $skill_levels = SkillLevel::where('status', '=', 1)->get();
        $marital_statuses = MaritalStatus::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        $skills = Skill::where('status', '=', 1)->get();
        $education_levels = EducationLevel::where('status', '=', 1)->get();
        $sectors = Sector::where('status', '=', 1)->get();
        

        if(auth()->user()->hasRole('superadministrator|agent|part-timer')){
            return view('agent.createuser', compact('religions','nationalitys','languages','skill_levels','marital_statuses','genders','skills','education_levels','sectors'));
        }
        if(auth()->user()->hasRole('sub-agent')){
            $user_id = auth()->user()->id;
            $user_country=UserProfile::where('user_id',$user_id)->pluck('company_country');
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
            return view('agent.createuser', compact('religions','nationalitys','languages','skill_levels','marital_statuses','genders','skills','education_levels','sectors','countrys','states'));
        }
    }

    public function saveuser( Request $request)
    {

        /*Validation*/
        $this->validate($request, [
            // 'name' => 'required',
            'address' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'nationality'   => 'required',
            'gender'  =>  'required',
            'phone' =>  'required',
            'image' =>  'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_relationship' => 'required',
            'emergency_contact_phone'  =>   'required',
            'emergency_contact_address' =>  'required',
            'passport_number' =>  'required',
            'passport_issue_place'=>'required',
            'passport_issue_date'  =>'required',
            'passport_expire_date'  =>'required',
            'passport_file' =>'required',
            'date_of_birth' => 'date',
            'passport_issue_date' => 'date',
            'passport_expire_date' => 'date',
        ]);
        if($request->file('image')){
            $this->validate($request, [
                'image' => 'required|max:1024',
            ]);
        }
        if($request->file('full_image')){
            $this->validate($request, [
                'full_image' => 'max:1024',
            ]);
        }
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'max:1024',
            ]);
        }
        if($request->file('medical_certificate')){
            $this->validate($request, [
                'medical_certificate' => 'max:1024',
            ]);
        }
        if($request->file('immigration_security_clearence')){
            $this->validate($request, [
                'immigration_security_clearence' => "max:1024"
            ]);
        }
        // if($request->file('image')){
        //     $this->validate($request, [
        //         'image' => 'mimes:jpg,jpeg,png|image|max:1024',
        //     ]);
        // }
        // if($request->file('full_image')){
        //     $this->validate($request, [
        //         'full_image' => 'mimes:jpg,jpeg,png|image|max:1024',
        //     ]);
        // }
        // if($request->file('passport_file')){
        //     $this->validate($request, [
        //         'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
        //     ]);
        // }
        // if($request->file('medical_certificate')){
        //     $this->validate($request, [
        //         'medical_certificate' => 'mimes:pdf,jpg,jpeg,png|max:1024',
        //     ]);
        // }
        // if($request->file('immigration_security_clearence')){
        //     $this->validate($request, [
        //         'immigration_security_clearence' => "mimes:pdf,jpg,jpeg,png|max:1024"
        //     ]);
        // }
        //return request('Drill');
        //return var_dump($request->Welding);
        // $skills = Skill::where('status', '=', 1)->get();
        // foreach($skills as $skill){
        //     $arr[$skill->slug] = request($skill->slug) ?? 'No';
        // }
        // //return $arr;
        // $var = json_encode($arr);
        // $vars= json_decode($var);
        //  $arrs = (array) $vars;
        // foreach($skills as $skill){
        //     $checked = $arrs[$skill->slug] == 'Yes'?  'checked': '';
        //     echo '<label for="able_to_cook">'.$skill->name.'</label>';
        //     echo '<input type="checkbox" id="" name="'.$skill->slug.'" value="Yes"'.$checked.'>';
        // }

        // die();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email ?? time().'@test.com';
        $user->phone = $request->phone;
        $user->password = Hash::make('password');
        $user->public_id = time().md5($user->email);
        $user->status = 1;
        $role = $request->role;
        
        if($role == 'maid'){
            $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
            $do_donts = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Do & Do not')->get();     //added by Milesh 3/26/2020
        }else if($role == 'worker'){
            $skills = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Language')->get();
        }
        $user_country = $request->nationality;
        $user->code = $this->user_code($user_country);
        $user->save();
        $user->attachRole($role);

        $profile = new Profile;
        foreach($skills as $skill){
            $skill_arr[$skill->slug] = request($skill->slug) ?? 'No';
        }
        $profile->skill_set = json_encode($skill_arr);

        foreach($languages as $language){
            $lang_arr[$language->slug] = request($language->slug) ?? 'No';
        }
        $profile->language_set = json_encode($lang_arr);

        if($role == 'maid'){
            //added by Milesh 3/26/2020
            foreach($do_donts as $do_dont){
                $do_dont_arr[$do_dont->slug] = request($do_dont->slug) ?? 'No';
            }
            $profile->do_dont = json_encode($do_dont_arr);
            //end 3/26/2020
        }
        if($request->file('image')){
            $image_basename = explode('.',$request->file('image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $img = Image::make($request->file('image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->image != ''){
                Storage::disk('local')->delete('public/'.$profile->image);
            }

            //add new image path to database
            $profile->image = $image;
            
        }

        if($request->file('full_image')){
            $image_basename = explode('.',$request->file('full_image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('full_image')->getClientOriginalExtension();

            $img = Image::make($request->file('full_image')->getRealPath());
            $img->stream();

            //Upload image
            Storage::disk('local')->put('public/'.$image, $img);

            //Remove if there was any old image
            if($profile->full_image != ''){
                Storage::disk('local')->delete('public/'.$profile->full_image);
            }

            //add new image path to database
            $profile->full_image = $image;
            
        }

        if($request->file('passport_file')){            
            $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

            $request->passport_file->storeAs('public', $image);
            // $img = Image::make($request->file('passport_file')->getRealPath());
            // $img->stream();

            // //Upload image
            // Storage::disk('local')->put('public/'.$image, $img);

            // //Remove if there was any old image
            // if($profile->passport_file != ''){
            //     Storage::disk('local')->delete('public/'.$profile->passport_file);
            // }

            //add new image path to database
            $profile->passport_file = $image;
            
        }

        if($request->file('medical_certificate')){          
            $image_basename = explode('.',$request->file('medical_certificate')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('medical_certificate')->getClientOriginalExtension();

            $request->medical_certificate->storeAs('public', $image);
            //$request->file('medical_certificate')->move('storage/public', $request->file('medical_certificate')->getRealPath());
            // $img = Image::make($request->file('medical_certificate')->getRealPath());
            // $img->stream();

            // //Upload image
            // Storage::disk('local')->put('public/'.$image, $img);

            // //Remove if there was any old image
            // if($profile->medical_certificate != ''){
            //     Storage::disk('local')->delete('public/'.$profile->medical_certificate);
            // }

            //add new image path to database
            $profile->medical_certificate = $image;
            
        }

        if($request->file('immigration_security_clearence')){
            $image_basename = explode('.',$request->file('immigration_security_clearence')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('immigration_security_clearence')->getClientOriginalExtension();

            $request->immigration_security_clearence->storeAs('public', $image);
            // $img = Image::make($request->file('immigration_security_clearence')->getRealPath());
            // $img->stream();

            // //Upload image
            // Storage::disk('local')->put('public/'.$image, $img);

            // //Remove if there was any old image
            // if($profile->immigration_security_clearence != ''){
            //     Storage::disk('local')->delete('public/'.$profile->immigration_security_clearence);
            // }

            //add new image path to database
            $profile->immigration_security_clearence = $image;
            
        }

        $profile->user_id = $user->id;
        $profile->other_skills = $request->other_skills;
        if(auth()->user()->hasRole('superadministrator|agent|part-timer')){
            $profile->agent_code = $request->agent_code;
        }
        if(auth()->user()->hasRole('sub-agent')){
            $profile->agent_code = auth()->user()->id;
        }
        
        $profile->name = $request->name;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->address = $request->address;
        $profile->district = $request->district;
        $profile->country = $request->company_country;
        $profile->city = $request->company_city;
        $profile->state = $request->company_state;
        $profile->nationality = $request->nationality;
        $profile->gender = $request->gender;
        $profile->marital_status = $request->marital_status;
        $profile->children = $request->children;
        $profile->siblings = $request->siblings;
        $profile->religion = $request->religion;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->father_name = $request->father_name;
        $profile->mother_name = $request->mother_name;
        $profile->father_contact_number = $request->father_contact_number;
        $profile->sector_id = $request->sector;
        $profile->sub_sector_id = $request->sub_sector;

        /*Emergency Contact*/
        $profile->emergency_contact_name = $request->emergency_contact_name;
        $profile->emergency_contact_relationship = $request->emergency_contact_relationship;
        $profile->emergency_contact_phone = $request->emergency_contact_phone;
        $profile->emergency_contact_address = $request->emergency_contact_address;

        /*Passport Info*/
        $profile->passport_number = $request->passport_number;
        $profile->passport_issue_date = $request->passport_issue_date;
        $profile->passport_issue_place = $request->passport_issue_place;
        $profile->passport_expire_date = $request->passport_expire_date;
        

        $profile->save();

        if($request->employer_name && $request->employer_name[0] != null){
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
        if($request->education_level && $request->education_level[0] != null){
            for($i=0; $i< count($request->education_level); $i++){
                $education = new Education;
                $education->user_id = $user->id;
                $education->education_level = $request->education_level[$i];
                $education->education_remark = $request->education_remark[$i];
                $education->save();
            }
        }
        
        Session::flash('message', ucfirst($role).' Created successfully!! now update profile'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to admins
        $data = $user;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new MaidWorkerEntry($data));

        return redirect()->route('admin.home');
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


    public function print($id, $data)
    {
        $user = User::where('id', $id)->first();
        $profile = $user->agent_profile;
        return view('agent.print', compact('data', 'profile'));
    }
}
