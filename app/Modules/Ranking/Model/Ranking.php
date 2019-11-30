<?php

namespace App\Modules\Ranking\Model;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    //
    protected $table='ranking';

   /* public function childRanking(){
        return $this->hasMany('App\Modules\Ranking\Model\Ranking','pid','id');
    }
    public function allChildRanking(){
        return $this->childRanking()->with('allChildRanking');
    }*/
}
