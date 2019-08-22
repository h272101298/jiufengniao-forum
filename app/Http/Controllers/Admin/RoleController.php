<?php

namespace App\Http\Controllers\Admin;

use App\Modules\Role\Model\Role;
use App\Modules\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RoleController extends Controller
{
    //
    private $handle;
    public function __construct()
    {
        $this->handle=new User();
    }

    public function index(){
        $data=Role::all();
        return view('admin.role.index',compact('data'));
    }
    public function addRole(){

        //获取一级权限
        $top=DB::table('auths')->where('pid',0)->get();
        //获取二级权限
        $cat=DB::table('auths')->where('pid','!=',0)->get();
        //获取当前角色的ids
        //$ids=Role::where('id',$role_id)->value('auth_ids');
        //$ids=explode(',',$ids);

        return view('admin.role.add',compact('top','cat'));
    }
    public function addData(){
        $data=Input::only(['roleName','authId']);
        $result=$this->handle->addRole($data);
        if ($result){
            return response()->json([
                'msg'=>'添加成功',
                'code'=>200
            ]);
        }else{
            return response()->json([
                'msg'=>'添加失败',
                'code'=>401
            ]);
        }
    }
}
