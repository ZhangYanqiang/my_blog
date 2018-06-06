<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Doctrine\Common\Inflector\Inflector;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class CommonController extends Controller
{
    //图片上传
    public function upload(){
        $file = Input::file('Filedata');
        //判断文件是否有效
        if($file->isValid()){
            $realPath = $file -> getRealPath(); //临时文件的绝对路径
            $entension = $file -> getClientOriginalExtension();  //获取临时文件后缀

            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $path = $file -> move(base_path().'/uploads',$newName);  //移动文件并重命名
            $filepath = 'uploads/'.$newName;
            return $filepath;


        }


    }
}
