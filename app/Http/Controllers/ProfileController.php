<?php

namespace App\Http\Controllers;

use Session;
use Storage;
use App\User;
use App\Skill;
use App\Gender;
use App\Sector;
use App\Country;
use App\Profile;
use App\Language;
use App\Religion;
use App\Education;
use App\Experience;
use App\SkillLevel;
use App\MaritalStatus;
use App\EducationLevel;
use Illuminate\Http\Request;
use Image; /* https://github.com/Intervention/image */

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;
        $experiences = Experience::get();
        if($user->hasRole('professional')){
            return view('profile.professional.show', compact('profile'));
        }elseif($user->hasRole('worker')){
            return view('profile.worker.show', compact('profile','experiences'));
        }elseif($user->hasRole('maid')){
            return view('profile.maid.show', compact('profile'));
        };
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
        // dd('test');
        $user = User::where('id', $id)->first();
        $role = $user->roles->first();
        $skill_for = strtolower($role->display_name);
        $profile = $user->profile;
        $religions = Religion::where('status', '=', 1)->get();
        $nationalitys = Country::where('status', '=', 1)->get();
        $languages = Language::where('status', '=', 1)->get();
        $skill_levels = SkillLevel::where('status', '=', 1)->get();
        $marital_statuses = MaritalStatus::where('status', '=', 1)->get();
        $genders = Gender::where('status', '=', 1)->get();
        $skills = Skill::where('status', '=', 1)->get();
        $skill_set = (array) json_decode($profile->skill_set);
        $language_set = (array) json_decode($profile->language_set);
        $do_dont_set = (array) json_decode($profile->do_dont);          //added by milesh 3/26/2020
        $education_levels = EducationLevel::where('status', '=', 1)->get();
        $sectors = Sector::where('status', '=', 1)->get();
        return view('profile.edit', compact('user','profile','religions','nationalitys','languages','skill_levels','marital_statuses','genders','language_set','skill_set','skills','skill_for','education_levels','sectors','do_dont_set')); //added by milesh 3/26/2020

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
        $user = User::where('id', $id)->first();
        $profile = $user->profile;
        $user->name = $request->name;
        $user->email = $request->email ?? time().'@test.com';
        $user->phone = $request->phone;
        $user->save();
        /*Validation*/
        $this->validate($request, [
            'date_of_birth' => 'date',
            'passport_issue_date' => 'date',
            'passport_expire_date' => 'date',
        ]);

        if($request->file('image')){
            $this->validate($request, [
                'image' => 'image|max:1024',
            ]);
        }
        if($request->file('full_image')){
            $this->validate($request, [
                'full_image' => 'image|max:1024',
            ]);
        }
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('medical_certificate')){
            $this->validate($request, [
                'medical_certificate' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('immigration_security_clearence')){
            $this->validate($request, [
                'immigration_security_clearence' => "mimes:pdf,jpg,jpeg,png|max:1024"
            ]);
        }

        $role = $user->roles->first();
        
        //Fetch all skils for role
        if($role->name == 'maid'){
            $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
            $do_donts = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Do & Do not')->get();     //added by milesh 3/26/2020
        }else if($role->name == 'worker'){
            $skills = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Language')->get();
        }

        //Loop through and save skills
        foreach($skills as $skill){
            $skill_arr[$skill->slug] = request($skill->slug) ?? 'No';
        }
        $profile->skill_set = json_encode($skill_arr);

        foreach($languages as $language){
            $lang_arr[$language->slug] = request($language->slug) ?? 'No';
        }
        $profile->language_set = json_encode($lang_arr);

        //added by Milesh 3/26/2020
        if($role->name == 'maid'){
            foreach($do_donts as $do_dont){
                $do_dont_arr[$do_dont->slug] = request($do_dont->slug) ?? 'No';
            }
            $profile->do_dont = json_encode($do_dont_arr);
        }
        
        //end 3/26/2020

        //Save Other data
        $profile->other_skills = $request->other_skills;
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
        
        //Upload and save files

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

            //Remove if there was any old image
            if($profile->passport_file != ''){
                Storage::disk('local')->delete('public/'.$profile->passport_file);
            }

            //add new image path to database
            $profile->passport_file = $image;
            
        }

        if($request->file('medical_certificate')){          
            $image_basename = explode('.',$request->file('medical_certificate')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('medical_certificate')->getClientOriginalExtension();

            $request->medical_certificate->storeAs('public', $image);

            //Remove if there was any old image
            if($profile->medical_certificate != ''){
                Storage::disk('local')->delete('public/'.$profile->medical_certificate);
            }

            //add new image path to database
            $profile->medical_certificate = $image;
            
        }

        if($request->file('immigration_security_clearence')){
            $image_basename = explode('.',$request->file('immigration_security_clearence')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('immigration_security_clearence')->getClientOriginalExtension();

            $request->immigration_security_clearence->storeAs('public', $image);

            //Remove if there was any old image
            if($profile->immigration_security_clearence != ''){
                Storage::disk('local')->delete('public/'.$profile->immigration_security_clearence);
            }

            //add new image path to database
            $profile->immigration_security_clearence = $image;
            
        }

        $profile->save();

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

        if(auth()->user()->hasRole('agent')){
            return redirect()->route('agent.index');
        }elseif(auth()->user()->hasRole('superadministrator')){
            return redirect()->route('admin.home');
        }
        return redirect()->route('profile.index');

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


    public function public($public)
    {
        if(auth()->user()->status != 1){
            if(auth()->user()->hasRole('employer')){
                return redirect()->route('employer.show');
            }elseif(auth()->user()->hasRole('agent')){
                return redirect()->route('agent.index');
            }
        }
        $user = User::where('public_id', '=', $public)->first();
        $experiences = Experience::where('user_id', $user->id)->get();
        $educations = Education::where('user_id', $user->id)->get();

        $profile = $user->profile;
        $skill_set = (array) json_decode($profile->skill_set);
        $language_set = (array) json_decode($profile->language_set);
        $do_dont_set = (array) json_decode($profile->do_dont);          //added by milesh 3/26/2020
        if($user->hasRole('professional')){
            return view('profile.professional.show', compact('profile'));
        }elseif($user->hasRole('worker')){
            $skills = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'gw')->where('type','Language')->get();
            return view('profile.show', compact('profile','skill_set','language_set','skills','languages','experiences','educations'));
        }elseif($user->hasRole('maid')){
            $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
            $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
            $do_donts = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Do & Do not')->get();     //added by milesh 3/26/2020
            return view('profile.show', compact('profile','skill_set','language_set','skills','languages','experiences','educations','do_donts','do_dont_set'));    //added by milesh 3/26/2020
        };
    }
}
