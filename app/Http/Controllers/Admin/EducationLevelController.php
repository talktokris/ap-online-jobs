<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\EducationLevel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class EducationLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.educationLevel.index');
    }
    public function getEducationLevelData()
    {
        $educationLevels = EducationLevel::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($educationLevels)
        ->addColumn('action', function ($educationLevel) {
            $string  = '<a href="'.route('admin.educationLevel.edit', $educationLevel->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($educationLevel->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$educationLevel->getTable(), $educationLevel->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$educationLevel->getTable(), $educationLevel->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.educationLevel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $educationLevel = new educationLevel;
        $educationLevel->name = $request->name;
        $educationLevel->save();

        
        Session::flash('message', 'educationLevel added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.educationLevel.index');
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
    public function edit(EducationLevel $educationLevel)
    {
        return view('admin.educationLevel.edit', compact('educationLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EducationLevel $educationLevel, Request $request)
    {
        $educationLevel->name = $request->name;
        $educationLevel->save();

        Session::flash('message', 'educationLevel updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.educationLevel.index');
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
