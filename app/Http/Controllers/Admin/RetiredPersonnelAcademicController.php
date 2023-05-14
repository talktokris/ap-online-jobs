<?php

namespace App\Http\Controllers\Admin;

use Session;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\RetiredPersonnelAcademic;
use App\Http\Controllers\Controller;

class RetiredPersonnelAcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.retiredPersonnelAcademic.index');
    }
    public function getretiredPersonnelAcademicData()
    {
        $retired_academics = RetiredPersonnelAcademic::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($retired_academics)
        ->addColumn('action', function ($retired_academic) {
            $string  = '<a href="'.route('admin.retiredPersonnelAcademic.edit', $retired_academic->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($retired_academic->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$retired_academic->getTable(), $retired_academic->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$retired_academic->getTable(), $retired_academic->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.retiredPersonnelAcademic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $academic = new RetiredPersonnelAcademic;
        $academic->name = $request->name;
        $academic->save();

        
        Session::flash('message', 'Academic added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.retiredPersonnelAcademic.index');
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
        $academic = RetiredPersonnelAcademic::where('id', $id)->first();
        return view('admin.retiredPersonnelAcademic.edit', compact('academic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $academic = RetiredPersonnelAcademic::where('id', $id)->first();
        $academic->name = $request->name;
        $academic->save();

        Session::flash('message', 'Academic updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.retiredPersonnelAcademic.index');
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
