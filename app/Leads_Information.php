<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Leads_Information_1 extends Model
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
class Leads_Information extends Leads_Information_1
{
    protected $table = 'Lead_Information';

    public $timestamps = false;

  
}