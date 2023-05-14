<?php

namespace App\Http\Controllers\Admin;

use Session;
use Storage;
use App\Downloads;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DownloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.downloads.index');
    }
    public function getDownloadsData()
    {
        $downloadRecords = Downloads::select(['id', 'title', 'file_name', 'user_type', 'comments', 'status'])->get();

        // Generate Datatables
        return DataTables::of($downloadRecords)
        ->addColumn('action', function ($data) {
            $string  = '<a href="'. asset('storage/downloads/' . $data->file_name) .'" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-download"></i></a>';
            $string  .= ' <a href="'.route('admin.downloads.edit', $data->id).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
            if ($data->status == 0) {
                $string .= ' <a href="'.route('admin.publish', [$data->getTable(), $data->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            } else {
                $string .= ' <a href="'.route('admin.unpublish', [$data->getTable(), $data->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
        })
        ->addColumn('user_type', function ($downloads) {
            return strtoupper($downloads->user_type);
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
        return view('admin.downloads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $downloads = new Downloads;
        $downloads->title = $request->title;

        if($request->file('file_name')){            
            $file_basename = explode('.',$request->file('file_name')->getClientOriginalName())[0];
            $file_name = $file_basename . '-' . time() . '.' . $request->file('file_name')->getClientOriginalExtension();

            $request->file_name->storeAs('public/downloads', $file_name);
            //add new image path to database
            $downloads->file_name = $file_name;
            
        }
        $downloads->user_type = $request->user_type;
        $downloads->comments = $request->comments;
        $downloads->save();

        
        Session::flash('message', 'Downloads file added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.downloads.index');
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
        $downloads = Downloads::where('id', $id)->first();
        return view('admin.downloads.edit', compact('downloads'));
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
        $downloads = Downloads::where('id', $id)->first();
        
        $downloads->title = $request->title;
        if($request->file('file_name')){            
            $file_basename = explode('.',$request->file('file_name')->getClientOriginalName())[0];
            $file_name = $file_basename . '-' . time() . '.' . $request->file('file_name')->getClientOriginalExtension();

            $request->file_name->storeAs('public/downloads', $file_name);
            //add new image path to database
            $downloads->file_name = $file_name;
            
        }
        $downloads->user_type = $request->user_type;
        $downloads->comments = $request->comments;
        $downloads->save();

        Session::flash('message', 'Downloads file updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.downloads.index');
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
