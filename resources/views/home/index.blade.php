@extends('layouts.home')
@section('content')
    <div class="home-index-hot">
        <div class="slideshow-container">
            @foreach($movie as $m)
                <div class="mySlides fade">
                    <img src="{{$m->movie_url}}">
                    <div class="text">{{$m->movie_name}}</div>
                    <div class="text-description">
                        <p>{{$m->movie_des}}</p>
                    </div>
                </div>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)"><</a>
            <a class="next" onclick="plusSlides(1)">></a>
        </div>
        <br>
        <div style="text-align: center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
        </div>
        <script src="{{url('resources/views/home/js/homeIndex.js')}}" type="text/javascript"></script>
    </div>
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
                    </ul>
                </div>
            </div>
        @endforeach
        <div class="page-divide">
            {{$data->links()}}
        </div>
    </div>
@endsection