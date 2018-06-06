<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
    //get.admin/category 全部分类列表
    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        $field = DB::table('blog_category')->orderBy('cate_id','asc')->get();
        return response() -> json(['status'=> 1,'msg' => '查询成功','data'=> $field]);
       // return view('admin/category/index')->with('data',$category);
    }

}
