<?php

namespace App\Providers;

use Session;
use App\State;
use App\User;
use App\UserProfile;
use App\Profile;
use App\AgentProfile;
use DB;
use App\Offer;
use App\Job;
use App\Applicant;
use App\PartTimeEmployer;
use App\FastRegistratin;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view::composer('layouts.app',function($view){
            $states= State::where('status',1)
                            ->where('country_id',3)
                            ->get();
            $view->with('states', $states);
        });
        view::composer('index',function($view){
            $states= State::where('status',1)
                            ->where('country_id',3)
                            ->get();
            $view->with('states', $states);
        });
        View::composer('admin.index', function ($view) {
            $active_employer= count(User::with('employer_profile')->where('status', 1)->whereRoleIs('employer')->get());
            $jobs = count(Job::all());
            $active_business_partner =count(User::with('agent_profile')->whereHas('roles', function($q){$q->whereIn('name', ['part-timer','agent']);})->where('status', 1)->get());
            $job_seekers=count(User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get());
            $retired=count(User::with('retired_personnel')->where('status', 1)->whereRoleIs('retired')->get());
            $foreign_worker = count(User::where('status', 1)->whereRoleIs('worker')->get());
            // $domestic_maid =count(User::where('status', 1)->whereRoleIs('maid')->get());
            $view->with('active_employer', $active_employer ?? '')
            //      ->with('employer_application',$employer_application ?? '')
            //      ->with('employer_demand',$employer_demand)
                ->with('jobs',$jobs)
                ->with('active_business_partner',$active_business_partner ?? '')
            //      ->with('business_partner_application',$business_partner_application ?? '')
            //      ->with('pending_agent_application',$pending_agent_application ?? '')
                ->with('job_seekers',$job_seekers ?? '')
                ->with('retired',$retired ?? '')
                ->with('foreign_worker',$foreign_worker ?? '');
                // ->with('domestic_maid',$domestic_maid ?? '');
            //      ->with('proposed_gw_dm',$proposed_gw_dm)
            //      ->with('blocked_employer',$blocked_employer ?? '')   //add by milesh--3/10/2020
            //      ->with('blocked_business_partner',$blocked_business_partner ?? '')     //add by milesh--3/11/2020
            //      ->with('blocked_job_seekers',$blocked_job_seekers ?? '')    //add by milesh--3/11/2020
            //      ->with('blocked_retired',$blocked_retired ?? '')      //add by milesh--3/11/2020
            //      ->with('part_time_maid_application',$part_time_maid_application ?? '')
            //      ->with('active_part_time_maid',$active_part_time_maid ?? '')
            //      ->with('blocked_part_time_maid',$blocked_part_time_maid ?? '')
            //      ->with('part_time_employers',$part_time_employers ?? '')
            //      ->with('active_part_time_employers',$active_part_time_employers ?? '')
            //      ->with('inactive_part_time_employers',$inactive_part_time_employers ?? '');
        });
        View::composer('admin.layouts.master', function ($view) {
            
            if(auth()->user()->hasRole('part-timer')){
                $agent_code = AgentProfile::where('user_id',auth()->user()->id)->pluck('agent_code');

                $active_employer=DB::table('employer_profiles')
                ->leftjoin('countries','countries.id','=','employer_profiles.country')
                ->leftjoin('users','users.id','=','employer_profiles.user_id')
                ->leftjoin('agent_profiles','agent_profiles.user_id','=','users.id')
                ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('employer_profiles.agent_code','=',auth()->user()->id)
                ->count();

                $job_seekers=DB::table('professional_profiles')
                ->leftjoin('countries','countries.id','=','professional_profiles.country')
                ->leftjoin('cities','cities.id','=','professional_profiles.city')
                ->leftjoin('users','users.id','=','professional_profiles.user_id')
                ->leftjoin('agent_profiles','agent_profiles.user_id','=','users.id')
                ->select('professional_profiles.name','cities.name as city','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                ->where('users.status','=',0)
                ->where('professional_profiles.agent_code','=',auth()->user()->id)
                ->count();

                $retired=DB::table('retired_personnels')
                ->leftjoin('countries','countries.id','=','retired_personnels.country')
                ->leftjoin('users','users.id','=','retired_personnels.user_id')
                // ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('retired_personnels.agent_code','=',auth()->user()->id)
                ->count();


                $foreign_worker=DB::table('profiles')
                ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                ->leftjoin('countries','countries.id','=','profiles.nationality')
                ->leftjoin('users','users.id','=','profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->leftjoin('role_user','role_user.user_id','=','users.id')
                ->leftjoin('applicants','applicants.user_id','=','users.id')
                ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name as user_name')
                ->where('users.status','=',1)
                ->where('role_user.role_id','=',5)
                ->where('profiles.agent_code','=',$agent_code)
                ->count();


                $domestic_maid=DB::table('profiles')
                ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                ->leftjoin('countries','countries.id','=','profiles.nationality')
                ->leftjoin('users','users.id','=','profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->leftjoin('role_user','role_user.user_id','=','users.id')
                ->leftjoin('applicants','applicants.user_id','=','users.id')
                ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('role_user.role_id','=',6)
                ->where('profiles.agent_code','=',$agent_code)
                ->count();
            }
            if(auth()->user()->hasRole('sub-agent')){
                // active employer count --5/5/2020
                $active_employer=DB::table('employer_profiles')
                ->leftjoin('countries','countries.id','=','employer_profiles.country')
                ->leftjoin('users','users.id','=','employer_profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('employer_profiles.agent_code','=',auth()->user()->id)
                ->count();

                //job seeker count --5/7/2020
                $job_seekers=DB::table('professional_profiles')
                    ->leftjoin('countries','countries.id','=','professional_profiles.country')
                    ->leftjoin('cities','cities.id','=','professional_profiles.city')
                    ->leftjoin('users','users.id','=','professional_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('professional_profiles.name','cities.name as city','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                    ->where('users.status','=',0)
                    ->where('professional_profiles.agent_code','=',auth()->user()->id)
                    ->count();

                $retired=DB::table('retired_personnels')
                    ->leftjoin('countries','countries.id','=','retired_personnels.country')
                    ->leftjoin('users','users.id','=','retired_personnels.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                    ->where('users.status','=',1)
                    ->where('retired_personnels.agent_code','=',auth()->user()->id)
                    ->count();
                
                $foreign_worker=DB::table('profiles')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','user_profiles.name as agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',5)
                    ->where('profiles.agent_code','=',auth()->user()->id)
                    ->count();

                $domestic_maid=DB::table('profiles')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','user_profiles.name as agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',6)
                    ->where('profiles.agent_code','=',auth()->user()->id)
                    ->count();
            }
            if(auth()->user()->hasRole('cadmin')){
                $user_country=UserProfile::where('user_id',auth()->user()->id)->pluck('company_country');

                // active employer count --4/20/2020
                $active_employer=DB::table('employer_profiles')
                ->leftjoin('countries','countries.id','=','employer_profiles.country')
                ->leftjoin('users','users.id','=','employer_profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
                ->where('users.status','=',1)
                ->where('employer_profiles.country','=',$user_country)
                ->count();

                //blocked employer count --4/20/2020
                $blocked_employer=DB::table('employer_profiles')
                ->leftjoin('countries','countries.id','=','employer_profiles.country')
                ->leftjoin('users','users.id','=','employer_profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
                ->where('users.status','=',2)
                ->where('employer_profiles.country','=',$user_country)
                ->count();


                // employer application count --4/20/2020
                $employer_application=DB::table('employer_profiles')
                ->leftjoin('countries','countries.id','=','employer_profiles.country')
                ->leftjoin('users','users.id','=','employer_profiles.user_id')
                ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                ->select('employer_profiles.company_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','employer_profiles.country','users.created_at','users.name')
                ->where('users.status','=',0)
                ->where('employer_profiles.country','=',$user_country)
                ->count();

                //active business partner count --4/22/2020
                $active_business_partner = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',1)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->count();

                    //blocked business partner count --4/22/2020
                $blocked_business_partner = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',2)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->count();

                    //business partner application count --4/22/2020
                $business_partner_application = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',0)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->count();

                    //pending agent application count --1/5/2020
                $pending_agent_application = DB::table('agent_profiles')
                    ->leftjoin('countries','countries.id','=','agent_profiles.agency_country')
                    ->leftjoin('users','users.id','=','agent_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('agent_profiles.agency_registered_name','countries.name as company_country','users.public_id','users.id','users.code','users.email','users.created_at','users.name','agent_profiles.contact_phone')
                    ->where('users.status','=',-1)
                    ->where('agent_profiles.agency_country','=',$user_country)
                    ->count();

                    //job seeker count --4/22/2020
                $job_seekers=DB::table('professional_profiles')
                    ->leftjoin('countries','countries.id','=','professional_profiles.country')
                    ->leftjoin('users','users.id','=','professional_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('professional_profiles.name','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','professional_profiles.country','users.created_at','users.name')
                    ->where('users.status','=',0)
                    ->where('professional_profiles.country','=',$user_country)
                    ->count();

                    //blockedjob seeker count --4/22/2020
                $blocked_job_seekers=DB::table('professional_profiles')
                    ->leftjoin('countries','countries.id','=','professional_profiles.country')
                    ->leftjoin('users','users.id','=','professional_profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('professional_profiles.name','professional_profiles.profile_image','countries.name as company_country','users.public_id','users.id','users.code','users.email','professional_profiles.country','users.created_at','users.name')
                    ->where('users.status','=',2)
                    ->where('professional_profiles.country','=',$user_country)
                    ->count();

                    //retired count --4/22/2020
                    $retired=DB::table('retired_personnels')
                    ->leftjoin('countries','countries.id','=','retired_personnels.country')
                    ->leftjoin('users','users.id','=','retired_personnels.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                    ->where('users.status','=',1)
                    ->where('retired_personnels.country','=',$user_country)
                    ->count();

                    $blocked_retired=DB::table('retired_personnels')
                    ->leftjoin('countries','countries.id','=','retired_personnels.country')
                    ->leftjoin('users','users.id','=','retired_personnels.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->select('retired_personnels.name','retired_personnels.address','countries.name as company_country','users.public_id','users.id','users.code','users.email','retired_personnels.country','users.created_at','users.name')
                    ->where('users.status','=',2)
                    ->where('retired_personnels.country','=',$user_country)
                    ->count();

                    // foreign worker count --4/26/2020
                    $foreign_worker=DB::table('profiles')
                    ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',5)
                    ->where('profiles.nationality','=',$user_country)
                    ->count();

                    //domestic maid count --4/26/2020
                    $domestic_maid=DB::table('profiles')
                    ->leftjoin('agent_profiles','agent_profiles.agent_code','=','profiles.agent_code')
                    ->leftjoin('countries','countries.id','=','profiles.nationality')
                    ->leftjoin('users','users.id','=','profiles.user_id')
                    ->leftjoin('user_profiles','user_profiles.user_id','=','users.id')
                    ->leftjoin('role_user','role_user.user_id','=','users.id')
                    ->leftjoin('applicants','applicants.user_id','=','users.id')
                    ->select('profiles.name','profiles.image','applicants.id as app_id','profiles.agent_code','agent_profiles.agency_registered_name','profiles.passport_number as passport','countries.name as country','users.public_id','users.id','users.code','users.email','users.created_at','users.name')
                    ->where('users.status','=',1)
                    ->where('role_user.role_id','=',6)
                    ->where('profiles.nationality','=',$user_country)
                    ->count();
            }
            if(auth()->user()->hasRole('superadministrator|administrator|agent')){
                 //all list of part time employer
                 $part_time_employers = PartTimeEmployer::with('user')->whereHas('user', function($q) {
                    $q->where('status','0');
                })->count();

                //active list of part time employer
                $active_part_time_employers = PartTimeEmployer::with('user')->whereHas('user', function($q) {
                    $q->where('status','1');
                })->count();

                //inactive list of part time employer
                $inactive_part_time_employers = PartTimeEmployer::with('user')->whereHas('user', function($q) {
                    $q->where('status','-1');
                })->count();
                $blocked_part_time_maid=count(User::with('part_time_maid')->where('status', 2)->whereRoleIs('part-time-maid')->get());
                $active_part_time_maid=count(User::with('part_time_maid')->where('status', 1)->whereRoleIs('part-time-maid')->get());
                $part_time_maid_application = count(User::with('part_time_maid')->where('status', 0)->whereRoleIs('part-time-maid')->get());
                // active employer count --1/5/2020
                 $active_employer= count(User::with('employer_profile')->where('status', 1)->whereRoleIs('employer')->get());

                //blocked employer count --3/10/2020
                $blocked_employer= count(User::with('employer_profile')->where('status', 2)->whereRoleIs('employer')->get());
                
                // employer application count --1/5/2020
                $employer_application=count(User::with('employer_profile')->where('status', 0)->whereRoleIs('employer')->get());
                
                //active business partner count --1/5/2020
                $active_business_partner =count(User::with('agent_profile')->whereHas('roles', function($q){$q->whereIn('name', ['part-timer','agent']);})->where('status', 1)->get());
                //blocked business partner count --3/11/2020
                $blocked_business_partner =count(User::with('agent_profile')->whereHas('roles', function($q){$q->whereIn('name', ['part-timer','agent']);})->where('status', 2)->get());
                
                //business partner application count --1/5/2020
                $business_partner_application=count(User::where('status', 0)
                                                            ->where(function($query){
                                                                $query->whereRoleIs('agent')
                                                                        ->orwhereRoleIs('part-timer');
                                                            }) 
                                                            ->get());
                                
                //pending agent application count --1/5/2020
                $pending_agent_application=count(User::where('status', -1)->whereRoleIs('agent')->get());

                //job seeker count --1/5/2020
                $job_seekers=count(User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get());

                $fast_registration=count(FastRegistratin::get());
                
                //blockedjob seeker count --3/11/2020
                $blocked_job_seekers=count(User::with('professional_profile')->where('status', 2)->whereRoleIs('professional')->get());
            
                 //retired count --1/5/2020
                $retired=count(User::with('retired_personnel')->where('status', 1)->whereRoleIs('retired')->get());
            
                //blocked retired count --3/11/2020
                $blocked_retired=count(User::with('retired_personnel')->where('status', 2)->whereRoleIs('retired')->get());
                
                // foreign worker count --4/26/2020
                $foreign_worker = count(User::where('status', 1)->whereRoleIs('worker')->get());

                //domestic maid count --4/26/2020
                $domestic_maid =count(User::where('status', 1)->whereRoleIs('maid')->get());
            }
            // employer demand count --1/5/2020
            if(auth()->user()->hasRole('agent'))
            {
                // Demand letters agent wise
                $loggedInUserId = auth()->user()->id;
    
                $employer_demand =count(Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->where('assigned_agent', $loggedInUserId)->get());
            } else {
                // all demand letters for super admin
                $employer_demand =count(Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->get());
            }

            //job count --1/5/2020
            if(auth()->user()->hasRole('employer')){
                $jobs = count(Job::where('user_id', auth()->id())->get());
            }else{
                $jobs = count(Job::all());
            }

            //foreign worker count --1/5/2020
            if(auth()->user()->hasRole('agent')){
                $foreign_worker = count(User::whereRoleIs('worker')->whereHas('profile', function ($q) {
                    $agent = auth()->user();
                    $q->where('agent_code', $agent->agent_profile->agent_code);
                })->get());
            }
            // else{
            //     $foreign_worker = count(User::where('status', 1)->whereRoleIs('worker')->get());
            // }

            //domestic maid count --1/5/2020
            if(auth()->user()->hasRole('agent')){
                $domestic_maid = count(User::whereRoleIs('maid')->whereHas('profile', function ($q) {
                    $agent = auth()->user();
                    $q->where('agent_code', $agent->agent_profile->agent_code);
                })->get());
            }
            // else{
            //     $domestic_maid =count(User::where('status', 1)->whereRoleIs('maid')->get());
            // }

            //proposed gw dm count --1/5/2020
            $proposed_gw_dm=count(Applicant::all());
            // $employer_offer=count(Offer::with('employer')->get());

            //count send to admin.layouts.master --1/55/2020
            $view->with('active_employer', $active_employer ?? '')
                 ->with('employer_application',$employer_application ?? '')
                 ->with('employer_demand',$employer_demand)
                 ->with('jobs',$jobs)
                 ->with('active_business_partner',$active_business_partner ?? '')
                 ->with('business_partner_application',$business_partner_application ?? '')
                 ->with('pending_agent_application',$pending_agent_application ?? '')
                 ->with('job_seekers',$job_seekers ?? '')
                 ->with('fast_registration',$fast_registration ?? '')
                 ->with('retired',$retired ?? '')
                 ->with('foreign_worker',$foreign_worker ?? '')
                 ->with('domestic_maid',$domestic_maid ?? '')
                 ->with('proposed_gw_dm',$proposed_gw_dm)
                 ->with('blocked_employer',$blocked_employer ?? '')   //add by milesh--3/10/2020
                 ->with('blocked_business_partner',$blocked_business_partner ?? '')     //add by milesh--3/11/2020
                 ->with('blocked_job_seekers',$blocked_job_seekers ?? '')    //add by milesh--3/11/2020
                 ->with('blocked_retired',$blocked_retired ?? '')      //add by milesh--3/11/2020
                 ->with('part_time_maid_application',$part_time_maid_application ?? '')
                 ->with('active_part_time_maid',$active_part_time_maid ?? '')
                 ->with('blocked_part_time_maid',$blocked_part_time_maid ?? '')
                 ->with('part_time_employers',$part_time_employers ?? '')
                 ->with('active_part_time_employers',$active_part_time_employers ?? '')
                 ->with('inactive_part_time_employers',$inactive_part_time_employers ?? '');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
