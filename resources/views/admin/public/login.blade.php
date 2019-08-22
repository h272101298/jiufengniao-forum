<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/admin/img/basic/favicon.ico')}}" type="image/x-icon">
    <title>Paper</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/app.css')}}">

</head>
<body class="light sidebar-mini sidebar-collapse">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <main>
        <div id="primary" class="blue4 p-t-b-100 height-full responsive-phone">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{asset('assets/admin/img/icon/icon-plane.png')}}" alt="">
                    </div>
                    <div class="col-lg-6 p-t-100">
                        <div class="text-white">
                            <h1>后台系统</h1>
                            <p class="s-18 p-t-b-20 font-weight-lighter">后台模板</p>
                        </div>
                        <form action="##" method="post" onsubmit="return false" id="form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                        <input name='username' type="text" class="form-control form-control-lg no-b" placeholder="账号">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                        <input name='password' type="text" class="form-control form-control-lg no-b"
                                               placeholder="密码">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    {{--<input type="hidden" name="_token" value="{{csrf_token()}}" >--}}
                                    <input type="button" onclick="login()" class="btn btn-success btn-lg btn-block" value="登陆">
                                    <p class="forget-pass text-white">忘记密码？</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #primary -->
    </main>
</div>
<!--/#app -->
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script type="text/javascript">
    function login() {
        $.ajax({
            url:"{{route('check')}}",
            type:'post',
            datatype:"json",
            data:$('#form').serialize(),
            success:function (data) {
              var json=eval(data);
                if (json.code == 401){
                    alert(json.msg);
                }
                if (json.code == 200){
                    window.location.href="{{route('index')}}";
                }
            },
            error:function (msg) {
                var json=JSON.parse(msg.responseText);
                $.each(json.errors,function (index,obj) {
                    alert(obj[0]);
                    return false;
                })
            }
        });
    }
</script>
</body>
</html>