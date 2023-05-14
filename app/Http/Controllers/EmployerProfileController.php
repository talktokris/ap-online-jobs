<?php

namespace App\Http\Controllers;

use App\Job;
use App\State;
use App\City;
use App\Gender;
use App\Sector;
use App\AgentProfile;
use Illuminate\Support\Facades\Input;
use Session;
use Storage;
use App\User;
use App\Offer;
use App\Country;
use App\JobApplicant;
use App\Language;
use App\Applicant;
use App\Downloads;
use Carbon\Carbon;
use App\MaritalStatus;
use App\EmployerProfile;
use App\EmployerInvitation;
use App\Traits\OptionTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Notifications\OfferSentToDM;
use App\Notifications\DemandLetterSent;
use App\Notifications\InterviewDateSent;
use App\Notifications\InterviewDateSentAgent;
use App\Notifications\InvitedForInterview;
use App\Notifications\GWConfirmedByEmployer;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmployerInvitedJobseeker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image; /* https://github.com/Intervention/image */

class EmployerProfileController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use RegistersUsers;
    /**
   * Where to redirect users after registration.
   *
   * @var string
   */


    public function index()
    {
        return view('employer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::where('status', 1)->get();
        $states= State::get();
        $cities= City::get();
        // dd($states);
        // $cities= City::active()->get();
        return view('employer.create', compact('countrys','states','cities'));
    }

    public function company_states()
    {

        // return 'mil';
        $province_id=Input::get('province_id');
        $regencies= State::where('country_id','=',$province_id)
                            ->where('status', 1)->get();
        return response()->json($regencies);
    }

    public function company_cities()
    {

        // return 'mil';
        $states_id=Input::get('states_id');
        $cities= City::where('state_id','=',$states_id)
                    ->where('status', 1)->get();
        return response()->json($cities);
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
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployerProfile $employerProfile)
    {
        // dd(auth()->user()->id);
        if(!auth()->user()){
            abort(404);
        }
        if(auth()->user()->hasRole('employer')){
            $employer = auth()->user();
        }else{
            abort(404);
        }

        $countrys = Country::where('status', 1)->get();
        $job_positions = $this->getOptions('Demand Job Position');
        // $genders = $this->getOptions('Demand Gender');
        $genders = Gender::where('status', 1)->get();
        $educations = $this->getOptions('Demand Highest Education');
        $marital_statuses = MaritalStatus::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $total_maids = User::whereRoleIs('maid')->count();
        $total_workers = User::whereRoleIs('worker')->count();
        $total_agents = User::whereRoleIs('agent')->count();
        $offer_sent = Offer::where('employer_id', auth()->user()->id)->count();
        $jobs = Job::where('user_id', auth()->id())->get();

        return view('employer.show', compact('jobs', 'job_positions', 'genders', 'educations', 'languages' ,'marital_statuses', 'employer','total_maids','total_workers', 'total_agents','offer_sent', 'countrys'));
    }

    public function getAllDemands()
    {
        if(auth()->user()->hasRole('employer'))
        {
            // Demand letters employer wise
            $loggedInUserId = auth()->user()->id;

            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->where('employer_id', $loggedInUserId)->orderBy('created_at', 'desc')->get();
        } else {
            // all demand letters for super admin
            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->orderBy('created_at', 'desc')->get();
        }

        return DataTables::of($demands)
        ->addColumn('action', function ($demand) {
            $string =  '<a class="btn btn-xs btn-primary" href="'.route('demand', $demand->id).'">View</a>';
            $string .= '<a class="ml-1 btn btn-success btn-interview" data-toggle="modal" data-backdrop="static" demandID="'. $demand->id .'" data-keyboard="false" data-target="#requestforinterview" href="#" ><i class="glyphicon glyphicon-edit"></i> Request for Interview</a>';

            return $string;
        })
        
        ->addColumn('status', function($demand) {
            $status = '';

            if ($demand->status == 2) {
                $status = 'Submitted';
            } elseif ($demand->status == 3) {
                $status = 'Assigned Agent';
            } elseif ($demand->status == 4) {
                $status = 'Proposed GW';
            } elseif ($demand->status == 5) {
                $status = 'Confirmed GW';
            } elseif ($demand->status == 6) {
                $status = 'Finalized GW';
            } elseif ($demand->status == 7) {
                $status = 'Closed';
            } else {
                $status = '';
            }

            return $status;
        })
        ->addColumn('issue_date', function($demand) {
            return $demand->issue_date ? \Carbon\Carbon::parse($demand->issue_date)->format('d/m/Y') : '';
        })
        ->addColumn('expexted_date', function($demand) {
            return $demand->expexted_date ? \Carbon\Carbon::parse($demand->expexted_date)->format('d/m/Y') : '';
        })
        ->addColumn('preferred_country', function($demand) {
            return $demand->preferred_country_data->name;
        })
        ->addColumn('proposed_qty', function($demand) {

            $countProposedGW = count( $demand->applicants()->where('proposed', 1)->get() );

            $countProposedGW = $countProposedGW ?: '...';

            $string = '<span title="Proposed Date: '. (($demand->proposed_date != '') ? \Carbon\Carbon::parse($demand->proposed_date)->format('d/m/Y') : 'N/A') .'">'. $countProposedGW .'</span>';

            return $string;
        })
        ->addColumn('day_pending', function($demand) {

            if ($demand->expexted_date)
            {
                $date1 = date_create(date('Y-m-d'));
                
                $proposed_date = strtotime($demand->expexted_date);
                // $proposed_date7 = strtotime("+6 day", $expexted_date);
                $date2 = date_create(date('Y-m-d', $proposed_date));

                //difference between two dates
                $diff = date_diff($date1,$date2);

                //count days
                $diff = $diff->format("%a");
                return $diff;
            } else {
                return '...';
            }
        })
        ->addColumn('confirmed_qty', function($demand) {
            return count( $demand->applicants()->where('confirmed', 1)->get() ) ?: '...';
        })
        ->addColumn('final_qty', function($demand) {
            return count( $demand->applicants()->where('finalized', 1)->get() ) ?: '...';
        })
        ->addColumn('interview_date_time', function($demand) {
            return $demand->interview_date_time ?? 'N/A';
        })
        ->rawColumns(['proposed_qty', 'action'])
        ->make(true);
    }

    public function getAllMaids(){

        $users = User::where('status', 1)->whereRoleIs('maid')->select(['id','public_id', 'name'])->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string =  '<a class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View</a>';
            if ( ! $user->applicants()->first()['id'] ) {
                $string .= ' <input class="ml-1" onclick="KeepCount()" type="checkbox" name="id[]" value="'.$user->id.'">';
            }

            return $string;
        })
        ->addColumn('status', function($user) {
            if($user->applicants()->first()['id']){
                return 'Offered';
            }
            return 'Active';
        })
        ->addColumn('country', function($user) {
            return $user->profile->nationality_data['name'];
        })
        ->addColumn('date_of_birth', function($user) {
            return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
        })
        ->addColumn('passport', function($user) {
            return $user->profile->passport_number;
        })
        ->addColumn('marital_status', function($user) {
            return $user->profile->marital_status_data['name'];
        })
        ->addColumn('image', function($user) {
            $img = $user->profile->image != '' ? asset('storage/'.$user->profile->image) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
    }

    public function proposedGW($damand_id){

        $users = User::whereRoleIs('worker')
                        ->with('applicants')
                        ->where('status', 1)
                        ->whereHas('applicants', function($query) use($damand_id){
                            $query->whereIn('status', [1, 2, 3])->where('offer_id', $damand_id);
                        })->get();

        // datatable return
        return DataTables::of($users)
        ->addColumn('action', function ($data) {
            $string =  '<a class="btn btn-xs btn-primary" href="'.route('profile.public', $data->public_id).'">View</a>';

            // only for agent
            if(auth()->user()->hasRole('agent'))
            {
                if ( $data->applicants()->first()['status'] == 2 ) {
                    $string .= ' <input class="pull-right demand-checkbox" onchange="updateId(this)" style="width: 38px;height: 38px;vertical-align: middle;" type="checkbox" name="id[]" id="gw'.$data->applicants()->first()['id'].'" value="'.$data->applicants()->first()['id'].'">';
                }
            } else {
                if ( $data->applicants()->first()['status'] == 1 ) {
                    $string .= ' <input class="pull-right demand-checkbox" onchange="updateId(this)" onclick="KeepCount()" style="width: 38px;height: 38px;vertical-align: middle;" type="checkbox" name="id[]" id="gw'.$data->applicants()->first()['id'].'" value="'.$data->applicants()->first()['id'].'">';
                }                
            }

            // hidden input
            $string .= '<input type="hidden" name="demandID" value="'.$data->applicants()->first()['offer_id'].'">';

            return $string;
        })
        ->addColumn('status', function($data) {
            $status = $data->applicants()->first()['status'];
            $statusLabel = '';

            if ($status == 1) {
                $statusLabel = 'Proposed';
            } elseif ($status == 2) {
                $statusLabel = 'Confirmed';
            } elseif ($status == 3) {
                $statusLabel = 'Hired';
            } else {
                $statusLabel = 'Active';
            }

            return $statusLabel;
        })
        ->addColumn('country', function($data) {
            return $data->profile->nationality_data['name'];
        })
        ->addColumn('date_of_birth', function($data) {
            return $data->profile->date_of_birth ? \Carbon\Carbon::parse($data->profile->date_of_birth)->format('d/m/Y') : '';
        })
        ->addColumn('passport', function($data) {
            return $data->profile->passport_number;
        })
        ->addColumn('marital_status', function($data) {
            return $data->profile->marital_status_data['name'];
        })
        ->addColumn('image', function($data) {
            $img = $data->profile->image != '' ? asset('storage/'.$data->profile->image) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
    }

    public function confirmGWToDemand(Request $request)
    {
        if(!$request->gws) {
            Session::flash('message', 'No General Worker were Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        // update demand
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->status = 5;  // confirmed GW
        $demandUpdate->save();

        $ids = explode(",",$request->gws);
        foreach($ids as $id){
            $applicantUpdate = Applicant::where('id', $id)->first();
            $applicantUpdate->confirmed = 1;  // confirmed GW
            $applicantUpdate->status = 2;  // confirmed GW
            $applicantUpdate->save();
        }

        Session::flash('message', 'Worker(s) confirmed successfully!'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to the Agent
        $agent = $demandUpdate->agent;
        $admins = User::whereRoleIs('superadministrator')->get();
        $data = $demandUpdate;
        Notification::send($agent, new GWConfirmedByEmployer($data,$agent->agency_registered_name));
        Notification::send($admins, new GWConfirmedByEmployer($data,$agent->agency_registered_name));

        return redirect()->route('employer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd('show');
        $employer = User::where('id', $id)->first();
        
        $countrys = Country::where('status', 1)->get();
        $sectors = Sector::where('status',1)->get();
        //return $employer->employer_profile;
        return view('employer.edit', compact('employer','countrys','sectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */

    public function updateEmployeType(Request $request, $id){
        // dd($id);
        $employer_profile=EmployerProfile::where('user_id', $id)->first();
        $employer_profile->looking_for_pro = $request->looking_for_pro ?? null;
        $employer_profile->looking_for_gw = $request->looking_for_gw ?? null;
        $employer_profile->looking_for_dm = $request->looking_for_dm ?? null;
        $employer_profile->looking_for_rp = $request->looking_for_rp ?? null;
        $employer_profile->save();
        return redirect()->route('employer.show');
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $this->validate($request, [
            'company_country' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
        ]);
        
        if($request->file('company_logo')){
            $this->validate($request, [
                'company_logo' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
        }

        if($request->file('work_place_img')){
            $this->validate($request, [
                'work_place_img' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('nature_of_work')){
            $this->validate($request, [
                'nature_of_work' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('hostel_img')){
            $this->validate($request, [
                'hostel_img' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('product_of_company')){
            $this->validate($request, [
                'product_of_company' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
        }
        
        $employer = User::where('id', $id)->first();
        $employer_profile = $employer->employer_profile;

        $employer->name = $request->name;
        $employer->email = $request->email;
        $employer->phone = $request->phone;

        $employer->save();

        $employer_profile->nric = $request->nric;
        //$employer_profile->address = $request->address;
        $employer_profile->country = $request->country;
        $employer_profile->contact_email = $request->contact_email;

        $employer_profile->company_name = $request->company_name;
        $employer_profile->company_phone = $request->company_phone;
        $employer_profile->website = $request->website;
        $employer_profile->roc = $request->roc;
        $employer_profile->company_address = $request->company_address;
        $employer_profile->postcode = $request->postcode;
        $employer_profile->company_country= $request->company_country;
        $employer_profile->state= $request->company_state;
        if(empty($request->company_city)){
            $employer_profile->company_city="N/A";
        }
        else{
            $employer_profile->company_city= $request->company_city;
        }
        
        
        
        $employer_profile->looking_for_pro = $request->looking_for_pro ?? null;
        $employer_profile->looking_for_gw = $request->looking_for_gw ?? null;
        $employer_profile->looking_for_dm = $request->looking_for_dm ?? null;
        $employer_profile->looking_for_rp = $request->looking_for_rp ?? null;
        if($request->file('company_logo')){
            $image_basename = explode('.',$request->file('company_logo')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('company_logo')->getClientOriginalExtension();

            $request->company_logo->storeAs('public', $image);
            // dd($request->company_logo->storeAs('public', $image));

            //add new image path to database
            $employer_profile->company_logo = $image;
            
        }

        if($request->file('work_place_img')){
            $image_basename = explode('.',$request->file('work_place_img')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('work_place_img')->getClientOriginalExtension();

            $request->work_place_img->storeAs('public', $image);
            // dd($request->company_logo->storeAs('public', $image));

            //add new image path to database
            $employer_profile->work_place_img = $image;
            
        }
        if($request->file('nature_of_work')){
            $image_basename = explode('.',$request->file('nature_of_work')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('nature_of_work')->getClientOriginalExtension();

            $request->nature_of_work->storeAs('public', $image);
            // dd($request->company_logo->storeAs('public', $image));

            //add new image path to database
            $employer_profile->nature_of_work_img = $image;
            
        }

        if($request->file('hostel_img')){
            $image_basename = explode('.',$request->file('hostel_img')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('hostel_img')->getClientOriginalExtension();

            $request->hostel_img->storeAs('public', $image);
            // dd($request->company_logo->storeAs('public', $image));

            //add new image path to database
            $employer_profile->hostel_img = $image;
            
        }


        if($request->file('product_of_company')){
            $image_basename = explode('.',$request->file('product_of_company')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('product_of_company')->getClientOriginalExtension();

            $request->product_of_company->storeAs('public', $image);
            // dd($request->company_logo->storeAs('public', $image));

            //add new image path to database
            $employer_profile->product_of_company_img = $image;
            
        }

        $employer_profile->save();

        Session::flash('message', 'Information Updated successfully!'); 
        Session::flash('alert-class', 'alert-success');

        if(auth()->user()->hasRole('superadministrator')){
            return redirect()->route('admin.employerApplication');
        }elseif(auth()->user()->hasRole('employer')){
            return redirect()->route('employer.show');
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployerProfile $employerProfile)
    {
        //
    }

    public function interviewdatetime(Request $request)
    {
        $offers = Offer::where('id', $request->demandID)->first();
        $offers->interview_date_time = $request->interview_datetime;

        $offers->save();

        $admins = User::whereRoleIs('superadministrator')->get();

        $agent = User::where('id', $offers->assigned_agent)->first();



        $data = $offers;
        Notification::send($admins, new InterviewDateSent($data));
        // Notification::send($agent, new InterviewDateSentAgent($data));

        Session::flash('message', 'Interview Date submitted successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('employer.show');
        
    }

    public function saveDemand(Request $request)
    {
        /*Validation*/
        $this->validate($request, [
            'IssueDate' => 'date',
            // 'ExpectedJoinDate' => 'date',
        ]);

        if($request->file('DemandFile')){
            $this->validate($request, [
                'DemandFile' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('approvalQuotaAndLevy')){
            $this->validate($request, [
                'approvalQuotaAndLevy' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }

        for($i=0; $i < count(array_filter($request->preferred_country)); $i++){
            $offer = new Offer;
            $offer->employer_id = auth()->user()->id;
            $user_id = auth()->user()->id;
            $employer = EmployerProfile::where('user_id', $user_id)->first();
            $offer->title = 'Demand Letter';
            $offer->hiring_package = $request->HiringPackage;
            $offer->company_name = $employer->company_name;
            // $offer->company_name = $request->CompanyName;
            $offer->demand_letter_no = $request->DemandLetterNo;
            $offer->issue_date = Carbon::now();
            $offer->expexted_date = $request->ExpectedJoinDate;
            $offer->demand_qty = $request->demand_qty[$i];
            $offer->preferred_country = $request->preferred_country[$i];
            $offer->job_position = $request->job_position;
            $offer->gender = $request->gender;
            $offer->marital_status = $request->marital_status;
            $offer->highest_education = $request->highest_education;
            $offer->preferred_language = $request->preferred_language;
            $offer->reading = $request->reading;
            $offer->written = $request->written;
            $offer->job_location = $request->job_location;

            if($request->file('DemandFile')){            
                $file_basename = explode('.',$request->file('DemandFile')->getClientOriginalName())[0];
                $file_name = $file_basename . '-' . time() . '.' . $request->file('DemandFile')->getClientOriginalExtension();

                $request->DemandFile->storeAs('public/demand_letter', $file_name);
                //add new image path to database
                $offer->demand_file = $file_name;
                
            }
            if($request->file('approvalQuotaAndLevy')){            
                $file_basename = explode('.',$request->file('approvalQuotaAndLevy')->getClientOriginalName())[0];
                $file_name = $file_basename . '-' . time() . '.' . $request->file('approvalQuotaAndLevy')->getClientOriginalExtension();

                $request->approvalQuotaAndLevy->storeAs('public/demand_letter', $file_name);
                //add new image path to database
                $offer->approvalQuotaAndLevy = $file_name;
                
            }

            $offer->comments = $request->comments;
            $offer->status = 2;
            $offer->save();

            //Send notification to the Admins
            $admins = User::whereRoleIs('superadministrator')->get();
            $data = $offer;
            Notification::send($admins, new DemandLetterSent($data));
        }

        Session::flash('message', 'Demand sent successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('employer.show');
    }

    public function sendOffer(Request $request)
    {
        if(!$request->id){
            Session::flash('message', 'No Domestic Maid Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }
        $offer = new Offer;
        $offer->employer_id = auth()->user()->id;
        $offer->save();

        $ids = $request->id;
        foreach($ids as $id){
            $applicant = new Applicant;
            $applicant->offer_id = $offer->id;
            $applicant->user_id = $id;
            $applicant->save();
        }

        Session::flash('message', 'Offer sent successfully!'); 
        Session::flash('alert-class', 'alert-success');

        //Send notification to the Admins
        $admins = User::whereRoleIs('superadministrator')->get();
        $data = User::where('id', $ids[0])->first();
        Notification::send($admins, new OfferSentToDM($data));
        Notification::send($data->profile->agent(), new OfferSentToDM($data));

        return redirect()->route('employer.show');
    }

    public function viewDemand ($id)
    {
        $offer = Offer::where('id', '=', $id)->first();
        $applicants = Applicant::where('offer_id', $offer->id)->get();

        return view('demand.show', compact('offer','applicants'));
    }

    public function public($public_id)
    {
        $employer = User::where('public_id', '=', $public_id)->first();

        return view('employer.public', compact('employer'));
    }

    public function getProfessionalsData()
    {
        $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();

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

    public function inviteProfessional(Request $request, Job $job)
    {
        $request->validate([
            'ids' => 'required'
        ]);
        foreach($request->ids as $id){
            if(!$job->alreadyApplied($id)){
                $job->jobApplicants()->create([
                    'user_id' => $id,
                    'invited_by_employer' => true
                ]);
            }else{
                $applicant = $job->jobApplicants->where('user_id', $id)->first();
                $applicant->invited_by_employer = true; 
                $applicant->save();
            }
        }

        $jobseekers = User::find($request->ids);

        Notification::send($jobseekers, new InvitedForInterview($job));

        $admins = User::whereRoleIs('superadministrator')->get();
        Notification::send($admins, new EmployerInvitedJobseeker($job));

        Session::flash('message', 'Invitation sent successfully!'); 
        Session::flash('alert-class', 'alert-success');
        // return redirect(route('job.show', $job->id));
        return redirect()->back();
    }
    public function proffessionalAcceptedInterview(Request $request,$id)
    {
        $applicant = JobApplicant::where('user_id', $id)->first();
        $applicant->invited_by_employer = 2; 
        $applicant->save();
        Session::flash('message', 'User has been Accepted!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    public function proffessionalRejectedInterview(Request $request, $id)
    {
        $applicant = JobApplicant::where('user_id', $id)->first();
        $applicant->invited_by_employer = 3; 
        $applicant->save();
        Session::flash('message', 'User has been Rejected!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
    }

    public function invites($employer_id)
    {
        $employer = User::find($employer_id);
        $invites = EmployerInvitation::where('employer_id', $employer_id)->pluck('jobseeker_id');
        $jobseekers = User::find($invites);
        return view('employer.invites' ,[
            'jobseekers' => $jobseekers,
            'employer' => $employer
        ]);
    }
}
