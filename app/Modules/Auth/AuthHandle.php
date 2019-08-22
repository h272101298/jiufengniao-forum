<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/19 0019
 * Time: 10:59
 */

namespace App\Modules\Auth;


use App\Modules\Auth\Model\Auth;
use App\Modules\Role\Model\Role;
use Illuminate\Support\Facades\DB;

trait AuthHandle
{
    public function getAuth(){
        $db=DB::table('auths');
        $result=$db->get();
        foreach ($result as $key=>$value){
            if ($value->pid !== 0){
                $parent_name=$db->where('id',$value->pid)->value('auth_name');
                $value->parent_name=$parent_name;
            }else{
                $value->parent_name='顶级权限';
            }
        }
        return $result;
    }
    public function addAuth($data){
        $result=DB::table('auths')->insert($data);
        return $result;
    }
    public function deleteAuth($id){
        $result=DB::table('auths')->where('id',$id)->delete();
        return $result;
    }
    public function checkRole($id){
        $role=DB::table('roles')->where('auth_ids','like','%'.$id.'%')->get();
        if ($role){
            return true;
        }else{
            return false;
        }
    }
    public function editRole($id){
        $role=DB::table('roles')->get();
        foreach ($role as $value){
            $authIds=explode(',',$value->auth_ids);
            $check=array_search($id,$authIds);
            if ($check){
                unset($authIds[$check]);
                $value->auth_ac=$this->edidRoleAuthAc($value->id,$authIds);
            }
            $value->auth_ids=implode(',',$authIds);
            $data=[
                'auth_ids'=>$value->auth_ids,
                'auth_ac'=>$value->auth_ac
            ];
            $result[]=DB::table('roles')->where('id',$value->id)->update($data);
        }
        return $result=array_sum($result);

    }
    public function edidRoleAuthAc($role_id,$auth_ids){
        $tmp=DB::table('auths')->where('pid','>',0)->whereIn('id',$auth_ids)->get();
        $ac="";
        foreach ($tmp as $value){
            $ac .= $value->controller.'@'.$value->action.',';
        }
        $ac=rtrim(strtolower($ac),',');
        return $ac;
    }

}