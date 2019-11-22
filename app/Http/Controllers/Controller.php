<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createNonceStr($length=10){
        $str='';
        $char='abcdefghijklmnopqrstuvwxyz0123456789';
        for ($i=0;$i<$length;$i++){
            $str .= substr($char,mt_rand(0,strlen($char)-1),1);
        }
        return $str;
    }
}
