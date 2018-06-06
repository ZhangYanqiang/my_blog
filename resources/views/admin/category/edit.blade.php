@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="add-cate-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;文章分类
    </div>
    <div class="info-nav-middle">
        <h3>快捷操作</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/category')}}"><i>全部分类</i></a>
            <a href="{{url('admin/category/create')}}"><i>添加分类</i></a>
        </div>

    </div>
    <form action="{{url('admin/category/'.$field->cate_id)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="error-msg">
            @if(count($errors) > 0)
                <?php dd($errors->first('cate_name')); ?>
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
                    <th><i class="require">*</i>父级分类</th>
                    <td>
                        <select name="cate_pid">
                            <option value="">==顶级分类==</option>
                            @foreach($data as $d)
                                <option value="{{$d->cate_id}}"
                                    @if($d->cate_id==$field->cate_pid) selected @endif
                                >{{$d->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名称</th>
                    <td>
                        <input type="text" name="cate_name" value="{{$field->cate_name}}">
                        <span>分类名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>分类标题</th>
                    <td>
                        <input type="text" name="cate_title" value="{{$field->cate_name}}">
                    </td>
                </tr>
                <tr>
                    <th>关键词</th>
                    <td>
                        <textarea name="cate_keywords" value="{{$field->cate_keywords}}"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>描述</th>
                    <td>
                        <textarea name="cate_description" value="{{$field->cate_description}}"></textarea>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序</th>
                    <td>
                        <input type="text" name="cate_order" value="{{$field->cate_order}}">
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