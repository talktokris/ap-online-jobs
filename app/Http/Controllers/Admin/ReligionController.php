<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Religion;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.religion.index');
    }
    public function getReligionData()
    {
        $religions = Religion::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($religions)
        ->addColumn('action', function ($religion) {
            $string  = '<a href="'.route('admin.religion.edit', $religion->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($religion->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$religion->getTable(), $religion->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$religion->getTable(), $religion->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.religion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $religion = new Religion;
        $religion->name = $request->name;
        $religion->save();

        
        Session::flash('message', 'Religion added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.religion.index');
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
    public function edit(Religion $religion)
    {
        return view('admin.religion.edit', compact('religion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Religion $religion, Request $request)
    {
        $religion->name = $request->name;
        $religion->save();

        Session::flash('message', 'Religion updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.religion.index');
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
