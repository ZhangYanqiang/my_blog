<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>管理员登录</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/myBlog.css')}}">
</head>
<body>
    <div class="user-login-box">
        <form method="post" action="#" class="user-longin-form">
            {{csrf_field()}}
            <div class="user-login-blog">BLOG</div>
            <div class="user-login-welcom">欢迎来到博客管理系统</div>
            @if(session('msg'))
                <p>{{session('msg')}}</p>
            @endif
            <div class="user-login-form-item">
                <label class="user-login-label">用户名</label>
                <div class="user-login-inline">
                    <input type="text" name="user_name" class="user-login-input" placeholder="请输入用户名">
                </div>
            </div>
            <div class="user-login-form-item">
                <label class="user-login-label">密码</label>
                <div class="user-login-inline">
                    <input type="password" name="user_pass" class="user-login-input" placeholder="请输入密码">
                </div>
            </div>
            <div class="user-login-form-item">
                <label class="user-login-label">验证码</label>
                <div class="user-login-inline">
                    <input type="text" name="code" class="user-login-input-code" placeholder="请输入验证码">
                    <img class="user-login-img" src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
                </div>

            </div>
            <div class="user-login-form-item">
                <button class="user-login-button">立即登录</button>
            </div>
        </form>
    </div>
</body>
</html>
