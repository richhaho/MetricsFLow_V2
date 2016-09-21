<?php

namespace App;
use Auth;
use Session;
use Illuminate\Database\Eloquent\Model;
class ConversionBySite_1 extends Model
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
class ConversionBySite extends ConversionBySite_1
{
    protected $table = 'conversionbysite_u';
    public $timestamps = false;
    
}
