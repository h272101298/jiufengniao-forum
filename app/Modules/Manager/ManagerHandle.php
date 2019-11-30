<?php


namespace App\Modules\Manager;


use Illuminate\Support\Facades\DB;

trait ManagerHandle
{
    public function listManager($page,$limit){
        $data=DB::table('users')->limit($limit)->offset(($page-1)*$limit)->get();
        return $data;
    }
    public function addManager($username,$password){
        $password=bcrypt($password);
        $db=DB::table('users');
        $check=$db->where('username',$username)->first();
        if (!$check){
            $res=$db->insert(['username'=>$username,'password'=>$password]);
            return $res;
        }
        return false;
    }

}
