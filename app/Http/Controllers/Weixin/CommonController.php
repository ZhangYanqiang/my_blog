<?php

namespace App\Http\Controllers\Weixin;

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
    /*public function api1()
    {
        $echoStr = $_GET['echostr'];
        if($this->checkSignature() && $echoStr){
            //第一次接入API
            echo $echoStr;
            exit;
        }


    }
    //检查签名
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = "zhangxiaoke";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            return true;

        }else{
            return false;
        }
    }*/
}
