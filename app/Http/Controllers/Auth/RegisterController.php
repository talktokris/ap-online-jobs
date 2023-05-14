<?php

namespace App\Http\Controllers\Auth;

use Session;
use Storage;
use App\User;
use App\Country;
use App\Profile;
use App\AgentProfile;
use App\EmployerProfile;
use App\ProfessionalProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AgentApplication;
use Illuminate\Support\Facades\Validator;
use App\Notifications\EmployerApplication;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewJobSeekerRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\SendPasswordAfterRegistration;
use App\Notifications\SendMailToEmployerAfterRegistration;
use App\Notifications\SendMailToAgentAfterRegistration;
use Illuminate\Http\Request;
use Image; /* https://github.com/Intervention/image */

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

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
        }elseif(Auth::user()->hasRole('agent')){
            
            return '/agent';
        }elseif(Auth::user()->hasRole('part-timer')){
            return '/agent';
        }elseif(Auth::user()->hasRole('professional')){
            Session::flash('message', 'Information saved successfully!!'); 
            Session::flash('alert-class', 'alert-success');
            return route('qualification.edit', Auth::user()->id).'?type='.request('type');
        }else{
            return '/';
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $request = request();
        if($request->file('license_file')){
            $this->validate($request, [
                'license_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }
        if($request->file('company_logo')){
            $this->validate($request, [
                'company_logo' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
        }
        // If agent set defailt values for sign-up
        $role = $data['role'];
        if ($role == 'agent' || $role=='part-timer') {
            if(isset($data['agency_registered_name'])){
                // $data['name'] = $data['agency_registered_name'];
                $data['agency_registered_name']=$data['agency_registered_name'];
            }
            elseif(isset($data['first_name'])){
                $data['first_name']=$data['first_name'].' '.$data['last_name'];
            }
            if(isset($data['email'])){
                $data['email'] = $data['email'];
            }
            elseif(isset($data['per_email'])){
                $data['email'] = $data['per_email'];
            }
            // $data['email'] = $data['agency_email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            $data['phone'] = $data['agency_phone'] ?? '';
        }
        if ($role == 'employer') {
            // $this->validate($request, [
                
            // ]);
            if(isset($data['employer_type'])!=3){
                $this->validate($request, [
                    'email' => 'email|max:255|unique:users',
                    'company_name' => 'required',
                    'company_phone' => 'required',
                    'employer_type' => 'required',
                    // 'g-recaptcha-response' => 'required|captcha',
                    'roc' => 'required|unique:employer_profiles',
                    'company_name' => 'unique:employer_profiles',
                ]);
            }else{
                $this->validate($request, [
                    // 'g-recaptcha-response' => 'required|captcha',
                    'name' => 'required',
                    'employer_type' => 'required',
                    // 'person_country' => 'required'
                ]);
            }

            
            // if(isset($data['employer_type'])=="2"){
            //     $this->validate($request, [
            //         'email' => 'email|max:255|unique:users'
            //     ]);
            // }
            // if(isset($data['employer_type'])=="4"){
            //     $this->validate($request, [
            //         'email' => 'email|max:255|unique:users'
            //     ]);
            // }
            if(isset($data['company_name'])){
                // $com_name= $data['company_name'];
                $data['company_name']= $data['company_name'];
            }
            elseif(isset($data['name'])){
                // $com_name=$data['name'];
                $data['name']=$data['name'];
            }
            
            if(isset($data['email'])){
                // $com_email=$data['email'];
                $data['email']=$data['email'];
            }
            elseif($data['contact_email'])
            {
                // $com_email=$data['contact_email'];
                $data['contact_email']=$data['contact_email'];
            }
            // $data['name'] = $data['name'];
            // $data['email'] = $data['email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            $data['phone'] = $data['phone'] ?? '';  
        }

        return Validator::make($data, [
            'name' => 'sometimes|string|max:255',
            // 'email' => 'string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agreement' => 'required',
            'role' => 'required',
        ]);
    }
    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // If agent set defailt values for sign-up
        $request = request();
        // dd($request->all());
        $role = $data['role'];
        if ($role == 'agent' || $role=='part-timer') {
            // return Validator::make($data, [
            //     'per_email' => 'string|email|max:255|unique:users',
            // ]);
            if(isset($data['agency_registered_name'])){
                // $data['name'] = $data['agency_registered_name'];
                $data['name']=$data['agency_registered_name'];
            }
            if(isset($data['first_name'])){
                $data['name']=$data['first_name'];
            }
            if(isset($data['last_name'])){
                $data['last_name']=$data['last_name'];
            }
            if(isset($data['agency_phone'])){
                $data['phone'] = $data['agency_phone'];
            }
            if(isset($data['contact_phone'])){
                $data['phone'] = $data['contact_phone'];
            }
            // $data['name'] = $data['agency_registered_name'];
            if(isset($data['email'])){
                $data['email'] = $data['email'];
            }
            elseif(isset($data['per_email'])){
                $data['email'] = $data['per_email'];
            }
            // $data['email'] = $data['agency_email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            // $data['phone'] = $data['agency_phone'] ?? '';
        }
        if ($role == 'employer') {
            // dd('testsss');
            // $this->validate($request, [
            //     'roc' => 'required|unique:employer_profiles',
            // ]);
            // $validator = Validator::make($data, [
            //     'email' => 'string|email|max:255|unique:users'
            // ]);
            
            // if ($validator->fails()) { 
            //     return ;
            // }

            // $employer=EmployerProfile::get();
            // foreach($employer as $em){
            //     if($em->roc==$request->roc){
            //         Session::flash('message', 'Roc Already Exists!');
            //         return 'test';
            //     }
            // }
            $data['name'] = $data['name'];
            if(isset($data['contact_email'])){
                $user_email = $data['contact_email'];
            }
            else{
                $user_email = $data['email'];
            }
            // $data['email'] = $data['email'];
            $data['password'] = "DefPassEmployer";
            $data['password_confirmation'] = "DefPassEmployer";
            $data['phone'] = $data['phone'] ?? '';
        }

        $user = new User;
        $user->name = $data['name'] ?? '';
        $user->name = $data['name'] ?? '';
        if(isset($data['email'])){
            $com_email=$data['email'];
        }
        elseif($data['contact_email'])
        {
            $com_email=$data['contact_email'];
        }
        if(isset($data['last_name'])){
            $data['last_name']=$data['last_name'];
        }
        $user->email = $com_email;
        $user->phone = $data['phone'] ?? '';
        $user->password = Hash::make($data['password']);
        $user->public_id = time().md5($com_email);

        // User wise status
        if($role == 'maid' || $role == 'worker'){
            $user->status = 1;
        }elseif($role == 'agent' || $role=='part-timer'){
            $user->status = 0;
        }
        
        if(isset($data['company_country'])){
            $user_country = $data['company_country'];
        }elseif(isset($data['country'])){
            $user_country = $data['country'];
        }elseif(isset($data['agency_country'])){
            $user_country = $data['agency_country'];
        }elseif(isset($data['per_country'])){
            $user_country = $data['per_country'];
        }
        
        $user->code = $this->user_code($user_country);
        // Notification::send($user, new SendPasswordAfterRegistration($data['password'],$data['email']));
        $user->save();

        if($role == 'maid' || $role == 'worker'){
            $user->status = 1;
        }elseif($role == 'agent'){
            $user->status = 0;
        }
        
        if(isset($data['company_country'])){
            $user_country = $data['company_country'];
        }elseif(isset($data['country'])){
            $user_country = $data['country'];
        }elseif(isset($data['per_country'])){
            $user_country = $data['per_country'];
        }
        
        $user->code = $this->user_code($user_country);
        // $user->code = $this->user_code($data['country']);
        $user->save();
  
        if($role == 'maid' || $role == 'worker' || $role == 'agent' || $role=='part-timer'){
            $user->attachRole($role);
        }
        
        if($role == 'maid' || $role == 'worker'){
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->agent_code = 'self';
            $profile->name = $user->name;
            $profile->phone = $user->phone;
            $profile->save();
        }

        if($role == 'employer'){
            // dd('test');
            // $rules = [
            //     'g-recaptcha-response' => 'required|captcha',
            // ];
            // $validator = Validator::make($request->all(),$rules);
            // if ($validator->fails()) {
            //     Session::flash('message', 'Please check the recaptcha');
            //     return;
                
            // }
            // $this->validate($request, [
            //     'g-recaptcha-response' => 'required|captcha',
            // ]);
            $user->name = $data['name'] ?? '';
            if(isset($data['email'])){
                $com_email=$data['email'];
            }
            elseif($data['contact_email'])
            {
                $com_email=$data['contact_email'];
            }
            $user->email = $com_email;
            // $user->email = $user_email;
            $user->phone = $data['company_phone'] ?? '';
            $user->password = Hash::make($data['password']);
            $user->public_id = time().md5($data['email']);
            $user->attachRole($role);
            $employer = new EmployerProfile;
            $employer->user_id = $user->id;
            //$employer->address = $data['address'];
            $employer->country = $data['country'];
            // $employer->nric = $data['nric'];
            $employer->roc = $data['roc'];

            if(isset($data['company_state'])){
                $com_state=$data['company_state'];
            }
            elseif(isset($data['state'])){
                $com_state=$data['state'];
            }
            $employer->state = $com_state;
            if(isset($data['email'])){
                $com_email=$data['email'];
            }
            elseif($data['contact_email'])
            {
                $com_email=$data['contact_email'];
            }
            $employer->company_email = $com_email;


            if(isset($data['contact_email'])){
                $cont_email=$data['contact_email'];
            }
            elseif($data['email'])
            {
                $cont_email=$data['email'];
            }
            $employer->contact_email = $cont_email;

            if(isset($data['company_name'])){
                $com_name= $data['company_name'];
            }
            elseif(isset($data['name'])){
                $com_name=$data['name'];
            }
            $employer->company_name = $com_name;
            $employer->company_address = $data['company_address'];
            // $employer->postcode = $data['postcode'];

            if(isset($data['company_city'])){
                $com_city= $data['company_city'];
            }
            elseif(isset($data['city'])){
                $com_city=$data['city'];
            }
            $employer->company_city = $com_city;

            if(isset($data['company_country'])){
                $com_country=$data['company_country'];
            }
            elseif(isset($data['country'])){
                $com_country=$data['country'];
            }
            $employer->company_country = $com_country;
            $employer->company_phone = $data['company_phone'];
            $employer->website = $data['website'];
            $employer->employer_type = $data['employer_type'];
            $employer->looking_for_pro = $data['looking_for_pro'] ?? null;
            $employer->looking_for_gw = $data['looking_for_gw'] ?? null;
            $employer->looking_for_dm = $data['looking_for_dm'] ?? null;
            $employer->looking_for_rp=$data['looking_for_rp'] ?? null;
            // $request = request();
            // if($request->file('company_logo')){
            //     $image_basename = explode('.',$request->file('company_logo')->getClientOriginalName())[0];
            //     $image = $image_basename . '-' . time() . '.' . $request->file('company_logo')->getClientOriginalExtension();

            //     $request->company_logo->storeAs('public', $image);
    
            //     //add new image path to database
            //     $employer->company_logo = $image;
                
            // }

            $employer->save();

            // if(isset($data['looking_for_pro']) || isset($data['looking_for_gw']) || isset($data['looking_for_rp']) ){
            //     Notification::send($user, new SendMailToEmployerAfterRegistration($data['company_name']));
            // }else{
            //     Notification::send($user, new SendMailToEmployerAfterRegistration($data['name']));
            // }
            
            Session::flash('message', 'Your Employer Application Submitted Successfully!!'); 
            //Your Employer Applications under review
            Session::flash('alert-class', 'alert-success');

            //Send notification to admins
            $data = $employer;
            $admins = User::whereRoleIs('superadministrator')->get();
            Notification::send($admins, new EmployerApplication($data));
        }

        if($role == 'agent' || $role=='part-timer'){
            // Mail::to('devfaysal@gmail.com')
            // ->send(new SendPasswordAfterRegistration());

            $agent = new AgentProfile;
            $agent->user_id = $user->id;
            $agent->agent_code = time();
            $agent->agent_type=$data['role'];
            if(isset($data['agency_registered_name']) !=''){
                // $data['name'] = $data['agency_registered_name'];
                $data['name']=$data['agency_registered_name'];
                $agent->agency_registered_name = $data['name'];
            }
            // elseif(isset($data['first_name'])){
            //     $data['name']=$data['first_name'].' '.$data['last_name'];
            // }
            $agent->agency_registration_no = $data['agency_registration_no'] ?? '';
            $agent->license_no = $data['license_no'] ?? '';


            if(isset($data['agency_country'])){
                $data['country']=$data['agency_country'];
            }
            elseif(isset($data['per_country'])){
                $data['country']=$data['per_country'];
            }
            $agent->agency_country = $data['country'];

            if(isset($data['agency_state'])){
                $data['state']=$data['agency_state'];
            }
            elseif(isset($data['per_state'])){
                $data['state']=$data['per_state'];
            }
            $agent->agency_state =  $data['state'];

            if(isset($data['agency_city'])){
                $data['city']=$data['agency_city'];
            }
            elseif(isset($data['per_city'])){
                $data['city']=$data['per_city'];
            }
            $agent->agency_city = $data['city'];

            if(isset($data['agency_address'])!=''){
                $data['address']=$data['agency_address'];
                $agent->agency_address = $data['address'] ?? '';
            }
            if(isset($data['per_address'])!=''){
                $data['address']=$data['per_address'];
                $agent->address = $data['address'] ?? '';
            }
            
            if(isset($data['contact_phone2'])!=''){
                $agent->contact_phone2 = $data['contact_phone2'] ?? '';
            }


            if(isset($data['agency_phone'])){
                $data['phone'] = $data['agency_phone'];
            }
            elseif(isset($data['contact_phone'])){
                $data['phone'] = $data['contact_phone'];
            }
            $agent->agency_phone = $data['phone'];
            // $agent->agency_fax = $data['agency_fax'];
            if(isset($data['email'])){
                $data['email'] = $data['email'];
            }
            elseif(isset($data['per_email'])){
                $data['email'] = $data['per_email'];
            }
            $agent->agency_email = $data['email'];

            
            // $agent->license_issue_date = $data['license_issue_date'];
            // $agent->license_expire_date = $data['license_expire_date'];

            // $request = request();

            // if($request->file('license_file')){
            //     $image_basename = explode('.',$request->file('license_file')->getClientOriginalName())[0];
            //     $image = $image_basename . '-' . time() . '.' . $request->file('license_file')->getClientOriginalExtension();

            //     $request->license_file->storeAs('public', $image);
    
            //     // $img = Image::make($request->file('license_file')->getRealPath());
            //     // $img->stream();
    
            //     // //Upload image
            //     // Storage::disk('local')->put('public/'.$image, $img);
    
            //     //add new image path to database
            //     $agent->license_file = $image;
                
            // }
            //Point of Contact
            $agent->first_name = $data['first_name'];
            // $agent->middle_name = $data['middle_name'];
            $agent->last_name = $data['last_name'];
            $agent->contact_phone = $data['contact_phone'];


            // $agent->designation = $data['designation'];
            // $agent->address = $data['address'];
            // $agent->nationality = $data['nationality'];
            $agent->passport = $data['passport'];
            // if($request->file('passport_file')){
            //     $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            //     $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

            //     $request->passport_file->storeAs('public', $image);
            //     // $img = Image::make($request->file('passport_file')->getRealPath());
            //     // $img->stream();
    
            //     // //Upload image
            //     // Storage::disk('local')->put('public/'.$image, $img);
    
            //     //add new image path to database
            //     $agent->passport_file = $image;
                
            // }
            //$agent->nic = $data['nic'];
            
            // $agent->contact_email = $data['contact_email'];
            $agent->save();
            
            //Send notification to admins
            //$data = $agent;
            // Notification::send($user, new SendPasswordAfterRegistration($data['password'],$data['email']));
            // if($data['agency_registered_name']!=''){

            //     Notification::send($user, new SendMailToAgentAfterRegistration($data['agency_registered_name']));
            // }
            // else{
            //     Notification::send($user, new SendMailToAgentAfterRegistration($data['first_name']));
            // }
            $admins = User::whereRoleIs('superadministrator')->get();
            Notification::send($admins, new AgentApplication($agent));
        }

        if($role == 'professional'){
            $request = request();
            $user->attachRole($role);
            $professional = new ProfessionalProfile;
            $professional->user_id = $user->id;
            $professional->name = $request->name;
            $professional->email = $request->email;
            $professional->phone = $request->phone;
            $professional->job_category=$request->job_category;
            if($request->file('resume_file')){
                $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
                $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

                $request->resume_file->storeAs('public/resume', $image);
    
                //add new image path to database
                $professional->resume_file = $image;
            }
            $professional->save();
        }

        $admins = User::whereRoleIs('superadministrator')->get();
        // Notification::send($admins, new NewJobSeekerRegistered($user));
        // Session::flash('message', ucfirst($role).' Registered successfully!!'); 
        // Session::flash('alert-class', 'alert-success');
        return $user;
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
