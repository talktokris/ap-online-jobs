<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\UserProfile;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Country;
use Illuminate\Support\Facades\Hash;
use Session;
use App\State;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status', 1)->get();
        $roles = Role::all();
        return view('admin.user.index',compact('users', 'roles'));

    }

    public function getUserData()
    {
        // $users = User::whereRoleIs(['administrator','superadministrator'])->get();
        // $users= User::hasRole('superadministrator')->get();
        if(auth()->user()->hasRole('superadministrator')){
            $users=User::whereHas('roles', function($q){$q->whereIn('name', ['administrator','superadministrator','cadmin','sub-agent']);})->get();
            $roles = Role::all();
            return DataTables::of($users)
            ->addColumn('role', function($user) {
                return $user->roles->first()->description;
            })
            ->addColumn('action', function ($users) {
                $string  = '<a href="'.route('user.edit', $users->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'; 
                $string .= '<a href="'.route('user.delete', $users->id).'" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            if($users->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$users->getTable(), $users->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$users->getTable(), $users->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
            })
            ->make(true);
        }
        if(auth()->user()->hasRole('cadmin')){
            $users=User::whereHas('roles', function($q){$q->whereIn('name', ['sub-agent']);})->get();
            $roles = Role::all();
            return DataTables::of($users)
            ->addColumn('role', function($user) {
                return $user->roles->first()->description;
            })
            ->addColumn('action', function ($users) {
                $string  = '<a href="'.route('user.edit', $users->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($users->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$users->getTable(), $users->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$users->getTable(), $users->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
            })
            ->make(true);
        }
        


    
        

    //     ->addColumn('action', function ($users) {
    //         $string  = '<a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
    //        if($users->status == 0){
    //            $string .= ' <a href="#" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
    //        }else{
    //            $string .= ' <a href="#" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
    //        }
    //        return $string;
    //    })
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasRole('superadministrator')){
            $countrys = Country::where('status', 1)->get();
            $roles = Role::all();
            return view('admin.user.create', compact('countrys','roles'));
        }
        if(auth()->user()->hasRole('cadmin')){
            $user_id = auth()->user()->id;
            $user_country=UserProfile::where('user_id',$user_id)->pluck('company_country');
            $countrys = Country::where('status', 1)
                            ->where('id',$user_country)
                            ->get();
            $country_id=Country::where('status', 1)
                            ->where('id',$user_country)
                            ->pluck('id');
            $states = State::where('status',1)
                            ->where('country_id',$country_id)
                            ->get();
            return view('admin.user.create', compact('countrys','states'));
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }

        if($request->file('roc_file')){
            $this->validate($request, [
                'roc_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        $user = new User;
        $user->name = $request->user_name;   
        $user->last_name = $request->user_last_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->password = Hash::make($request->user_password);
        $user->public_id = time().md5($request->email);
        $user->status= 1;
        $user_country = $request->company_country;
        $user->code = $this->user_code($user_country);
        $user->save();
        $role=$request->user_role;
        $user->attachRole($role);

        $user_profile = new UserProfile;
        $user_profile->user_id = $user->id;
        $user_profile->name = $request->user_name;
        $user_profile->last_name = $request->user_last_name;
        $user_profile->company_country = $request->company_country;
        $user_profile->company_state = $request->company_state;
        $user_profile->company_city = $request->company_city;
        $user_profile->date_of_birth = $request->date_of_birth;
        $user_profile->passport_number = $request->nric;

        if($request->file('passport_file')){            
            $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

            $request->passport_file->storeAs('public', $image);
            $user_profile->passport_file = $image;
        }
        $user_profile->company_name = $request->company_name;
        $user_profile->roc = $request->roc;
        $user_profile->company_phone = $request->company_phone;
        if($request->file('roc_file')){            
            $image_basename = explode('.',$request->file('roc_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('roc_file')->getClientOriginalExtension();

            $request->roc_file->storeAs('public', $image);
            $user_profile->roc_file = $image;
        }
        $user_profile->save();
        Session::flash('message', 'User Created Successfully!!'); 
        Session::flash('alert-class', 'alert-success');
        return view('admin.user.index');
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
        $users = User::where('id', $id)->first();
        $user_profiles = $users->user_profile;
        $countrys = Country::where('status', 1)->get();
        $roles = Role::all();
        return view('admin.user.edit',compact('users','user_profiles','countrys','roles'));
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
        $user->name = $request->user_name;   
        $user->last_name = $request->user_last_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        if($request->user_password){
            $user->password = Hash::make($request->user_password);
        }
        $user->public_id = time().md5($request->email);
        $user_country = $request->company_country;
        $user->code = $this->user_code($user_country);
        $user->save();
        $role=$request->user_role;
        $user->detachRoles($user->roles);
        $user->attachRole($role);
        
        $user_profile = $user->user_profile;
        $user_profile->name = $request->user_name;
        $user_profile->last_name = $request->user_last_name;
        $user_profile->company_country = $request->company_country;
        $user_profile->company_state = $request->company_state;
        $user_profile->company_city = $request->company_city;
        $user_profile->date_of_birth = $request->date_of_birth;
        $user_profile->passport_number = $request->nric;

        if($request->file('passport_file')){            
            $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

            $request->passport_file->storeAs('public', $image);
            $user_profile->passport_file = $image;
        }
        $user_profile->company_name = $request->company_name;
        $user_profile->roc = $request->roc;
        $user_profile->company_phone = $request->company_phone;
        if($request->file('roc_file')){            
            $image_basename = explode('.',$request->file('roc_file')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('roc_file')->getClientOriginalExtension();

            $request->roc_file->storeAs('public', $image);
            $user_profile->roc_file = $image;
        }
        $user_profile->save();
        Session::flash('message', 'User Updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');
        return view('admin.user.index');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        if($user->user_profile){
            $user->user_profile->delete();
        }
        $user->delete();
        Session::flash('message', 'User Deleted Successfully!!');
        return redirect()->back();
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
