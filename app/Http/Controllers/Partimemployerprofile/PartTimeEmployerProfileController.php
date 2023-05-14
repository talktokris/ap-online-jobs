<?php

namespace App\Http\Controllers\Partimemployerprofile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Country;
use App\PartTimeEmployer;
use Illuminate\Support\Facades\Auth;
use Session;
use App\City;
use App\Maid;
use App\Education;
use App\Experience;
use App\Skill;
use App\State;

class PartTimeEmployerProfileController extends Controller
{

    public function index(Request $request)
    {
        $user_profile=Auth::user();
        return view('partimemployerprofile.index', compact('user_profile'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {  
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $user_profile=Auth::user();
        $employer = PartTimeEmployer::where('user_id',$user_profile->id)->first();
        $state=State::where('country_id',3)->get();
        $city=City::get();
        $countrys = Country::where('status', 1)->get();
        return view('partimemployerprofile.edit', compact('user_profile','employer','state','countrys','city'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

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
            $pt_employer->name = $request->name;
            if($request->file('passport_file')){
                $pt_employer->passport_file = $passport_file;
            }
            if($request->file('passport_file_back')){
                $pt_employer->passport_file_back = $passport_file_back;
            }
            $pt_employer->save();
            Session::flash('message', 'Your Profile has been updated successfully!!'); 
            return redirect(route('partimemployerprofile.edit',$id));
        }catch(\Exception $e){
            Session::flash('message', 'Something Went Wrong'); 
            return redirect(route('partimemployerprofile.edit',$id));
        }
    }

    public function destroy($id)
    {
    }

    public function upgradePlan($user_id)
    {
        $user_profile=Auth::user();
        return view('partimemployerprofile.upgrade_plan',compact('user_profile'));
    }

    public function passwordChangeForm($user_id)
    {
        $user_profile=Auth::user();
        return view('partimemployerprofile.password_change_form',compact('user_id','user_profile'));
    }

    public function changePassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();

            return redirect()->route('login');
        }else{
            Session::flash('message', 'Old Password Does not match!'); 
            return redirect()->back();
        }
    }

    public function jobseekerList(Request $request,$user_id)
    {
        $user_profile=Auth::user();
        $pt_employer=PartTimeEmployer::where('user_id',$user_id)->first();
        // dd($pt_employer);
        $city=City::where('state_id',$pt_employer->state)->get();
        
        if($pt_employer->looking_for_home_nurse=='1' && $pt_employer->looking_for_maid=='1' && $pt_employer->looking_for_driver=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [1,2,3])->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [1,2,3])->where('city',$pt_employer->city)->paginate(10);
            }
           

        }elseif($pt_employer->looking_for_home_nurse=='1' && $pt_employer->looking_for_maid=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [1,3])->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [1,3])->where('city',$pt_employer->city)->paginate(10);
            }

        }elseif($pt_employer->looking_for_maid=='1' && $pt_employer->looking_for_driver=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [1,2])->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [1,2])->where('city',$pt_employer->city)->paginate(10);
            }

        }elseif($pt_employer->looking_for_home_nurse=='1' && $pt_employer->looking_for_driver=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [2,3])->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->whereIn('work_as', [2,3])->where('city',$pt_employer->city)->paginate(10);
            }

        }elseif($pt_employer->looking_for_home_nurse=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->where('work_as', 3)->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->where('work_as', 3)->where('city',$pt_employer->city)->paginate(10);
            }

        }elseif($pt_employer->looking_for_maid=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->where('work_as', 1)->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->where('work_as', 1)->where('city',$pt_employer->city)->paginate(10);
            }

        }elseif($pt_employer->looking_for_driver=='1'){
            if($request->city){
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->where('work_as', 2)->where('city',$request->city)->paginate(10);
            }else{
                $job_seeker_list=Maid::with('user','company_country_data','company_state_data','company_city_data')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->orderBy('created_at', 'desc')->where('work_as', 2)->where('city',$pt_employer->city)->paginate(10);
            }

        }else{
            $job_seeker_list='';
        }
        // dd($job_seeker_list);
        // if($request->city){
        //     $job_seeker_list=$job_seeker_list->where('city',$request->city);
        // }
        // $job_seeker_list=$job_seeker_list->where('')
        return view('partimemployerprofile.jobseeker_list',compact('user_profile','job_seeker_list','pt_employer','city','user_id'));
    }

    public function jobseekerDetail($id){
        $user_profile=Auth::user();
        $user = User::where('id', '=', $id)->first();
        $experiences = Experience::where('user_id', $user->id)->get();
        $educations = Education::where('user_id', $user->id)->get();

        $maid = $user->part_time_maid;
        $skill_set = (array) json_decode($maid->skill_set);
        $language_set = (array) json_decode($maid->language_set);
        $do_dont_set = (array) json_decode($maid->do_dont);          //added by milesh 3/26/2020
        $skills = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Skill')->get();
        $languages = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Language')->get();
        $do_donts = Skill::where('status', '=', 1)->where('for', 'dm')->where('type','Do & Do not')->get();     //added by milesh 3/26/2020
        return view('partimemployerprofile.jobseeker_Detail', compact('user_profile','skill_set','do_dont_set','skills','do_donts','experiences','educations','user','maid','language_set','languages'));    //added by milesh 3/26/2020
    }
    
}
