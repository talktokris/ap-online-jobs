<?php

namespace App\Http\Controllers\Auth;

use Session;
use Storage;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Country;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
class ForeignRegisterController extends Controller
{

    public function createForeginWorker(){
        // dd('mm');
        $country = Country::where('status', '=', 1)->get();
        return view("professional.foreign_worker_create",compact('country'));
    }

    public function foreginWorkerRegistration(Request $request){
        try{
        \DB::beginTransaction();
        // dd($request->all());
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email ?? time().'@test.com';
            $user->phone = $request->phone;
            $user->public_id = time().md5($request->email);
            $user->password = Hash::make('DefPassForeign');
            $user->save();
            $user->attachRole('worker');
            // dd($user);
            /*Validation*/
            $this->validate($request, [
                'name' => 'required',
                'passport_number' => 'required',
                'phone' => 'required'
            ]);
            if($request->file('passport_file')){
                $this->validate($request, [
                    'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
                ]);
            }
            //Save Other data
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->name = $request->name;
            $profile->address = $request->address;
            $profile->passport_number = $request->passport_number;
            $profile->country = $request->company_country;
            $profile->state = $request->company_state;
            $profile->city = $request->company_city;
            $profile->phone = $request->phone;
            if($request->file('passport_file')){            
                $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
                $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();
    
                $request->passport_file->storeAs('public', $image);
    
                //Remove if there was any old image
                if($profile->passport_file != ''){
                    Storage::disk('local')->delete('public/'.$profile->passport_file);
                }
    
                //add new image path to database
                $profile->passport_file = $image;
                
            }
            // dd($request->all());
            $profile->save();
        \DB::commit();
        return redirect()->route('home');
    }catch(\Exception $e){
        \DB::rollback(); 
        Session::flash('message', 'Something went wrong!!'); 
        dd($e->getMessage());
    }
    }
}
