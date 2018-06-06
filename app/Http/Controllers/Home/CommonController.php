<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Movies;
use App\Http\Model\Navs;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests;

class CommonController extends Controller
{
    public function __construct()
    {
        //点击量最高的6片文章
        $hot = Article::orderby('art_view','desc')->take(6)->get();

        //最新文章 8条
        $new = Article::orderby('art_time','desc')->take(8)->get();

        //友情链接
        $links = Links::orderBy('link_order','asc')->get();

        //把导航信息共享至所有页面
        $navs = Navs::all();

        //五部电影
        $movie = Movies::all();

        View::share('navs',$navs);
        View::share('hot',$hot);
        View::share('new',$new);
        View::share('links',$links);
        View::share('movie',$movie);

    }

}
