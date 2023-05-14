<?php

namespace App\Http\Controllers;

use Session;
use App\Downloads;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CommonController extends Controller
{

    public function getDownloadsFile($type)
    {
        $downloads = Downloads::where('user_type', $type)
                        ->where('status', 1)->get();

        // datatable return
        return DataTables::of($downloads)
        ->addColumn('action', function ($data) {
            $string =  '<a class="btn btn-sm btn-info" href="'. asset('storage/downloads/'.$data->file_name ) .'" target="_blank"><i class="fa fa-download"></i> Download</a>';

            return $string;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
