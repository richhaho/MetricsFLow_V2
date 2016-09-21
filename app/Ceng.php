<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Ceng_1 extends Model
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
class Ceng extends Ceng_1
{
    protected $table = 'Contents_Engaged';

    public $timestamps = false;

   
}
