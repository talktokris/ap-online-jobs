<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Sector;
use App\SubSector;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sector.index');
    }

    public function getSectorData()
    {
        $sectors = Sector::select(['id', 'name', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($sectors)
        ->addColumn('action', function ($sector) {
            $string  = '<a href="'.route('admin.sector.edit', $sector->id).'" class="btn btn-xs btn-primary mr-2"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $string .= '<a href="'.route('admin.sector.show', $sector->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> View</a>';
            if($sector->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$sector->getTable(), $sector->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$sector->getTable(), $sector->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
        })
        ->make(true);
    }

    public function getSubsectors($id)
    {
        return response()->json([
            'sub_sectors' => SubSector::where('sector_id', $id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sector.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sector = new Sector;
        $sector->name = $request->name;
        $sector->slug = str_replace(" ", "_", $request->name);
        $sector->save();

        
        Session::flash('message', 'sector added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.sector.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return view('admin.sector.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        return view('admin.sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        $sector->name = $request->name;
        $sector->slug = str_replace(" ", "_", $request->name);
        $sector->save();

        
        Session::flash('message', 'sector updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.sector.index');
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
