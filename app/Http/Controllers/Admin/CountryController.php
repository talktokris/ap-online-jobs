<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.country.index');
    }
    public function getCountryData()
    {
        $countries = Country::select(['id', 'name','code', 'status', 'created_at', 'updated_at'])->get();
        return DataTables::of($countries)
        ->addColumn('action', function ($country) {
            $string  = '<a href="'.route('admin.country.edit', $country->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($country->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$country->getTable(), $country->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$country->getTable(), $country->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
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
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;
        $country->name = $request->name;
        $country->code = $request->code;
        $country->save();

        Session::flash('message', 'Country added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.country.index');
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
    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Country $country, Request $request)
    {
        $country->name = $request->name;
        $country->code = $request->code;
        $country->save();

        Session::flash('message', 'Country updates Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.country.index');
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
