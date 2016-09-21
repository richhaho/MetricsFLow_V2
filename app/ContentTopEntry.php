<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ContentTopEntry_1 extends Model
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
class ContentTopEntry extends ContentTopEntry_1
{
    protected $table = 'topentry_u';

    public $timestamps = false;

  
}