<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;


class TagController extends Controller
{
    public function index(Request $request)
    {
        $PPC = array("fbook"=>"!{ignore}src=", "google" =>"?{ignore}src=",
            "bing"=>"@{ignore}src=","yahoo"=>"\${ignore}src=");

        if ($request -> id1 == "PPC"){
            $URL = $PPC[$request->id2];

        }

        return view('Tag', [
            'uRL'=>$URL
        ]);
    }


}