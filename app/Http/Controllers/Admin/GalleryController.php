<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index');
    }

    public function getGalleryData()
    {
        $gallerys = Gallery::all();
        return DataTables::of($gallerys)
        ->addColumn('action', function ($gallery) {
            $string  = '<a href="'.route('admin.gallery.edit', $gallery->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            if($gallery->status == 0){
                $string .= ' <a href="'.route('admin.publish', [$gallery->getTable(), $gallery->id]).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"></i> Active</a>';
            }else{
                $string .= ' <a href="'.route('admin.unpublish', [$gallery->getTable(), $gallery->id]).'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Inactive</a>';
            }
            return $string;
        })
        ->make(true);
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $gallery = new Gallery;

        if($request->file('image')){
            $this->validate($request, [
                'license_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
            
            $image_basename = explode('.',$request->file('image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->image->storeAs('public/gallery', $image);

            //add new image path to database
            $gallery->image_name = $image;
        }

        $gallery->caption = $request->caption;
        $gallery->status = $request->status;
        $gallery->save();

        Session::flash('message', 'Image added Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.gallery.index');

    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Gallery $gallery, Request $request)
    {
        if($request->file('image')){
            $this->validate($request, [
                'license_file' => 'mimes:jpg,jpeg,png|max:1024',
            ]);
            
            $image_basename = explode('.',$request->file('image')->getClientOriginalName())[0];
            $image = $image_basename . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->image->storeAs('public/gallery', $image);

            //remove existing file
            if($gallery->image_name != ''){
                Storage::disk('local')->delete('public/gallery'. $gallery->image_name);
            }

            //add new image path to database
            $gallery->image_name = $image;
        }

        $gallery->caption = $request->caption;
        $gallery->status = $request->status ?? 0;
        $gallery->save();

        Session::flash('message', 'Image updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.gallery.index');
    }

    public function gallery()
    {
        $images = Gallery::where('status', 1)->get();
        return view('gallery', compact('images'));
    }


}
