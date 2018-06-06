<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends CommonController
{

    public function index()
    {
        //图文列表5篇（带分页）
        $data = Article::orderBy('art_time','desc')->paginate(5);
        return view('home.index',compact('data'));
    }

    public function cate($cate_id)
    {

        //图文列表4篇（带分页）
        $data = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);
        //当前分类的子分类
        $submenu = Category::where('cate_pid',$cate_id)->get();
        $field = Category::find($cate_id);
        //查看次数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');
        return view('home.list',compact('field','data','submenu'));
        
    }

    public function article($art_id)
    {

        //查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
        $field = Article::where('art_id',$art_id)->first();
        //上一篇
        $article['pre'] = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        //下一篇
        $article['next'] = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        //相关文章，同类型
        $data = Article::where('cate_id',$field->cate_id)->orderBy('art_id','desc')->take(6)->get();

        return view('home.new',compact('field','article','data'));
        
    }
}
