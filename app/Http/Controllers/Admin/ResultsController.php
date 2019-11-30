<?php

namespace App\Http\Controllers\Admin;

use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

class ResultsController extends Controller
{
    //
    protected $handle;

    public function __construct()
    {
        $this->handle=new User();
    }

    public function listResults(){
        $page=Input::get('page',1);
        $limit=Input::get('limit',10);
        $data=$this->handle->listResults($page,$limit);
        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);
    }

    public function addResults(){
        $res=$this->handle->addResults();
        if ($res){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'已存在',
                'code'=>400
            ]);
        }


    }

}
