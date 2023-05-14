<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Facilities;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.facilities.index');
    }
    public function getFacilitiesData()
    {
        $facilitiess = Facilities::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($facilitiess)
        ->addColumn('action', function ($facilities) {
            $string  = '<a href="'.route('admin.facilities.edit', $facilities->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($facilities->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$facilities->getTable(), $facilities->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$facilities->getTable(), $facilities->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facilities = new Facilities;
        $facilities->name = $request->name;
        $facilities->save();

        
        Session::flash('message', 'facilities added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.facilities.index');
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
        $facilities = Facilities::where('id', $id)->first();
        return view('admin.facilities.edit', compact('facilities'));
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
        $facilities = Facilities::where('id', $id)->first();
        $facilities->name = $request->name;
        $facilities->save();

        Session::flash('message', 'facilities updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.facilities.index');
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
