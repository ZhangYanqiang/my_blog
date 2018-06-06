<?php

namespace App\Http\Controllers\Api;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ArticleController extends CommonController
{
    // 获取文章详情
    public function getArt($art_id)
    {
        $art  = DB::table('blog_article')->where('art_id',$art_id)->get();
        $pre  = DB::table('blog_article')->where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        if($pre){
            $pre = $pre;
        }else{
            $pre = '';
        }
        $next  = DB::table('blog_article')->where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        if($next){
            $next = $next;
        }else{
            $next= '';
        }
        return response() -> json(['status'=> 1,'msg' => '查询成功','data'=> [$art,$pre,$next]]);
    }
    //按分类获取所有文章
    public function getAllarticle($cate_id)
    {
        $art  = DB::table('blog_article')->where('cate_id',$cate_id)->orderBy('art_view','desc')->get();
        return response() -> json(['status'=> 1,'msg' => '查询成功','data'=> $art]);
    }

}
