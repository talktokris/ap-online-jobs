<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Gender;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gender.index');
    }
    public function getgenderData()
    {
        $genders = Gender::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($genders)
        ->addColumn('action', function ($gender) {
            $string  = '<a href="'.route('admin.gender.edit', $gender->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($gender->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$gender->getTable(), $gender->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$gender->getTable(), $gender->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.gender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gender = new Gender;
        $gender->name = $request->name;
        $gender->save();

        
        Session::flash('message', 'gender added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.gender.index');
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
    public function edit(Gender $gender)
    {
        return view('admin.gender.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Gender $gender, Request $request)
    {
        $gender->name = $request->name;
        $gender->save();

        Session::flash('message', 'gender updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.gender.index');
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
