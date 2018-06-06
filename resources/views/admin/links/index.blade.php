@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="info-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;友情链接
    </div>
<form action="#" method="post">
    <div class="info-nav-middle">
        <h3>友情链接</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/links')}}"><i>全部链接</i></a>
            <a href="{{url('admin/links/create')}}"><i>添加链接</i></a>
        </div>
    </div>
    <div class="cate-list-box">
        <table class="cate-list-tab">
            <tr>
                <th class="cate-tc-id">排序</th>
                <th class="cate-tc-id">ID</th>
                <th class="cate-tc">链接名称</th>
                <th class="cate-tc">链接地址</th>
                <th class="cate-tc">操作</th>
            </tr>

            @foreach($data as $v)
            <tr>
                <td class="cate-tc-id">
                    <input type="text" onchange="changeOrder(this,'{{$v->link_id}}')" value="{{$v->link_order}}">
                </td>
                <td class="cate-tc-id">
                    {{$v->link_id}}
                </td>
                <td class="cate-tc">
                    {{$v->link_name}}
                </td>
                <td class="cate-tc">
                    {{$v->link_url}}
                </td>
                <td class="cate-tc-a">
                    <a href="{{url('admin/links/'.$v->link_id.'/edit')}}" class="">修改</a>
                    <a href="javascript:;" onclick="delLink({{$v->link_id}})">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</form>
</div>
<script>
    function changeOrder(obj,link_id){
        var link_order = $(obj).val();
        $.post("{{url('admin/links/changeOrder')}}",{'_token':'{{csrf_token()}}','link_id':link_id,'link_order':link_order},function(data){
            if(data.status == 0){
                alert(data.msg);
            }else{
                alert(data.msg);
            }

        });
    }
    //删除链接
    function delLink(link_id) {
        var re = confirm('您确定要删除这个友情链接吗？');
        if(re == 1){
            $.post("{{url('admin/links/')}}/"+link_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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