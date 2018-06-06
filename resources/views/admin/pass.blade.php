@extends('layouts.admin')
@section('content')
    {{--导航--}}
    <div class="info-body">
        <div class="info-nav-top">
            <a href="{{url('admin/index')}}" target="main">首页</a>&raquo;修改密码
        </div>
        <div class="pass-result-table">
            <div class="error-msg">
                @if(count($errors)>0)
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                @endif
            </div>
            <form method="post" action="">
                {{csrf_field()}}
                <table class="pass-add-tab">
                    <tbody>
                    <tr>
                        <th><i class="require">*</i>原密码：</th>
                        <td>
                            <input type="password" name="password_o"><span>请输入原始密码</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>新密码：</th>
                        <td>
                            <input type="password" name="password"><span>新密码6-20位</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>确认密码：</th>
                        <td>
                            <input type="password" name="password_confirmation"><span>请再次输入新密码</span>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <button type="submit" class="button">提交</button>
                            <button type="button" class="button" onclick="history.go(-1)">返回</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection