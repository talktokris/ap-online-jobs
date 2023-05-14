<?php

namespace App\Http\Controllers;

use App\Job;
use Session;
use App\User;
use App\Language;
use App\Facilities;
use App\JobAcademic;
use App\Qualification;
use App\JobLanguage;
use App\PositionName;
use App\Specialization;
use App\EmployerInvitation;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;
use App\RetiredPersonnelAcademic;
use App\Notifications\JobSeekerApplied;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    use OptionTrait;

    public function search(Request $request)
    {
        $jobs = Job::where('status', 1)
                    ->when($request->title, function($query) use($request){
                        return $query->where('positions_name', 'like', '%'.$request->title.'%');
                    })
                    ->when($request->location, function($query) use($request){
                        return $query->where('district', 'LIKE', '%' . $request->location . '%')->orWhere('town', 'LIKE', '%' . $request->location . '%')->orWhere('state', 'LIKE', '%' . $request->location . '%');
                    })
                    ->when($request->experience, function($query) use($request){
                        return $query->where('related_experience_year', 'LIKE', '%' . $request->experience . '%');
                    })
                    ->when($request->salary, function($query) use($request){

                        return $query->where('salary_offer','<', $request->salary + 500)->where('salary_offer','>', $request->salary - 500);
                    })->get();

        return view('job.index', [
            'jobs' => $jobs
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->q == 'location'){
            $jobs = Job::where('district', $request->c)->get();
        }elseif($request->q == 'skill'){
            $jobs = Job::where('skills', $request->q)->get();
        }elseif($request->q == 'designation'){
            $jobs = Job::where('positions_name', $request->q)->get();
        }elseif($request->q == 'category'){
            $jobs = Job::where('positions_name', $request->q)->get();
        }else{
            $jobs = Job::all();
        }
        
        return view('job.index', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->blue_color=="blue_colors"){
            $PositionNames = $this->getOptions('Blue Worker Position Name');
            $worker_type='1';
        }else{
            $PositionNames = $this->getOptions('Position Name');
            $worker_type='0';
        }
        $academics = $this->getOptions('Job Academic Qualification');
        $academic_fields = $this->getOptions('Job Academic Field');
        $languages = Language::where('status', 1)->get();
        $facilities = Facilities::where('status', 1)->get();
        
        $races = $this->getOptions('Job Race');
        return view('job.create', compact('facilities','PositionNames', 'races', 'languages','academics','academic_fields','worker_type'));
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
            'positions_name' => 'required',
            // 'closing_date' => 'date',
            'vacancies_description' => 'required',
        ]);
        $job = new Job;
        $job->user_id = auth()->id();
        $job->positions_name = $request->positions_name;
        $job->vacancies_description = $request->vacancies_description;
        $job->scope_of_duties = $request->scope_of_duties;
        $job->skills = $request->skills;
        $job->worker_type = $request->worker_type;
        $job->related_experience_year = $request->related_experience_year;
        // $job->related_experience_month = $request->related_experience_month;
        $job->job_vacancies_type = $request->job_vacancies_type;
        $job->salary_offer_currency = $request->salary_offer_currency;
        $job->salary_offer = $request->salary_offer;
        $job->salary_offer_period = $request->salary_offer_period;
        $job->postcode = $request->postcode;
        $job->district = $request->district;
        $job->town = $request->town;
        $job->state = $request->state;
        $job->total_number_of_vacancies = $request->total_number_of_vacancies;
        $job->closing_date = $request->closing_date;
        $job->working_hours = $request->working_hours;
        $job->posted_by = $request->posted_by;
        $job->person_in_charge = $request->person_in_charge;
        $job->telephone_number = $request->telephone_number;
        $job->handphone_number = $request->handphone_number;
        $job->email = $request->email;
        $job->gender = $request->gender;
        $job->marital_status = $request->marital_status;
        $job->race = $request->race;
        $job->age_eligibillity = $request->age_eligibillity;
        $job->other_requirements = $request->other_requirements;
        $job->facilities = $request->facilities ? implode(", " , $request->facilities) : null;
        $job->other_facilities = $request->other_facilities;
        // $job->language = $request->language;
        $job->minimum_academic_qualification = $request->minimum_academic_qualification;
        $job->academic_field = $request->academic_field;
        $job->driving_license = $request->driving_license;
        $job->other_skills = $request->other_skills;
        
        $job->save();

        if($request->language && $request->language[0] != null){
            for($i=0; $i< count($request->language); $i++){
                $language = new JobLanguage;
                $language->job_id = $job->id;
                $language->language = $request->language[$i];
                $language->speaking = $request->speaking[$i];
                $language->writing = $request->writing[$i];
                $language->save();
            }
        }

        if($request->academic_qualifications && $request->academic_qualifications[0] != null){
            for($i=0; $i< count($request->academic_qualifications); $i++){
                $education = new JobAcademic;
                $education->job_id = $job->id;
                $education->academic_qualification = $request->academic_qualifications[$i];
                $education->academic_field = $request->academic_fields[$i];
                $education->save();
            }
        }

        Session::flash('message', 'Job Posted Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('job.show', $job->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        if(auth()->user() && auth()->user()->hasRole('employer')){
            // dd($job);
            return view('job.show', [
                'qualification' => Qualification::get(),
                'job' => $job,
                'applicants' => $job->jobApplicants
            ]);
        }
        
        return view('job.show', [
            'job' => $job
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        // $job=Job::with('user','languages','academics')->where('id', $job->id)->first();
        // dd($job);
        $academics = RetiredPersonnelAcademic::where('status', 1)->get();
        $academic_fields = Specialization::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $facilities = Facilities::where('status', 1)->get();
        $PositionNames = $this->getOptions('Position Name');
        $races = $this->getOptions('Job Race');
        return view('job.edit', compact('job','facilities', 'PositionNames','races','languages','academics','academic_fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->validate($request, [
            'positions_name' => 'required',
            // 'closing_date' => 'date',
            'vacancies_description' => 'required',
        ]);

        $job->positions_name = $request->positions_name;
        $job->vacancies_description = $request->vacancies_description;
        $job->scope_of_duties = $request->scope_of_duties;
        $job->skills = $request->skills;
        $job->related_experience_year = $request->related_experience_year;
        // $job->related_experience_month = $request->related_experience_month;
        $job->job_vacancies_type = $request->job_vacancies_type;
        $job->salary_offer_currency = $request->salary_offer_currency;
        $job->salary_offer = $request->salary_offer;
        $job->salary_offer_period = $request->salary_offer_period;
        $job->postcode = $request->postcode;
        $job->district = $request->district;
        $job->town = $request->town;
        $job->state = $request->state;
        $job->total_number_of_vacancies = $request->total_number_of_vacancies;
        $job->closing_date = $request->closing_date;
        $job->working_hours = $request->working_hours;
        $job->person_in_charge = $request->person_in_charge;
        $job->posted_by = $request->posted_by;
        $job->telephone_number = $request->telephone_number;
        $job->handphone_number = $request->handphone_number;
        $job->email = $request->email;
        $job->gender = $request->gender;
        $job->marital_status = $request->marital_status;
        $job->race = $request->race;
        $job->age_eligibillity = $request->age_eligibillity;
        $job->other_requirements = $request->other_requirements;
        $job->facilities = implode(", " , $request->facilities);
        if($request->other_faliclities_checkbox == 'yes'){
            $job->other_facilities = $request->other_facilities;
        }else{
            $job->other_facilities = null;
        }
        // $job->language = $request->language;
        $job->minimum_academic_qualification = $request->minimum_academic_qualification;
        $job->academic_field = $request->academic_field;
        $job->driving_license = $request->driving_license;
        $job->other_skills = $request->other_skills;
        
        $job->save();

        if($request->language && $request->language[0] != null){
            foreach($job->languages as $language){
                $language->delete();
            }
            for($i=0; $i< count($request->language); $i++){
                $language = new JobLanguage;
                $language->job_id = $job->id;
                $language->language = $request->language[$i];
                $language->speaking = $request->speaking[$i];
                $language->writing = $request->writing[$i];
                $language->save();
            }
        }

        if($request->academic_qualifications && $request->academic_qualifications[0] != null){
            foreach($job->academics as $academic){
                $academic->delete();
            }
            for($i=0; $i< count($request->academic_qualifications); $i++){
                $education = new JobAcademic;
                $education->job_id = $job->id;
                $education->academic_qualification = $request->academic_qualifications[$i];
                $education->academic_field = $request->academic_fields[$i];
                $education->save();
            }
        }

        Session::flash('message', 'Job Updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('job.show', $job->id);
    }


    public function applyOnline(Job $job)
    {
        $job->jobApplicants()->create([
            'user_id' => auth()->user()->id,
            'applied_by_jobseeker' => true
        ]);

        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new JobSeekerApplied($job));

        Session::flash('message', 'Application Sent Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('job.show', $job->id);
    }

    public function availableJobseekers(Job $job, Request $request)
    {
        $qualifications = $this->getOptions('Job Academic Qualification');
        $field_of_studys = $this->getOptions('Job Academic Field');
        $salarys = $this->getOptions('Jobseeker Search Salary');
        $age_terms = [
            '18-24' => [18, 24],
            '25-35' => [25, 35],
            '36-45' => [36, 45],
        ];
        $jobseekers = $job->availableJobseekers();
        if(isset($request->age_term)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($age_terms, $request){
                return $jobseeker->professional_profile->age() > $age_terms[$request->age_term][0] && $jobseeker->professional_profile->age() < $age_terms[$request->age_term][1];
            });
        }
        if(isset($request->city)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($age_terms, $request){
                return $jobseeker->professional_profile->city == $request->city;
            });
        }
        if(isset($request->qualification)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($request){
                $qualifications = $jobseeker->qualifications;
                foreach($qualifications as $qualification){
                    return $qualification->qualification == $request->qualification;
                }
            });
        }
        if(isset($request->field_of_study)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($request){
                $qualifications = $jobseeker->qualifications;
                foreach($qualifications as $qualification){
                    return $qualification->subject == $request->field_of_study;
                }
            });
        }
        if(isset($request->salary)){
            $jobseekers = $jobseekers->filter(function ($jobseeker) use($request){
                return $jobseeker->professional_profile->expected_salary <= $request->salary && $jobseeker->professional_profile->expected_salary > $request->salary - 500;
            });
        }
        return view('job.availableJobseekers', [
            'job' => $job,
            'jobseekers' => $jobseekers,
            'qualifications' => $qualifications,
            'field_of_studys' => $field_of_studys,
            'salarys' => $salarys
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
