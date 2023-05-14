<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\SkillLevel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SkillLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.skillLevel.index');
    }
    public function getSkillLevelData()
    {
        $skillLevels = SkillLevel::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($skillLevels)
        ->addColumn('action', function ($skillLevel) {
            $string  = '<a href="'.route('admin.skillLevel.edit', $skillLevel->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($skillLevel->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$skillLevel->getTable(), $skillLevel->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$skillLevel->getTable(), $skillLevel->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.skillLevel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $skillLevel = new SkillLevel;
        $skillLevel->name = $request->name;
        $skillLevel->save();

        
        Session::flash('message', 'Skill Level added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.skillLevel.index');
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
    public function edit(SkillLevel $skillLevel)
    {
        return view('admin.skillLevel.edit', compact('skillLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillLevel $skillLevel, Request $request)
    {
        $skillLevel->name = $request->name;
        $skillLevel->save();

        Session::flash('message', 'Skill Level updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.skillLevel.index');
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
