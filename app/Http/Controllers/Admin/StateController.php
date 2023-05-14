<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\State;
use App\Country;
use Session;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.state.index');

        // return '54321';
    }
    public function getStateData()
    {
        $states = State::select(['id', 'name','code', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($states)
        ->addColumn('action', function ($state) {
            $string  = '<a href="'.route('admin.state.edit', $state->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($state->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$state->getTable(), $state->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$state->getTable(), $state->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        $country= Country::active()->get();
        return view('admin.state.create')->with('country',$country);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = new State;
        $state->name = $request->name;
        $state->code = $request->code;
        $state->country_id =$request->country_id;
        $state->save();

        Session::flash('message', 'State added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.state.index');
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
        $state= State::find($id);
        $country= Country::active()->get();
        return view('admin.state.edit',compact('state','country'));
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
        $state=State::find($id);
        $state->name = $request->name;
        $state->code = $request->code;
        $state->country_id =$request->country_id;
        $state->save();

        Session::flash('message', 'State updates Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.state.index');
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
