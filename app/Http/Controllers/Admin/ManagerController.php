<?php

namespace App\Http\Controllers\Admin;

use App\Modules\Manager\Model\Manager;
use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ManagerController extends Controller
{
    //
    protected $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function index(){
        $page=Input::get('page',1);
        $limit=Input::get('limit',10);
        $data=$this->handle->listManager($page,$limit);
        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);
    }

    public function addManager(){
        $username=Input::get('username');
        $password=Input::get('password');
        $res=$this->handle->addManager($username,$password);
        if ($res){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }
        return response()->json([
            'msg'=>'账号已存在',
            'code'=>400
        ]);

    }

}
