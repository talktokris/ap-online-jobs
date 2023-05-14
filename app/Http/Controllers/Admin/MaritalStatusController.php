<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\MaritalStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class MaritalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.maritalStatus.index');
    }
    public function getmaritalStatusData()
    {
        $maritalStatuss = MaritalStatus::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($maritalStatuss)
        ->addColumn('action', function ($maritalStatus) {
            $string  = '<a href="'.route('admin.maritalStatus.edit', $maritalStatus->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($maritalStatus->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$maritalStatus->getTable(), $maritalStatus->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$maritalStatus->getTable(), $maritalStatus->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.maritalStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maritalStatus = new MaritalStatus;
        $maritalStatus->name = $request->name;
        $maritalStatus->save();

        
        Session::flash('message', 'maritalStatus added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.maritalStatus.index');
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
    public function edit(MaritalStatus $maritalStatus)
    {
        return view('admin.maritalStatus.edit', compact('maritalStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaritalStatus $maritalStatus, Request $request)
    {
        $maritalStatus->name = $request->name;
        $maritalStatus->save();

        Session::flash('message', 'maritalStatus updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.maritalStatus.index');
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
