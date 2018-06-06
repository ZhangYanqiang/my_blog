<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Weixin;

class WeixinController extends CommonController
{
    public function api()
    {

       ///获得参数 signature nonce token timestamp echostr
       /* $nonce     = $_GET['nonce'];
        $token     = 'zhangxiaoke';
        $timestamp = $_GET['timestamp'];
        $echostr   =  isset($_GET['echostr']) ? $_GET['echostr'] :' ';
        $signature = $_GET['signature'];
        //形成数组，然后按字典序排序
        $array = array($nonce, $timestamp, $token);
        sort($array);
        //拼接成字符串,sha1加密 ，然后与signature进行校验
        $str = sha1( implode( $array ) );

       if( $str  == $signature && $echostr ){
            //第一次接入weixin api接口的时候
            echo  $echostr;
            exit;
       }else{*/
            $weixin = new Weixin;
            $weixin->sendMsg();
           // $this->reponseMsg();
//       }
    }
    // 接收事件推送并回复
    public function reponseMsg()
    {
        //1.获取到微信推送过来post数据（xml格式）
        $postArr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        //2.处理消息类型，并设置回复类型和内容
        $postObj = simplexml_load_string($postArr);
        //判断该数据包是否是订阅的事件推送
        if (strtolower($postObj->MsgType) == 'event') {
            //如果是关注  subscribe 事件
            if (strtolower($postObj->Event) == 'subscribe') {
                $weixin = new Weixin;
                $weixin->subscribe($postObj);
            }
        }
      //用户发送图文关键字时，回复单图文消息
        if(strtolower($postObj->MsgType) == 'text' && trim($postObj->Content) == '图文'){
            $weixin = new Weixin;
            $weixin->responseMsg($postObj);
        }else{
            $weixin = new Weixin;
            $weixin->responseText($postObj);
        }
    }

    //网页授权方法
    public function getId()
    {
        $weixin = new Weixin;
        $weixin->getBaseInfo();
    }
    public function getInfo()
    {
        $weixin = new Weixin;
        $this->$weixin->getUserOpenId();
    }
}

