<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class up_esr_1 extends Model
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
class up_esr extends up_esr_1
{
    protected $table = 'up_esr';

    public $timestamps = false;

   


}