
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="{{asset('/favicon.ico')}}">
    <link rel="Shortcut Icon" href="{{asset('/favicon.ico')}}"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('assets/admin/lib/html5shiv.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/lib/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/static/h-ui/css/H-ui.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/static/h-ui.admin/css/H-ui.admin.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/static/h-ui.admin/skin/green/skin.css')}}"
          id="skin"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/static/h-ui.admin/css/style.css')}}"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="{{asset('assets/admin/lib/DD_belatedPNG_0.0.8a-min.js')}}"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>后台系统</title>
</head>
<body>
@yield('content')
@include('admin.layout._footer')
@yield('js')
</body>
</html>