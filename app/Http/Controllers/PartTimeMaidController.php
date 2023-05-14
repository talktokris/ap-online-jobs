<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Maid;
use Illuminate\Support\Facades\Hash;
use App\Country;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MaidWorkerEntry;
use App\UserProfile;
use Session;

class PartTimeMaidController extends Controller
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
        try{
            \DB::beginTransaction();
            $crud_user = new User;
            $crud_user->name = $request->name;
            $crud_user->phone = $request->phone;
            $crud_user->email = $request->email ?? 'parttime@onlinejobs.my';
            $crud_user->public_id = time().md5($request->email);    //added by milesh
            $crud_user->password = Hash::make('DefPassMaid');       //added by milesh
            $crud_user->status = '0';
            $crud_user->code = $this->user_code('3');           //added by milesh
            $crud_user->save();
            $crud_user->attachRole('part-time-maid');       //added by milesh

            // data store in maid tables
            $crud_maid=new Maid;
            $crud_maid->user_id =  $crud_user->id;
            $crud_maid->phone = $request->phone;
            $crud_maid->email = $request->email ?? 'parttime@onlinejobs.my';
            $crud_maid->country = '3';          //added by milesh
            $crud_maid->state = $request->company_state;
            $crud_maid->city = $request->company_city;
            $crud_maid->work_as = $request->work_as;
            $crud_maid->save();
            // send notification to superadmin
            $data = $crud_user;         //added by milesh
            $admins = User::whereRoleIs('superadministrator')->get();   //added by milesh
            Notification::send($admins, new MaidWorkerEntry($data));    //added by milesh
            \DB::commit();
            Session::flash('message', 'User Created Successfully!!'); 
            return redirect(route('home'));
        }catch(\Exception $e){
            \DB::rollback(); 
            Session::flash('message', 'Something went wrong!!'); 
            // dd($e->getMessage());
        }

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
        //
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
        //
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
