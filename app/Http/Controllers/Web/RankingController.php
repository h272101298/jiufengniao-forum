<?php

namespace App\Http\Controllers\Web;

use App\Modules\Ranking\Model\Ranking;
use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    //
    protected $handle;
    public function __construct()
    {
        $this->handle=new User();
    }
    public function getRanking(){
        $data=Ranking::get()->toArray();
        $tree=$this->handle->getTree($data,'id','pid');
        return response()->json([
            'msg'=>'ok',
            'data'=>$tree
        ]);
    }
}
