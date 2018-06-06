@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="info-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;系统基本信息
    </div>

    <div class="info-result-wrap">
        <h3>系统基本信息</h3>
        <div class="info-result-content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>版本</label><span>V_1.00.0</span>
                </li>
                <li>
                    <label>上传附件限制</label><span><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件";  ?></span>
                </li>
                <li>
                    <label>北京时间</label><span><?php echo date('Y年m月d日 H时i分s秒');?></span>
                </li>
                <li>
                    <label>服务器域名</label><span>{{$_SERVER['SERVER_NAME']}}[{{$_SERVER['SERVER_ADDR']}}]</span>
                </li>
                <li>
                    <label>HOST</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
                </li>

            </ul>
        </div>
    </div>
</div>
@endsection