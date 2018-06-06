<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class IndexController extends CommonController
{
    public function pass()
    {
        if($input=Input::all()){
            //自定义的校验规则
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            $messages = [
                'password.required' => '新密码不能为空!',
                'password.between' => '新密码为6-20位之间!',
                'password.confirmed' => '新密码与确认密码不匹配!',
            ];
            $validator = Validator::make($input, $rules,$messages);
            if ($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if($input['password_o']==$_password){
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功!');
                }else{
                    return back()->with('errors','原密码错误！');
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }
}
