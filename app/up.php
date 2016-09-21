<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class up_1 extends Model
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
class up extends up_1
{
    protected $table = 'up';

    public $timestamps = false;
 

}