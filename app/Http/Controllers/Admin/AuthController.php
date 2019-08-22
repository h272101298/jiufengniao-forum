<?php

namespace App\Http\Controllers\Admin;

use App\Modules\Auth\Model\Auth;
use App\Modules\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class AuthController extends Controller
{
    //
    private $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function index(){
        $data=$this->handle->getAuth();
        return view('admin.auth.index',compact('data'));
    }
    public function add(){
        $parents=DB::table('auths')->where('pid',0)->get();
        return view('admin.auth.add',compact('parents'));
    }
    public function addData(){
        $data=[
            'auth_name'=>Input::get('auth_name'),
            'controller'=>strtolower(Input::get('controller')),
            'action'=>strtotime(Input::get('action')),
            'pid'=>Input::get('pid'),
            'is_nav'=>Input::get('is_nav')
        ];
        $result=$this->handle->addAuth($data);
        if ($result){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'添加失败',
                'code'=>401
            ]);
        }
    }
    public function delete(){
        $id=Input::get('id');
        $check=$this->handle->checkRole($id);
        if ($check){
           $this->handle->editRole($id);
           $result=$this->handle->deleteAuth($id);

        }else{
            $result=$this->handle->deleteAuth($id);
        }
        if ($result){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'error',
                'code'=>401
            ]);
        }

    }

}
