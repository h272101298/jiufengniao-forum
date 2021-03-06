<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/5 0005
 * Time: 14:18
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class LoginPost extends FormRequest
{
    /**
     * 确定用户是否有权发出此请求
     **/
    public function authorize(){
        return true;
    }
    /**
     * 获取适用于请求的验证规则
     **/
    public function rules(){
        return [
            //
            'username'=>'required',
            'password'=>'required'
        ];
    }
    public function messages(){
        return [
            'username.required'=>"用户名不能为空",
            'password.required'=>'密码不能为空'
        ]; // TODO: Change the autogenerated stub
    }

}
