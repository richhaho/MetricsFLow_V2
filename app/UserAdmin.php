<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'client_id'
    ];

    public $timestamps = false;

    protected $connection = 'mysql';
    public function user_role()
    {
        return \App\UserRole::where('user_id',$this->id)->first();
    }

}
