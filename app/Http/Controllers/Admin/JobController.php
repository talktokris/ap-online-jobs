<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use App\User;
use App\FastRegistratin;
use App\JobBlueColorApplicant;
use App\Qualification;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SuggestJobseeker;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;

class JobController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // \DB::enableQueryLog(); 
        // $jobs = Job::with('job_seeker_job_category_data')->orderBy('id','desc')->get();
        // echo $jobs;
        // dd('test');
        // $query = \DB::getQueryLog();
        // dd($query);
        return view('admin.job.index');
    }

    public function getJobsData()
    {
        
        if(auth()->user()->hasRole('employer')){
            $jobs = Job::with('job_seeker_job_category_data')->where('user_id', auth()->id())->get();
        }else{
            $jobs = Job::with('job_seeker_job_category_data')->get();
        }


        return DataTables::of($jobs)
        ->addColumn('action', function ($job) {
            $string  = '';
            if(auth()->user()->hasRole('superadministrator|administrator')){
                $string .= '<a target="_blank" href="'.route('applicants', $job->id).'" class="btn btn-xs btn-primary">View Applicant</a> ';
                $string .= '<a target="_blank" href="'.route('admin.jobs.details', $job->id).'" class="btn btn-xs btn-primary">View</a> ';
            }elseif(auth()->user()->hasRole('employer')){
                $string .= '<a target="_blank" href="'.route('job.show', $job->id).'" class="btn btn-xs btn-primary">View</a> ';
                $string .= '<a target="_blank" href="'.route('availableJobseekers', $job->id).'" class="btn btn-xs btn-info">Available Resume</a> ';
            }
            $string .= '<a target="_blank" href="'.route('job.edit', $job->id).'" class="btn btn-xs btn-warning">Edit</a> ';
            if(auth()->user()->hasRole('superadministrator|administrator')){
                $string .= '<a target="_blank" href="'.route('admin.job.suggestJobseekers', $job->id).'" class="btn btn-xs btn-info">Suggestion</a> ';
            }
            
            return $string;
        })
        ->addColumn('positions_name', function($job) {
            return $job->job_seeker_job_category_data->name;
        })
        ->addColumn('company_name', function($job) {
            return $job->company()->company_name;
        })
        ->addColumn('worker_type', function($job) {
            if($job->worker_type=='1'){
                return 'Blue color';
            }else{
                return 'White color';
            }
            return $job->company()->company_name;
        })
        ->make(true);
    }

    public function getJobseekerByPosition(Job $job)
    {
        $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();

        $users = $users->reject(function ($user) use ($job){
                    return $user->professional_profile->resume_headline != $job->positions_name || $job->alreadyApplied($user->id);
                });
        
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-sm btn-primary">View</a> ';
            $string .= ' <input class="ml-1" type="checkbox" name="ids[]" value="'.$user->id.'">';
            return $string;
        })
        ->addColumn('city', function($user) {
            return $user->professional_profile['city'];
        })
        ->addColumn('profile_image', function($user) {
            $img = $user->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$user->professional_profile['profile_image']) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->addColumn('name', function($user) {
            return $user->professional_profile['name'];
        })
        ->addColumn('age', function($user) {
            return $user->professional_profile->age();
        })
        ->addColumn('education', function($user) {
            return $user->professional_profile->highest_qualification;
        })
        ->addColumn('position', function($user) {
            return $user->professional_profile->resume_headline;
        })
        ->addColumn('email', function($user) {
            return $user->professional_profile['email'];
        })
        ->rawColumns(['profile_image', 'action'])
        ->removeColumn('password')
        ->make(true);
    }

    public function suggestJobseekers(Job $job, Request $request)
    {
        // dd('test');
        if($job->worker_type=='1'){

            $jobseekers = $job->availableBlueWorker();
            return view('admin.job.suggest_blue_worker', [
                'job' => $job,
                'jobseekers' => $jobseekers,
                // 'qualifications' => $qualifications,
                // 'field_of_studys' => $field_of_studys,
                // 'salarys' => $salarys
            ]);
        }else{
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
    
            return view('admin.job.suggestJobseekers', [
                'job' => $job,
                'jobseekers' => $jobseekers,
                'qualifications' => $qualifications,
                'field_of_studys' => $field_of_studys,
                'salarys' => $salarys
            ]);
        }
    }

    public function sendSuggesion(Request $request, Job $job)
    {
        $request->validate([
            'ids' => 'required'
        ]);
        if($job->worker_type==1){
        foreach($request->ids as $id){
            $job->jobBlueWorkerApplicants()->create([
                'blue_color_id' => $id,
                'suggested_by_admin' => true
            ]);
        }
    }else{
        foreach($request->ids as $id){
            $job->jobApplicants()->create([
                'user_id' => $id,
                'suggested_by_admin' => true
            ]);
        }
        $employer = User::find($job->user_id);
        Notification::send($employer, new SuggestJobseeker($job));
    }

        

        

        Session::flash('message', 'Suggesion sent successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect(route('admin.job.suggestJobseekers', $job->id));
    }

    public function applicants(Job $job)
    {
        return view('admin.job.applicants', [
            'job' => $job,
            'qualification' => Qualification::get(),
        ]);
    }

    public function getJobApplicants(Job $job)
    {
        if($job->worker_type=='1'){
            $job_blue_applicants = JobBlueColorApplicant::pluck('blue_color_id')->toArray();
            $users = FastRegistratin::find($job_blue_applicants);
            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('admin.fast.registration.detail', $user->id).'" class="btn btn-sm btn-primary">View</a> ';
                return $string;
            })
            ->addColumn('city', function($user) {
                return $user->city->name;
            })
            ->addColumn('profile_image', function($user) {
                $img = $user['profile_image'] != '' ? asset('storage/resume/'.$user['profile_image']) :  asset('images/dummy.jpg');
                return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('name', function($user) {
                return $user['full_name'];
            })
            ->addColumn('age', function($user) {
                return $user->age();
            })
            ->addColumn('education', function($user) {
                return 'test';
                // return $user->professional_profile->highest_qualification;
                if($user->id){
                $qualification= Qualification::where('user_id', $user->id)->first();
                return $qualification['qualification'];
                }
            })
            ->addColumn('position', function($user) {
                return $user->job_seeker_job_category_data->name;
            })
            ->addColumn('email', function($user) {
                return $user['email'];
            })
            ->addColumn('status', function($user) use($job){
                $string = '';
                $applicant = JobBlueColorApplicant::where('blue_color_id', $user->id)->first();
                if($applicant->invited_by_employer == true){
                    $string .= '<span class="bade badge-success p-1">Selected by Employer</span>';
                }else{
                    if($applicant->suggested_by_admin == true){
                        $string .= '<span class="bade badge-warning p-1">Suggested By Admin</span>';
                    }elseif($applicant->applied_by_jobseeker == true){
                        $string .= '<span class="bade badge-info p-1">Applied by Jobseeker</span>';
                    }
                }
                return $string;
            })
            ->rawColumns(['profile_image', 'status', 'action'])
            ->removeColumn('password')
            ->make(true);
        }else{

            $applicants = $job->jobApplicants->pluck('user_id');

            $users = User::find($applicants);

            return DataTables::of($users)
            ->addColumn('action', function ($user) {
                $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-sm btn-primary">View</a> ';
                return $string;
            })
            ->addColumn('city', function($user) {
                return $user->professional_profile->job_seeker_city_data->name;
            })
            ->addColumn('profile_image', function($user) {
                $img = $user->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$user->professional_profile['profile_image']) :  asset('images/dummy.jpg');
                return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('name', function($user) {
                return $user->professional_profile['name'];
            })
            ->addColumn('age', function($user) {
                return $user->professional_profile->age();
            })
            ->addColumn('education', function($user) {
                // return $user->professional_profile->highest_qualification;
                if($user->id){
                $qualification= Qualification::where('user_id', $user->id)->first();
                return $qualification['qualification'];
                }
            })
            ->addColumn('position', function($user) {
                return $user->professional_profile->job_seeker_job_category_data->name;
            })
            ->addColumn('email', function($user) {
                return $user->professional_profile['email'];
            })
            ->addColumn('status', function($user) use($job){
                $string = '';
                $applicant = $job->jobApplicants->where('user_id', $user->id)->first();
                if($applicant->invited_by_employer == 1){
                    $string .= '<span class="bade badge-success p-1">Selected by Employer</span>';
                    $string .= '<a href="'.route('professional.accepted.interview',$applicant->jobseeker->id).'" class="bade badge-primary p-1" onclick="return confirm(\'Are you sure?\')">Accepted</a>';
                    $string .= '<a href="'.route('professional.rejected.interview',$applicant->jobseeker->id).'" class="bade badge-danger p-1" onclick="return confirm(\'Are you sure?\')">Rejected</a>';
                }elseif($applicant->invited_by_employer == 2){
                    $string .= '<span class="bade badge-primary p-1">Accepted</span>';
                }elseif($applicant->invited_by_employer == 3){
                    $string .= '<span class="bade badge-danger p-1">Rejected</span>';
                }
                else{
                    if($applicant->suggested_by_admin == true){
                        $string .= '<span class="bade badge-warning p-1">Suggested By Admin</span>';
                    }elseif($applicant->applied_by_jobseeker == true){
                        $string .= '<span class="bade badge-info p-1">Applied by Jobseeker</span>';
                    }
                    $string .= '<form method="post" action="'.route('inviteProfessional', $job->id).'">'.csrf_field().'<input onclick="return confirm(\'Are you sure?\')" class="btn btn-success p-1" type="submit" value="Select For Interview"><input class="ml-1" type="checkbox" name="ids[]" value="'.$applicant->jobseeker->id.'"></form>';
                }
                return $string;
            })
            ->rawColumns(['profile_image', 'status', 'action'])
            ->removeColumn('password')
            ->make(true);
        }
    }
    //route('inviteProfessional', $job->id)
    // <a class="bade badge-primary p-1" href="{{route('professional.accepted.interview',$applicant->jobseeker->id)}}" onclick="return confirm(\'Are you sure?\')">Accepted</a>
    // <a class="bade badge-danger p-1" href="{{route('professional.rejected.interview',$applicant->jobseeker->id)}}" onclick="return confirm(\'Are you sure?\')">Rejected</a>
    public function viewJobDetail($job_id)
    {
        $job=Job::with('user','languages','academics','job_seeker_job_category_data')->where('id', $job_id)->first();
        // dd($job);
        return view('admin.job.view_job_details',compact('job'));
    }
}
