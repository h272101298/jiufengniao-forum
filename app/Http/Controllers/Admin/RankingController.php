<?php

namespace App\Http\Controllers\Admin;


use App\Modules\Ranking\Model\Ranking;
use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class RankingController extends Controller
{
    //
    private $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function listRanking(){
       $data=Ranking::get()->toArray();
       $tree=$this->handle->getTree($data,'id','pid');
       return response()->json([
           'msg'=>'ok',
           'data'=>$tree
       ]);
    }

    public function addRanking(){
        $level=Input::get('level',1);
        $rankname=Input::get('rankname');
        $pid=Input::get('pid',0);
        $res=$this->handle->addRanking($level,$rankname,$pid);
        if ($res){
            return response()->json([
                'msg'=>'ok',
                'code'=>200
            ]);
        }
    }

    public function getRanking(){
        $id=Input::get('id');
        $data=$this->handle->getRanking($id);
        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);
    }

    public function editRanking(){
        $data=[
            'id'=>Input::get('id'),
            'rankname'=>Input::get('rankname'),
            'level'=>Input::get('level'),
            'pid'=>Input::get('pid',0)
        ];
        $res=$this->handle->editRanking($data);
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


}
