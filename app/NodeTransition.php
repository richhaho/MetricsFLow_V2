<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class NodeTransition_1 extends Model
{
 

    protected $connection = 'raw-data';
    public function __construct(){
    	if (Auth::check())
        { 
    		if(Auth::user()->country=='CA'){
    			$this->setConnection('raw-data-ca');
    		}
    	}
    	if (session()->has('country')){
            if(session('country')=='CA'){
                $this->setConnection('raw-data-ca');
            }
        } 
    }   

}
class NodeTransition extends NodeTransition_1
{
    protected $table = 'NodeTEST';

    public $timestamps = false;

 

}