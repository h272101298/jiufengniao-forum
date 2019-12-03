<?php

namespace App\Http\Controllers\Web;

use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


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
    public function getResults(){
        $data=$this->handle->getResults();
        return response()->json([
            'msg'=>'ok',
            'data'=>$data
        ]);
    }

    public function countResults(){
        $issue=Input::get('preDrawIssue');
        $this->handle->countResults($issue);


    }
}
