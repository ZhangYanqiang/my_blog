<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('resources/views/home/css/homeIndex.css')}}">
    <script type="text/javascript" src="{{asset('resources/views/home/js/homeIndex.js')}}"></script>
    <title>游侠张小可的博客</title>
</head>
<body>
    <div class="home-index-header">
    <div class="home-index-logo"><h1>游侠张小可</h1></div>
    <div class="home-index-nav">
        <ul>
            @foreach($navs as $k=>$v)
                <li><a href="{{$v->nav_url}}">{{$v->nav_name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
    <div id="main" class="home-index-main">
        @yield('content')
        <div class="home-nav">
            <div class="home-index-new">
                <p>最新文章</p>
                <ul>
                    @foreach($new as $n)
                        <li><a href="">{{$n->art_title}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="home-index-new">
                <p>点击排行</p>
                <ul>
                    @foreach($hot as $h)
                        <li><a href="">{{$h->art_title}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="home-index-links">
                <p>友情链接</p>
                <ul>
                    @foreach($links as $l)
                        <li><a href="{{$l->link_url}}">{{$l->link_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <div class="home-index-bottom">
        <div class="bottom-box">
            <p>Design by 游侠张小可</p>
            <a>Http://www.zhangxiaoke.com</a>
            <a>网站统计</a>
        </div>
    </div>
</body>
</html>
