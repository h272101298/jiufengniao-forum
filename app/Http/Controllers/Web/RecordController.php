<?php

namespace App\Http\Controllers\Web;


use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RecordController extends Controller
{
    //
    protected $handle;
    public function __construct()
    {
        $this->handle=new User();
    }
    public function betRecord(){
        $id=Input::get('userid');
        $issue=Input::get('drawIssue');
        $record=Input::get('record');
        $check=$this->handle->checkRecode($id,$issue);
        if (!$check){
            $res=$this->handle->addRecord($id,$issue,$record);
            if ($res){
                return response()->json([
                    'msg'=>'ok',
                    'code'=>200
                ]);
            }else{
                return response()->json([
                    'msg'=>'下注失败',
                    'code'=>400
                ]);
            }
        }else{
            return response()->json([
                'msg'=>'已下注,请确认是否重新下注',
                'code'=>400
            ]);
        }

    }
    public function resetRocord(){
        $id=Input::get('userid');
        $issue=Input::get('drawIssue');
        $record=Input::get('record');
    }
}
