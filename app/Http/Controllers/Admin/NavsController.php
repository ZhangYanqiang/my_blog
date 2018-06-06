<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //get.admin/Navs   全部导航列表
    public function index()
    {
        $data=Navs::orderBy('nav_order','asc')->get();
       return view('admin.navs.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '导航排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '导航排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }
    //get.admin/Navs/creat  添加导航
    public function create()
    {
        return view('admin/navs/add');
    }

    //post.admin/Navs 添加导航提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $message = [
            'nav_name.required' => '导航名称不能为空!',
            'nav_rul.required' => '导航URL不能为空!',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Navs::create($input);
            if($re){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/Navs/{Navs}/edit 编辑导航
    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        $data = Navs::where('nav_id')->get();
        return view('admin.navs.edit',compact('field','data'));
    }

    //put.admin/Navs/{Navs}  更新导航
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $re = Navs::where('nav_id',$nav_id)->update($input);
        if($re){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','导航更新失败，请稍后重试！');
        }
    }

    //delete.admin/Navs/{Navs}  删除导航
    public function destroy($nav_id)
    {

        $re = Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '导航删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '导航删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    public function show()
    {

    }
}
