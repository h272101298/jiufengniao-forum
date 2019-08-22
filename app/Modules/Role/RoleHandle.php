<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/21 0021
 * Time: 10:24
 */

namespace App\Modules\Role;


use App\Modules\Auth\Model\Auth;
use Illuminate\Support\Facades\DB;

trait RoleHandle
{
    public function addRole($data){
        //处理数据
        $ids['role_name']=$data['roleName'];
        //获取auth_ids字段,用implode()把数组转化成字符串
        $ids['auth_ids']=implode(',',$data['authId']);
        //获取auth_ac,使用sql中的in语法进行查询
        $tmp=Auth::where('pid','>',0)->whereIn('id',$data['authId'])->get();
        //循环拼凑controller和action
        $ac="";
        foreach ($tmp as $value){
            $ac .= $value->controller.'@'.$value->action.',';
        }
        //除去末尾的逗号,先用strtolower()转换字符串大小写,然后用rtrim()移除右侧的字符串
        $ids['auth_ac']=rtrim(strtolower($ac),',');
        //新增数据
        $result=DB::table('roles')->insert($ids);
        return $result;
    }

}