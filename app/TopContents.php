<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class TopContents_1 extends Model
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
class TopContents extends TopContents_1
{
    protected $table = 'contents_u';

    public $timestamps = false;

  


}