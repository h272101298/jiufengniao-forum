<?php

namespace App\Http\Controllers\Admin;

use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\DataCollector\DumpDataCollector;

class BetUserController extends Controller
{
    //
    private $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function listBetUser(){
        $page=Input::get('page',1);
        $limit=Input::get('limit',10);
        $list=$this->handle->getlist($page,$limit);
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
        if ($res){
           return response()->json([
               'code'=>200,
               'msg'=>'ok'
           ]);
        }else{
            return response()->json([
                'code'=>400,
                'msg'=>'添加失败'
            ]);
        }


    }
    public function getBetUser(){
        $id=Input::get('id');
        $res=$this->handle->getBetUser($id);
        return response()->json([
            'msg'=>'ok',
            'data'=>$res
        ]);
    }
    public function editBetUser(Request $post){
        $data=[
            'id'=>$post->id?$post->id:0,
            'username'=>$post->username,
            'status'=>$post->status
        ];
        $res=$this->handle->editBetUser($data);
        if ($res){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'没有修改数据',
                'code'=>400
            ]);
        }
    }
    public function resetPossword(){
        $id=Input::get('id');
        $possword=Input::get('password');
        $res=$this->handle->resetPassword($id,$possword);
        if ($res){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'重置失败',
                'code'=>400
            ]);
        }

    }
    public function setIntegral(){
        $id=Input::get('id');
        $integral=Input::get('integral');
        $res=$this->handle->setIntegral($id,$integral);
        if ($res){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'充值失败',
                'code'=>400
            ]);
        }
    }

    public function intDetails(){
        $userid=Input::get('userid');
        $page=Input::get('page',1);
        $limit=Input::get('limit',10);
        $data=$this->handle->intDetails($userid,$page,$limit);

        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);

    }




}
