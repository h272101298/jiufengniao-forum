<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/9 0009
 * Time: 15:55
 */
/**
 *  返回校验消息
 */
if (!function_exists('getRequestMsg')){
    function getRequestMsg($key){
        $msg=config('massage'.$key);
        return $msg;
    }
}