@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="add-cate-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;添加导航
    </div>
    <div class="info-nav-middle">
        <h3>导航</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/navs')}}"><i>全部导航</i></a>
            <a href="{{url('admin/navs/create')}}"><i>添加导航</i></a>
        </div>

    </div>
    <form action="{{url('admin/navs')}}" method="post">
        {{csrf_field()}}
        <div class="error-msg">
            @if(count($errors) > 0)
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                @else
                    {{$errors}}
                @endif
            @endif

        </div>
        <div class="add-cate-box">
            <table class="add-cate-table">
                <tbody>
                <tr>
                    <th><i class="require">*</i>导航名称</th>
                    <td>
                        <input type="text" name="nav_name">
                        <span>导航名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>导航别名</th>
                    <td>
                        <input type="text" name="nav_alias">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>URL</th>
                    <td>
                        <input type="text" name="nav_url" value="http://">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序</th>
                    <td>
                        <input type="text" name="nav_order" value="0">
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button type="submit" class="button">提交</button>
                        <button type="button" class="button" onclick="history.go(-1)">返回</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>
@endsection