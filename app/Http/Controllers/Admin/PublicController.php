<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\LoginPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{

    public function login(){
        return view('admin.public.login');
    }
    /**
     *数据验证通过LoginPost验证
     */
    public function check(LoginPost $post){
        $username=$post->username;
        $password=$post->password;
        //验证登陆
        $check=Auth::guard('admin')->attempt(['username'=>$username,'password'=>$password],false);

        if ($check){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=> '用户名或密码错误',
                'code'=>500
            ]);
        }
    }
}
