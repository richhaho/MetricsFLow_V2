<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class AudienceSystem_1 extends Model
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

class AudienceSystem extends AudienceSystem_1
{
    protected $table = 'audiencesystem';

    public $timestamps = false;
 
}
