<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Option;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    
    public function index()
    {

        return view('admin.options.index');

    }


    public function getOptionsData()
    {

        $options = Option::select(['id', 'type', 'name', 'status', 'created_at', 'updated_at'])->get();
        
        return DataTables::of($options)
            ->addColumn('action', function ($option) {
                $string  = '<a href="'.route('admin.options.edit', $option->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                if($option->status == 0){
                    $string .= ' <a href="'.route('admin.publish', [$option->getTable(), $option->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
                }else{
                    $string .= ' <a href="'.route('admin.unpublish', [$option->getTable(), $option->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
                }
                return $string;
            })
            ->make(true);

    }


    public function create()
    {

        $types = config('option_type');

        return view('admin.options.create', compact('types'));

    }


    public function store(Request $request)
    {

        $option = new Option;
        $option->type = $request->type;
        $option->name = $request->name;
        $option->save();

        
        Session::flash('message', 'Option added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.options.index');

    }


    public function edit(Option $option)
    {

        $types = config('option_type');

        return view('admin.options.edit', compact('option', 'types'));

    }


    public function update(Request $request, Option $option)
    {

        $option->type = $request->type;
        $option->name = $request->name;
        $option->save();

        
        Session::flash('message', 'Option Updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.options.index');

    }

}
