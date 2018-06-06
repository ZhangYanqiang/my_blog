@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="add-cate-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;友情链接
    </div>
    <div class="info-nav-middle">
        <h3>友情链接</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/links')}}"><i>全部链接</i></a>
            <a href="{{url('admin/links/create')}}"><i>添加链接</i></a>
        </div>

    </div>
    <form action="{{url('admin/links/'.$field->link_id)}}" method="post">
        <input type="hidden" name="_method" value="put">
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
                    <th><i class="require">*</i>友情链接名称</th>
                    <td>
                        <input type="text" name="link_name" value="{{$field->link_name}}">
                        <span>链接名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>链接标题</th>
                    <td>
                        <input type="text" name="link_title" value="{{$field->link_title}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>URL</th>
                    <td>
                        <input type="text" name="link_url" value="{{$field->link_url}}">
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序</th>
                    <td>
                        <input type="text" name="link_order" value="{{$field->link_order}}">
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