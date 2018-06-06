<?php

namespace App\Http\Controllers\Api;

use App\Http\Model\Comment;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CommentController extends CommonController
{
    //get.admin/Comment   获取评论
    public function getComment($art_id)
    {
        $felid = DB::table('blog_comment')->where('article_id',$art_id)->get();
        //dd($felid);
        return response() -> json(['status' => 1, 'msg' => '查询成功', 'data'=> $felid]);
    }
    //接收新的评论
    public function postNewcomment()
    {
        $input  = Input::all();

       $re = Comment::create($input);
        if($re){
            return response() -> json(['status' => 1, 'msg' => '评论成功']);
        }else{
            return response() -> json(['status' => 0, 'msg' => '评论失败']);
        }
    }


}
