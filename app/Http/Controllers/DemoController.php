<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function kutholshin()
    {
        return view('demo.kutholshin');
    }
    public function datatable()
    {
        return view('demo.datatable');
    }
    
    public function postDatatable(Request $request) 
    {
        if(!is_null($request->age)){
            return response()->json(['success'=>'succeed']);
        }else{
            return response()->json(['success'=>'failed']);
        }
    }

    public function select2()
    {
        return view('demo.select2');
    }

    public function select2Post(Request $request)
    {
        return $request->all();
    }
}
