<?php

namespace App\Http\Controllers\Admin;

use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BetUserController extends Controller
{
    //
    private $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function listBetUser(){
        $list=$this->handle->getlist();
        return response()->json([
            'msg'=>'ok',
            'data'=>$list
        ]);
    }

    public function addBetUser(){
        $account=Input::get('account');
        $user=Input::get('username');
        $password=Input::get('password');
        $status=Input::get('status');
        $res=$this->handle->addBetUser($account,$user,$password,$status);
        return response()->json([
            'code'=>200,
            'msg'=>'ok'
        ]);

    }


}
