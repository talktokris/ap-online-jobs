<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;

class DynamicDependentController extends Controller
{
    //

    public function findStateName(Request $request){
        
        $data=State::select('name','id')->where('country_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
    }
    
    public function findCityName(Request $request){
        
        $data=City::select('name','id')->where('state_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	}
}
