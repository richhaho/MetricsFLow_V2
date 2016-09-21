<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'role_id', 'user_id', 'client_name'
    ];

    public $timestamps = false;

    protected $connection = 'mysql';

    public function role()
    {
        return \App\Role::where('id',$this->role_id)->first();
    }
}
