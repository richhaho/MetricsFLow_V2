<?php

namespace App;
use Session;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Caware_1 extends Model
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
class Caware extends Caware_1
{
    protected $table = 'Contents_Awareness';

    public $timestamps = false;

     


}