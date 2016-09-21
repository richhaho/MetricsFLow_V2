<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\RestAPI as RestAPI;
 




class RestAPIController extends Controller
{
    public function index($e_id)
    {
        $rest=RestAPI::where('e_id',$e_id)->get();
        return response()->json($rest);
        // return view('reports', [
        //     'client_id'=>$client_id
        // ]);
    }
    //00019945aefe0002b5e5d476c14209abff59f6e8
    //000a711fa59f70edd179e6aad796f7851530ce90


}
