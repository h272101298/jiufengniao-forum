<?php

namespace App\Modules\Bet\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bet extends Model
{
    //
    use Notifiable;
    protected $table='bet_user';
    protected $fillable=[
        'account','password'
    ];
    protected $hidden=[
        'password'
    ];
}
