@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="info-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;文章分类
    </div>
<form action="#" method="post">
    <div class="info-nav-middle">
        <h3>分类列表</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/category')}}"><i>全部分类</i></a>
            <a href="{{url('admin/category/create')}}"><i>添加分类</i></a>
        </div>
    </div>
    <div class="cate-list-box">
        <table class="cate-list-tab">
            <tr>
                <th class="cate-tc-id">排序</th>
                <th class="cate-tc-id">ID</th>
                <th class="cate-tc">分类名称</th>
                <th class="cate-tc">标题</th>
                <th class="cate-tc-id">查看次数</th>
                <th class="cate-tc">操作</th>
            </tr>

            @foreach($data as $v)
            <tr>
                <td class="cate-tc-id">
                    <input type="text" onchange="changeOrder(this,'{{$v->cate_id}}')" value="{{$v->cate_order}}">
                </td>
                <td class="cate-tc-id">
                    {{$v->cate_id}}
                </td>
                <td class="cate-tc">
                    {{$v->_cate_name}}
                </td>
                <td class="cate-tc">
                    {{$v->cate_title}}
                </td>
                <td class="cate-tc-id">
                    {{$v->cate_view}}
                </td>
                <td class="cate-tc-a">
                    <a href="{{url('admin/category/'.$v->cate_id.'/edit')}}" class="">修改</a>
                    <a href="javascript:;" onclick="delCate({{$v->cate_id}})">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</form>
</div>
<script>
    function changeOrder(obj,cate_id){
        var cate_order = $(obj).val();
        $.post("{{url('admin/cate/changeorder')}}",{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},function(data){
            if(data.status == 0){
                alert(data.msg);
            }else{
                alert(data.msg);
            }

        });
    }
    //删除分类
    function delCate(cate_id) {
        var re = confirm('您确定要删除这个分类吗？');
        if(re == 1){
            $.post("{{url('admin/category/')}}/"+cate_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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