@extends('layouts.admin')
@section('content')
<div class="index-nav-body">
    <div class="index-nav-top">
        <ul class="index-nav-top-left">
            <li class="index-nav-item">后台管理页面</li>
            <li class="index-nav-item"><a href="{{url('admin/info')}}" target="main">首页</a></li>
            <li class="index-nav-item"><a href="{{url('admin/info')}}" target="main">管理页</a></li>
        </ul>
        <ul class="index-nav-top-right">
            <li class="index-nav-item"><a href="{{url('admin/quit')}}">退出</a></li>
            <li class="index-nav-item"><a href="{{url('admin/pass')}}" target="main">修改密码</a></li>
            <li class="index-nav-item"><a href="#">管理员：admin</a></li>
        </ul>
    </div>
    <div class="index-nav-left">
        <ul class="index-nav-left-tree">
            <li class="index-nav-item"><a href="#">文章分类</a>
                <dl class="index-nav-item-child">
                    <dd><a href="{{url('admin/category')}}" target="main">全部分类</a></dd>
                    <dd><a href="{{url('admin/category/create')}}" target="main">添加分类</a></dd>
                </dl>
            </li>
            <li class="index-nav-item"><a href="#">文章编辑</a>
                <dl class="index-nav-item-child">
                    <dd><a href="{{url('admin/article')}}" target="main">全部文章</a></dd>
                    <dd><a href="{{url('admin/article/create')}}" target="main">添加文章</a></dd>
                </dl>
            </li>
            <li class="index-nav-item"><a href="#">友情链接</a>
                <dl class="index-nav-item-child">
                    <dd><a href="{{url('admin/links')}}" target="main">全部链接</a></dd>
                    <dd><a href="{{url('admin/links/create')}}" target="main">添加链接</a></dd>
                </dl>
            </li>
            <li class="index-nav-item"><a href="#">导航详情</a>
                <dl class="index-nav-item-child">
                    <dd><a href="{{url('admin/navs')}}" target="main">全部导航</a></dd>
                    <dd><a href="{{url('admin/navs/create')}}" target="main">添加导航</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    {{--主体部分开始--}}
    <div class="main_box">
        <iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
    </div>
</div>
@endsection