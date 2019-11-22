<?php


namespace App\Modules\BetUser;


use Illuminate\Support\Facades\DB;

trait BetUserHandle
{
    public function getlist(){
        $list=DB::table('bet_user')->get();
        return $list;
    }

    public function addBetUser($account,$username,$password,$status){
        $data=[
            'account'=>$account,
            'username'=>$username,
            'password'=>bcrypt($password),
            'status'=>$status
        ];
        $res=DB::table('bet_user')->insert($data);
        return $res;
    }


}
