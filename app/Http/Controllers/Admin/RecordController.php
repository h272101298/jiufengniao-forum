<?php

namespace App\Http\Controllers\Admin;

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

    public function listRecord(){
        $preDrawIssue=Input::get('preDrawIssue');
        $page=Input::get('page',1);
        $limit=Input::get('limit',10);
        $data=$this->handle->listRecord($preDrawIssue,$page,$limit);
        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);
    }

}
