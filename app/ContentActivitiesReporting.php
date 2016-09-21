<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ContentActivitiesReporting_1 extends Model
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
class ContentActivitiesReporting extends ContentActivitiesReporting_1
{
    protected $table = 'contentactivitiesreporting_u';

    public $timestamps = false;
 

}