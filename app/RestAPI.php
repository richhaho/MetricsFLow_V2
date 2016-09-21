<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestAPI extends Model
{
    protected $table = 'sample';

    public $timestamps = false;

    protected $connection = 'rest-api';


}
