@extends('admin.layout._header')
@section('content')
    <article class="page-container">
        <form class="form form-horizontal" id="form-admin-add">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="auth_name" name="auth_name">
                </div>
            </div>
            <div class="row cl" style="display: none">
                <label class="form-label col-xs-4 col-sm-3">控制器：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="controller" name="controller">
                </div>
            </div>
            <div class="row cl" style="display: none">
                <label class="form-label col-xs-4 col-sm-3">方法：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" name="action" id="action">
                </div>
            </div>
            <div class="row cl" >
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级权限：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <span class="select-box" style="width:150px;">
                        <select class="select" name="pid" size="1">
                            <option value="0">顶级权限</option>
                            @foreach($parents as $val)
                                <option value="{{$val->id}}">{{$val->auth_name}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="is_nav" value="1" type="radio" id="is_nav-1" checked>
                        <label for="is_nav-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" value="2" id="is_nav-2" name="is_nav">
                        <label for="is_nav-2">否</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>
@stop
@section('js')
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="{{asset('assets/admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            //jQuery隐藏控制器和方法的表单项
            //给下拉表单绑定切换事件
            $('select').change(function () {
                //获取当前选中的值
                var _val=$(this).val();
                if (_val > 0){
                    //显示表单项
                    $('#controller,#action').parents('.row').show(500);
                }else {
                    //重置表单项的值
                    $('#controller,#action').val('');
                    //隐藏表单项
                    $('#controller,#action').parents('.row').hide(500);
                }
            });
            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });

            $("#form-admin-add").validate({
                rules:{
                    auth_name:{
                        required:true,
                        minlength:4,
                        maxlength:16
                    },
                    is_nav:{
                        required:true,
                    },
                    pid:{
                        required:true,
                    },
                },
                onkeyup:false,
                focusCleanup:true,
                success:"valid",
                submitHandler:function(form){
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: "{{route('auth/addAuthData')}}" ,
                        datatype:'json',
                        success: function(data){
                            var json=eval(data);
                            if (json.code == 200) {
                                layer.msg('添加成功!',{icon:1,time:1000},function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    parent.layer.close(index);
                                });
                            }
                            if (json.code == 401){
                                layer.msg('添加失败!',{icon:2,time:1000},function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    parent.layer.close(index);
                                });
                            }

                        }
                    });

                }
            });
        });
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
@stop

