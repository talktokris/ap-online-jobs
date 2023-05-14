<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Skill;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.skill.index');
    }
    public function getSkillData()
    {
        $skills = Skill::select(['id', 'for', 'name','type', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($skills)
        ->addColumn('action', function ($skill) {
            $string  = '<a href="'.route('admin.skill.edit', $skill->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($skill->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$skill->getTable(), $skill->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$skill->getTable(), $skill->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $skill = new Skill;
        $skill->for = $request->for;
        $skill->name = $request->name;
        $skill->slug = str_replace(" ", "_", $request->name);
        $skill->type = $request->type;
        $skill->save();

        
        Session::flash('message', 'skill added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.skill.index');
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
    public function edit(Skill $skill)
    {
        return view('admin.skill.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Skill $skill, Request $request)
    {
        $skill->name = $request->name;
        $skill->for = $request->for;
        $skill->slug = str_replace(" ", "_", $request->name);
        $skill->type = $request->type;
        $skill->save();

        Session::flash('message', 'skill updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.skill.index');
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
