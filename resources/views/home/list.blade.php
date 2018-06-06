@extends('layouts.home')
@section('content')
    <div class="home-index-art">
        <div class="home-index-p">
            <p>文章推荐</p>
        </div>
        @foreach($data as $d)
            <div class="home-index-tj">
                @if($d->art_thumb==null)
                    <img src="/uploads/mr.jpg">
                @else
                    <img src="{{$d->art_thumb}}">
                @endif
                <div class="home-index-article">
                    <a href=""><h3>{{$d->art_title}}</h3></a>
                    <p>{{$d->art_description}}</p>
                </div>
                <div class="keywords">
                    <dt>关键词:</dt><dd>{{$d->art_tag}}</dd>
                </div>
                <a class="readmore" href="{{url('art/'.$d->art_id)}}">阅读全文</a>
                <div class="author">
                    <ul>
                        <li>{{date('Y-m-d',$d->art_time)}}</li>
                        <li><span>作者：</span>{{$d->art_editor}}</li>
                        <li><span>分类：</span><a>{{$field->cate_name}}</a></li>
                    </ul>
                </div>
            </div>
        @endforeach
        <div class="page-divide">
            {{$data->links()}}
        </div>
    </div>
@endsection