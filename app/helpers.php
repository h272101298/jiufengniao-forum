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
/**
 * 返回随机字符串
 */
if (!function_exists('createNonceStr')){
    function createNonceStr($length=10){
        $str='';
        $char='abcdefghijklmnopqrstuvwxyz0123456789';
        for ($i=0;$i<$length;$i++){
            $str .= substr($char,mt_rand(0,strlen($char)-1),1);
        }
        return $str;
    }
}
/**
 * 设置redis缓存数据
 *
 */
if (!function_exists('setRedisData')){
    function setRedisData($key,$value,$time=0){
        \Illuminate\Support\Facades\Redis::set($key,$value);
        if ($time!=0){
            \Illuminate\Support\Facades\Redis::expire($key,$time);
        }
    }

}
/**
 * 获取redis缓存数据
 */
if (!function_exists('getRedisData')){
    function getRedisData($key,$default=0){
        $data = \Illuminate\Support\Facades\Redis::get($key);
        if (!$data){
            return $default;
        }
        return $data;
    }
}
