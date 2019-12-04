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
        dd(bcrypt($password));
        $auth=Auth::guard('admin');
        //验证登陆
        $check=$auth->attempt(['username'=>$username,'password'=>$password],false);
        if ($check){
            //生成新的token值
            $token=createNonceStr(8);
            //保存token和userid到reids
            setRedisData('token',$token);
            setRedisData('user_id',Auth::guard('admin')->id());
            return response()->json([
                'msg'=>'ok',
                'code'=>200,
                'data'=>[
                    'token'=>$token,
                    'user_id'=>$auth->id(),
                    'user_name'=>$auth->user()->username
                ]
            ]);
        }else{
            return response()->json([
                'msg'=> '用户名或密码错误',
                'code'=>500
            ]);
        }
    }
}
