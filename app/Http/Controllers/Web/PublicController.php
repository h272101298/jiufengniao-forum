<?php

namespace App\Http\Controllers\Web;

use App\Http\Request\BetLoginPost;

use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;

class PublicController extends Controller
{
    //
    protected $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function betLogin(BetLoginPost $post){
        $account=$post->account;
        $password=$post->password;
        $auth=Auth::guard('bet');
        $check=$auth->attempt(['account'=>$account,'password'=>$password],false);
        if ($check){
            if ($auth->user()->status == 1){
                $token=createNonceStr(8);
                setRedisData('token',$token);
                setRedisData('user_id',$auth->id());
                return response()->json([
                    'msg'=>'ok',
                    'code'=>200,
                    'data'=>[
                        'token'=>$token,
                        'user_id'=>$auth->id(),
                        'user_name'=>$auth->user()->username,
                        'cur_integral'=>$auth->user()->cur_integral
                    ]
                ]);
            }else{
                return response()->json([
                    'msg'=> '账号被禁用,请联系客服',
                    'code'=>500
                ]);
            }


        }else{
            return response()->json([
                'msg'=> '用户名或密码错误',
                'code'=>500
            ]);
        }
    }
    public function loginOut(){
        Auth::guard('bet')->logout();
        Redis::del('token');
        Redis::del('user_id');
        return response()->json([
            'msg'=>'ok',
            'code'=>200
        ]);
    }

    public function intDetails(){
        $id=Input::get('id',getRedisData('user_id'));
        $page=Input::get('page',1);
        $limit=Input::get('limit',10);
        $data=$this->handle->intDetails($id,$page,$limit);
        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);
    }
}
