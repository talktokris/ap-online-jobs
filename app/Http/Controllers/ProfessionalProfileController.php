<?php

namespace App\Http\Controllers;

use Session;
use App\Option;
use App\City;
use App\User;
use App\Country;
use App\JobApplicant;
use Carbon\Carbon;
use App\Qualification;
use App\Traits\OptionTrait;
use App\ProfessionalProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordAfterRegistration;
use App\Notifications\NewJobSeekerRegistered;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\ProfessionalExperience;
use Illuminate\Support\Facades\Auth;

class ProfessionalProfileController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('test');
        if(Auth::user()){
            return redirect()->route('professional.profile');
        }
        return view('professional.index');
    }

    public function profile()
    {
        $user = Auth::user();
        $totalExperience = $this->calculateTotalYearsOfExperience($user);

        // dd($totalExperience);
        return view('professional.show', [
            'user' => $user,
            'totalExperience' => $totalExperience
        ]);
    }

    public function calculateTotalYearsOfExperience($user)
    {
        if($user==''){
            return 0;
        }
        if($user->professional_experiences->count() > 0){

            foreach($user->professional_experiences as $experience){

                $all_from_dates[] = $experience->from;
    
                $all_to_dates[] = $experience->to ?? date('Y-m-d', time());
    
            }
    
            $from = min($all_from_dates);
    
            $to = max($all_to_dates);
    
            return Carbon::parse($from)->diffInYears(Carbon::parse($to));
        }

        return 0;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::where('status', 1)->get();
        
        $options= Option::where([
            ['status','=','1'],
            ['type','=','Position Name'],
        ])->get();
        return view('professional.create', compact('countrys','options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'name'  => 'required',
            'address'   =>'required',
            'job_category'  => 'required',
            'country'   =>'required',
            'state' =>'required',
            'city'  =>'required',
            'phone' =>'required',
            // 'email' => 'required|string|email|max:255',
        ]);
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }
        // Create use
        $user = new User;
        $user->name = $request->name;
        $user->last_name = $request->lname ?? '';     //last name added 2/14/2020 by milesh
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make('DefPassRetired');
        $user->public_id = time().md5($request->email);
        $user_country = $request->country;
        $user->code = $this->user_code($user_country);
        $user->save();
        $user->attachRole('professional');
        $professional = new ProfessionalProfile;
        $professional->user_id = $user->id;
        $professional->name = $request->name;
        $professional->resume_headline = $request->job_category ?? '';
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
        // Mail::to($user)->send(new SendPasswordAfterRegistration('DefPassRetired',$request->email));
        Auth::login($user);
        //Send notification to admins
        $data = $user;
        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new NewJobSeekerRegistered($data));
        return view('professional.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd('test');
        $user = User::where('id', $id)->first();
        // dd($user);
        $totalExperience = $this->calculateTotalYearsOfExperience($user);
        return view('professional.show', [
            'user' => $user,
            'totalExperience' => $totalExperience
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $professional)
    {
        // dd('test');
        $PositionNames = $this->getOptions('Position Name');
        $countrys = Country::where('status', 1)->get();
        $citys= City::where('status',1)->get();

        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');
        $applicants = JobApplicant::where('user_id',$professional->id)->first();
        // dd($applicants);
        return view('professional.edit',[
            'user' => $professional,
            'countrys' => $countrys,
            'citys'=>$citys,
            'PositionNames' => $PositionNames,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys,
            'applicants' => $applicants,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $professional)
    {
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }
        if($request->file('profile_image')){
            $this->validate($request, [
                'profile_image' => 'image|max:1024',
            ]);
        }
        
        // return $professional;
        $user = User::where('id', $professional->id)->first();
        $user->name = $request->name;
        $user->last_name = $request->lname;     //last name added 2/14/2020 by milesh
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        $professional = $professional->professional_profile;
        $professional->name = $request->name;
        $professional->last_name = $request->lname;
        $professional->address=$request->address;
        $professional->nric=$request->nric;
        $professional->job_category=$request->resume_headline;
        $professional->resume_headline = $request->resume_headline;
        $professional->skills = $request->skills;
        $professional->it_skills = $request->it_skills;
        $professional->country = $request->country;
        $professional->state=$request->state;
        $professional->city = $request->city;
        // $professional->current_salary = $request->current_salary;
        $professional->expected_salary = $request->expected_salary;
        $professional->email = $request->email;
        $professional->phone = $request->phone;
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

        if($request->designation){
            foreach($user->professional_experiences as $professional_experience){
                $professional_experience->delete();
            }

            for($i=0; $i< count($request->designation); $i++){
                $professional_experience = new ProfessionalExperience;
                $professional_experience->user_id = $user->id;
                $professional_experience->designation = $request->designation[$i];
                $professional_experience->company = $request->company[$i];
                $professional_experience->from = $request->from_date[$i];
                // if($request->to_year[$i]){
                    $professional_experience->to =  $request->to_date[$i];
                // }
                $professional_experience->position_level = $request->position_level[$i];
                $professional_experience->experience_description = $request->experience_description[$i];
                $professional_experience->is_present_job = $request->is_present_job[$i];
                $professional_experience->save();
            }

            if($request->qualification){
                foreach($user->qualifications as $qualification){
                    $qualification->delete();
                }
    
                for($i=0; $i< count($request->qualification); $i++){
                    $qualification = new Qualification;
                    $qualification->user_id = $user->id;
                    $qualification->qualification = $request->qualification[$i];
                    $qualification->subject = $request->subject[$i];
                    $qualification->specialization = $request->specialization[$i];
                    $qualification->others=$request->others[$i];        //added by milesh 2_21_2020
                    $qualification->university = $request->university[$i];
                    $qualification->graduation_date = $request->graduation_date[$i];
                    $qualification->save();
                }
                
            }

            if($request->hired){
                    $statusforhired = JobApplicant::where('user_id', $professional->user_id)->first();
                    $statusforhired->invited_by_employer = $request->hired;
                    $statusforhired->save();
                
            }
        }
        Session::flash('message', 'Profile Updated Successfully!'); 
        Session::flash('alert-class', 'alert-success');
        // return redirect()->route('professional.profile');
        return redirect()->route('admin.professional.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfessionalProfile  $professionalProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalProfile $professionalProfile)
    {
        //
    }

    public function editQualification(User $user)
    {
        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');

        return view('professional.editQualification', [
            'user' => $user,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys
        ]);
    }

    public function updateQualification(Request $request, User $user)
    {
        if($request->qualification){
            foreach($user->qualifications as $qualification){
                $qualification->delete();
            }

            for($i=0; $i< count($request->qualification); $i++){
                $qualification = new Qualification;
                $qualification->user_id = $user->id;
                $qualification->qualification = $request->qualification[$i];
                $qualification->subject = $request->subject[$i];
                $qualification->specialization = $request->specialization[$i];
                $qualification->others=$request->others[$i];        //added by milesh 2_21_2020
                $qualification->university = $request->university[$i];
                $qualification->graduation_date = $request->graduation_year[$i] .'-'. $request->graduation_month[$i].'-'. $request->graduation_day[$i];
                $qualification->save();
            }
            if(request('type') == 'pro'){
                return redirect()->route('professionalExperience.edit', $user->id);
            }else{
                return redirect()->route('professional.profile'); 
            }
            
        }
    }

    public function editProfessionalExperience(User $user)
    {
        return view('professional.editProfessionalExperience', [
            'user' => $user
        ]);
    }

    public function updateProfessionalExperience(Request $request, User $user)
    {
        if($request->designation){
            foreach($user->professional_experiences as $professional_experience){
                $professional_experience->delete();
            }

            for($i=0; $i< count($request->designation); $i++){
                $professional_experience = new ProfessionalExperience;
                $professional_experience->user_id = $user->id;
                $professional_experience->designation = $request->designation[$i];
                $professional_experience->company = $request->company[$i];
                $professional_experience->from = $request->from_year[$i] .'-'. $request->from_month[$i].'-'. '1';
                if($request->to_year[$i]){
                    $professional_experience->to = $request->to_year[$i] .'-'. $request->to_month[$i].'-'. '1';
                }
                $professional_experience->position_level = $request->position_level[$i];
                $professional_experience->experience_description = $request->experience_description[$i];
                $professional_experience->is_present_job = $request->is_present_job[$i];
                $professional_experience->save();
            }

            return redirect()->route('professional.profile');
        }
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
