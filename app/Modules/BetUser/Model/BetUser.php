<?php

namespace App\Modules\BetUser\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class BetUser extends Authenticatable
{
    //
    use Notifiable;
    protected $table='bet_user';
    protected $fillable=['account','passwrod'];
    protected $hidden=['password'];
}
