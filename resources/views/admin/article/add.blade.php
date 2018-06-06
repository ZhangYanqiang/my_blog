@extends('layouts.admin')
@section('content')
{{--导航--}}
<div class="add-cate-body">
    <div class="info-nav-top">
        <a href="{{url('admin/info')}}">首页</a> &raquo;添加文章
    </div>
    <div class="info-nav-middle">
        <h3>快捷操作</h3>
        <div class="info-nav-wrap">
            <a href="{{url('admin/article')}}"><i>全部文章</i></a>
            <a href="{{url('admin/article/create')}}"><i>添加文章</i></a>
        </div>

    </div>
    <form action="{{url('admin/article')}}" method="post">
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
                    <th><i class="require">*</i>分类</th>
                    <td>
                        <select name="cate_id">
                            @foreach($data as $d)
                                <option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>文章标题</th>
                    <td>
                        <input type="text" name="art_title">
                    </td>
                </tr>
                <tr>
                    <th>编辑</th>
                    <td>
                        <input type="text" name="art_editor">
                    </td>
                </tr>
                <tr>
                    <th>缩略图</th>
                    <td>
                        <input type="text" name="art_thumb">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                        <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                                $('#file_upload').uploadify({
                                    'buttonText'   : '图片上传',
                                    'formData'     : {
                                        'timestamp' : '<?php echo $timestamp;?>',
                                        '_token'     : "{{csrf_token()}}"
                                    },
                                    'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                    'uploader' : "{{url('admin/upload')}}",
                                    'onUploadSuccess' : function(file, data, response) {
                                        $('input[name=art_thumb]').val(data);
                                        $('#art_thumb_img').attr('src','/'+data);
                                    }
                                });
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height: 200px;">
                     </td>
                </tr>
                <tr>
                    <th>关键词</th>
                    <td>
                        <input type="text" name="art_tag">
                    </td>
                </tr>
                <tr>
                    <th>描述</th>
                    <td>
                        <textarea name="art_description"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>文章内容</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="art_content" type="text/plain" style="width:1024px; height:500px;"></script>
                        <script type="text/javascript">
                            var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>

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