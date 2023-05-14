<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Specialization;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.specialization.index');
    }
    public function getSpecializationData()
    {
        $specializations = Specialization::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($specializations)
        ->addColumn('action', function ($specialization) {
            $string  = '<a href="'.route('admin.specialization.edit', $specialization->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($specialization->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$specialization->getTable(), $specialization->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$specialization->getTable(), $specialization->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.specialization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specialization = new Specialization;
        $specialization->name = $request->name;
        $specialization->save();

        
        Session::flash('message', 'specialization added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.specialization.index');
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
    public function edit(Specialization $specialization)
    {
        return view('admin.specialization.edit', compact('specialization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Specialization $specialization, Request $request)
    {
        $specialization->name = $request->name;
        $specialization->save();

        Session::flash('message', 'specialization updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.specialization.index');
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
