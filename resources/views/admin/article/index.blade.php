@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="info-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;文章管理
    </div>
<form action="#" method="post">
    <div class="info-nav-middle">
        <h3>文章列表</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/article/create')}}"><i>添加文章</i></a>
            <a href="{{url('admin/article')}}"><i>批量删除</i></a>
            <a href="{{url('admin/article')}}"><i>更新排序</i></a>
        </div>
    </div>
    <div class="cate-list-box">
        <table class="cate-list-tab">
            <tr>
                <th class="art-tc-id">ID</th>
                <th class="art-title">文章标题</th>
                <th class="art-tc-id">点击</th>
                <th class="art-editor">编辑</th>
                <th class="art-tc-date">发布时间</th>
                <th class="art-tc-date">操作</th>
            </tr>

            @foreach($data as $v)
            <tr>
                <td class="art-tc-id">
                    {{$v->art_id}}
                </td>
                <td class="art-title">
                    {{$v->art_title}}
                </td>
                <td class="art-tc-id">
                    {{$v->art_view}}
                </td>
                <td class="art-editor">
                    {{$v->art_editor}}
                </td>
                <td class="art-tc-date">
                    {{date('Y-m-d',$v->art_time)}}
                </td>
                <td class="art-tc-date">
                    <a href="{{url('admin/article/'.$v->art_id.'/edit')}}" class="">修改</a>
                    <a href="javascript:" onclick="delArt({{$v->art_id}})">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="art-page-list">
            {{$data->links()}}
        </div>
    </div>
</form>
</div>
<style>

</style>
<script>
    //删除分类
    function delArt(art_id) {
        var re = confirm('您确定要删除这篇文章吗？');
        if(re == 1){
            $.post("{{url('admin/article/')}}/"+art_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if(data.status==0){
                    location.href = location.href;
                    alert(data.msg);
                }else{
                    alert(data.msg);
                }
            });
        }
        else{
        }
    }
</script>
@endsection