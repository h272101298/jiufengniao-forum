@extends('admin.layout._header')
@section('content')
    <article class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="roleName" name="roleName">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">权限：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    @foreach($top as $value)
                        <dl class="permission-list">
                            <dt>
                                <label>
                                    <input type="checkbox" name="authId[]" id="user-Character-0" value="{{$value->id}}">{{$value->auth_name}}</label>
                            </dt>
                            <dd>
                                <dl class="cl permission-list2">
                                    @foreach($cat as $val)
                                        @if($val->pid == $value->id)
                                            <dt>
                                                <label class="">
                                                    <input type="checkbox" name="authId[]" id="user-Character-0-0" value="{{$val->id}}">{{$val->auth_name}}</label>
                                            </dt>
                                        @endif
                                    @endforeach
                                </dl>
                            </dd>
                        </dl>
                    @endforeach
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <button type="submit" class="btn btn-success radius" id="admin-role-save"><i class="icon-ok"></i> 确定</button>
                </div>
            </div>
        </form>
    </article>
@stop
@section('js')
    <script type="text/javascript" src="{{asset('assets/admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $(".permission-list dt input:checkbox").click(function(){
                $(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
            });
            $(".permission-list2 dd input:checkbox").click(function(){
                var l =$(this).parent().parent().find("input:checked").length;
                var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
                if($(this).prop("checked")){
                    $(this).closest("dl").find("dt input:checkbox").prop("checked",true);
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
                }
                else{
                    if(l==0){
                        $(this).closest("dl").find("dt input:checkbox").prop("checked",false);
                    }
                    if(l2==0){
                        $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
                    }
                }
            });

            $("#form-admin-role-add").validate({
                rules:{
                    roleName:{
                        required:false,
                    },
                },
                onkeyup:false,
                focusCleanup:true,
                success:"valid",
                submitHandler:function(form){
                    $(form).ajaxSubmit({
                        type: 'post',
                        url: "{{route('role/addData')}}" ,
                        datatype:'json',
                        success: function(data){
                            var json=eval(data);
                            if (json.code == 200) {
                                layer.msg(json.msg,{icon:1,time:1000},function () {
                                    var index = parent.layer.getFrameIndex(window.name);
                                    parent.$('.btn-refresh').click();
                                    parent.location.reload();
                                    parent.layer.close(index);
                                });
                            }
                            if (json.code == 401){
                                layer.msg(json.msg,{icon:2,time:1000},function () {
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
@stop