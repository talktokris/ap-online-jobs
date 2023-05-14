<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Country;
use App\PartTimeEmployer;
use Session;

class PartTimeEmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(!empty($request->service_task)){
            $service_task=$request->service_task;
            $final_service_task=implode(",",$service_task);
        }
        try{
            \DB::beginTransaction();
            $user = new User;
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email ?? 'parttime@onlinejobs.my';
            $user->password = Hash::make('DefPassEmp');
            $user->public_id = time().md5($request->email);
            $user->code = $this->user_code('3');
            $user->status = '0';
            $user->save();
            $user->attachRole('part_time_employer');
            
            $pt_employer=new PartTimeEmployer;
            $pt_employer->user_id =  $user->id;
            $pt_employer->country = '3';
            $pt_employer->address = $request->address;
            $pt_employer->state = $request->state;
            $pt_employer->city = $request->city;
            $pt_employer->phone = $request->phone;
            $pt_employer->email = $request->email ?? 'parttime@onlinejobs.my';
            $pt_employer->service_type = $request->service_type;
            $pt_employer->service_time = $request->service_time;
            $pt_employer->service_task = $final_service_task ?? '';
            $pt_employer->looking_for_maid = $request->looking_for_maid ?? '0';
            $pt_employer->looking_for_driver = $request->looking_for_driver ?? '0';
            $pt_employer->looking_for_home_nurse = $request->looking_for_home_nurse ?? '0';
            $pt_employer->name = $request->name;
            $pt_employer->last_name = $request->last_name;
            $pt_employer->phone = $request->phone;
            $pt_employer->save();
            \DB::commit();
            Session::flash('message', 'User Created Successfully!!'); 
            return redirect(route('home'));
        }catch(\Exception $e){
            \DB::rollback(); 
            Session::flash('message', 'Registration incomplete! Please try again'); 
            return redirect(route('home'));
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
