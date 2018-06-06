@extends('layouts.home')
@section('content')
<div class="home-index-art">
    <div class="new-art">
        <h3>{{$field->art_title}}</h3>
        <ul>
            <li><span>发布时间：</span>{{date('Y-m-d',$field->art_time)}}</li>
            <li><span>编辑：</span>{{$field->art_editor}}</li>
            <li><span>查看次数：</span>{{$field->art_view}}</li>
        </ul>
        <p>{!! $field->art_content !!}</p>
        <div class="art-keywords">
            <dt>关键词:</dt><dd>{{$field->art_tag}}</dd>
        </div>
        <div class="art-next">
            <p>
                @if($article['pre'])
                    <a href="{{url('art/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a>
                @else
                    <span>没有上一篇了</span>
                @endif
            </p>
            <p>下一篇：
                @if($article['next'])
                    <a href="{{url('art/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a>
                @else
                    <span>没有下一篇了</span>
                @endif
            </p>
        </div>
        <div class="art-other">
            <h4>相关文章</h4>
            <ul>
                @foreach($data as $d)
                    <li><a href="{{url('art/'.$d->art_id)}}">{{$d->art_title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>


</div>
@endsection