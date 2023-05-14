<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use App\City;
use App\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.city.index');
    }

    public function getCityData()
    {
        $cities = City::select(['id', 'name','code', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($cities)
        ->addColumn('action', function ($city) {
            $string  = '<a href="'.route('admin.city.edit', $city->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($city->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$city->getTable(), $city->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$city->getTable(), $city->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states= State::active()->get();
        return view('admin.city.create')->with('states',$states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;
        $city->name = $request->name;
        $city->code = $request->code;
        $city->state_id =$request->state_id;
        $city->save();

        Session::flash('message', 'State added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.city.index');
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
        $city= City::find($id);
        $states= State::active()->get();
        return view('admin.city.edit',compact('city','states'));
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
        $city=City::find($id);
        $city->name = $request->name;
        $city->code = $request->code;
        $city->state_id =$request->state_id;
        $city->save();

        Session::flash('message', 'City updates Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.city.index');
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
}
