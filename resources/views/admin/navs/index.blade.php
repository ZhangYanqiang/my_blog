@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="info-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;导航管理
    </div>
<form action="#" method="post">
    <div class="info-nav-middle">
        <h3>导航栏</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/navs')}}"><i>全部导航</i></a>
            <a href="{{url('admin/navs/create')}}"><i>添加导航</i></a>
        </div>
    </div>
    <div class="cate-list-box">
        <table class="cate-list-tab">
            <tr>
                <th class="cate-tc-id">排序</th>
                <th class="cate-tc-id">ID</th>
                <th class="cate-tc">导航名称</th>
                <th class="cate-tc">导航别名</th>
                <th class="cate-tc">导航地址</th>
                <th class="cate-tc">操作</th>
            </tr>

            @foreach($data as $v)
            <tr>
                <td class="cate-tc-id">
                    <input type="text" onchange="changeOrder(this,'{{$v->nav_id}}')" value="{{$v->nav_order}}">
                </td>
                <td class="cate-tc-id">
                    {{$v->nav_id}}
                </td>
                <td class="cate-tc">
                    {{$v->nav_name}}
                </td>
                <td class="cate-tc">
                    {{$v->nav_alias}}
                </td>
                <td class="cate-tc">
                    {{$v->nav_url}}
                </td>
                <td class="cate-tc-a">
                    <a href="{{url('admin/navs/'.$v->nav_id.'/edit')}}" class="">修改</a>
                    <a href="javascript:;" onclick="delNavs({{$v->nav_id}})">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</form>
</div>
<script>
    function changeOrder(obj,nav_id){
        var nav_order = $(obj).val();
        $.post("{{url('admin/navs/changeOrder')}}",{'_token':'{{csrf_token()}}','nav_id':nav_id,'nav_order':nav_order},function(data){
            if(data.status == 0){
                alert(data.msg);
            }else{
                alert(data.msg);
            }

        });
    }
    //删除链接
    function delNavs(nav_id) {
        var re = confirm('您确定要删除这个导航吗？');
        if(re == 1){
            $.post("{{url('admin/navs/')}}/"+nav_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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