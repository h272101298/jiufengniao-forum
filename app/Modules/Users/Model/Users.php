<?php

namespace App\Modules\Users\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{
    //
    use Notifiable;
    protected $table='users';
    protected $fillable=[
        'username','password'
    ];
    protected $hidden=[
        'password','remember_token'
    ];
}
