@extends('admin.layout._header')
@section('content')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c">
            <form class="Huiform" method="post" action="" target="_self">
                <input type="text" class="input-text" style="width:250px" placeholder="权限名称" id="" name="">
                <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','{{route('auth/add')}}','','450')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr>
                <th scope="col" colspan="8">权限节点</th>
            </tr>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
                <th width="200">权限名称</th>
                <th width="200">控制器名</th>
                <th width="200">方法名</th>
                <th width="200">父级权限</th>
                <th width="200">作为导航</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody>
           @foreach($data as $val)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$val->id}}" name=""></td>
                    <td>{{$val->id}}</td>
                    <td>{{$val->auth_name}}</td>
                    <td>{{$val->controller ? $val->controller : 'N/A'}}</td>
                    <td>{{$val->action ? $val->action :'N/A'}}</td>
                    <td>{{$val->parent_name ? $val->parent_name : '顶级权限'}}</td>
                    <td>{{$val->is_nav == 1 ? '是' : '否'}}</td>
                    <td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('角色编辑','','1','','310')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,{{$val->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('js')
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="{{asset('assets/admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
        //jQuery的页面加载
        //初始化datatables
        $(function () {
            $('table').dataTable({
                'aaSorting':[[1,'acs']],
                'aoColumnDefs':[{'orderable':false,"aTargets":0}]
            });
        });


        /*
            参数解释：
            title	标题
            url		请求的url
            id		需要操作的数据id
            w		弹出层宽度（缺省调默认值）
            h		弹出层高度（缺省调默认值）
        */
        /*管理员-权限-添加*/
        function admin_permission_add(title,url,w,h){
            layer_show(title,url,w,h);
        }
        /*管理员-权限-编辑*/
        function admin_permission_edit(title,url,id,w,h){
            layer_show(title,url,w,h);
        }

        /*管理员-权限-删除*/
        function admin_permission_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    type: 'POST',
                    url: '{{route('auth/delete')}}',
                    dataType: 'json',
                    data:{id:id},
                    success: function(data){
                        var json=eval(data);
                        if (json.code == 200){
                            layer.msg('删除成功',{icon: 1,time:1000},function () {
                                window.location.href;
                            })
                        }
                        if (json.code == 401){
                            layer.msg('删除失败',{icon: 2,time: 1000},function () {
                                window.location.href;
                            })
                        }
                    },
                    error:function(data) {
                        console.log(data.msg);
                    },
                });
            });
        }
    </script>
@stop
