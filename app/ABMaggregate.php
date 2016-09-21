<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ABMaggregate_1 extends Model
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
class ABMaggregate extends ABMaggregate_1
{
    protected $table = 'ABMaggregate_u';

    public $timestamps = false;

}
