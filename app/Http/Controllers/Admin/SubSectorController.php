<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\SubSector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub_sector = new SubSector;
        $sub_sector->sector_id = $request->sector_id;
        $sub_sector->name = $request->name;
        $sub_sector->slug = str_replace(" ", "_", $request->name);
        $sub_sector->save();

        
        Session::flash('message', 'Sub sector added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.sector.show', $request->sector_id);
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
    public function edit(SubSector $subSector)
    {
        return view('admin.sector.editSubSector', compact('subSector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSector $subSector)
    {
        $subSector->name = $request->name;
        $subSector->slug = str_replace(" ", "_", $request->name);
        $subSector->save();

        
        Session::flash('message', 'Sub sector updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.sector.show', $subSector->sector_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubSector $subSector)
    {
        $subSector->delete();
        Session::flash('message', 'Sub sector deleted Successfully!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->route('admin.sector.show', $subSector->sector_id);
    }
}
