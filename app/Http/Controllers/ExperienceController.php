<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Experience;
use App\Country;
use Session;

class ExperienceController extends Controller
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
        $countrys = Country::where('status', 1)->get();
        return view('experience.create', compact('countrys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $experience = new Experience;
        $experience->user_id = auth()->user()->id;
        $experience->employer_name = $request->employer_name;
        $experience->country = $request->country;
        $experience->from_date = $request->from_date;
        $experience->to_date = $request->to_date;
        $experience->remark = $request->remark;

        $experience->save();

        Session::flash('message', 'Expereince saved successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('profile.index');
        
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
        $countrys = Country::where('status', 1)->get();
        $experience = Experience::where('id', $id)->first();
        return view('experience.edit', compact('experience','countrys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $experience = Experience::where('id', $id)->first();
        $experience->employer_name = $request->employer_name;
        $experience->country = $request->country;
        $experience->from_date = $request->from_date;
        $experience->to_date = $request->to_date;
        $experience->remark = $request->remark;

        $experience->save();

        Session::flash('message', 'Expereince updated successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('profile.index');

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
