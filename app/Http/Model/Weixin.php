<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Weixin extends Model
{

    //图文消息回复
    public function responseMsg($postObj)
    {
        $toUser = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
        $time = time();
        //图文个数不能超过10个
        $arr = array(
            array(
                'title'=>'php',
                'description'=>"php是世界上最好的语言",
                'picUrl'=>'/var/www/my_blog/uploads/mr.jpg',
                'url'=>'http://193.112.244.24',
            ),
            array(
                'title'=>'前端',
                'description'=>"php是世界上最好的语言",
                'picUrl'=>"https://www.baidu.com/index.php?tn=monline_3_dg",
                'url'=>'http://193.112.244.24',
            ),
            array(
                'title'=>'读书笔记',
                'description'=>"php是世界上最好的语言",
                'picUrl'=>'/var/www/my_blog/uploads/mr.jpg',
                'url'=>'http://193.112.244.24',
            ),

        );
        $template =  "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>".count($arr)."</ArticleCount>
                            <Articles>";
        foreach($arr as $k=>$v){
            $template .= "<item>
                                      <Title><![CDATA[".$v['title']."]]></Title> 
                                      <Description><![CDATA[".$v['description']."]]></Description>
                                      <PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
                                      <Url><![CDATA[".$v['url']."]]></Url>
                                   </item>";
        }
        $template .= " </Articles>
                           </xml>";
        echo sprintf($template, $toUser, $fromUser, $time, 'news');
    }

    //订阅事件回复
    public function subscribe($postObj)
    {
        //回复用户消息(纯文本格式)
        $toUser = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;
        $time = time();
        $msgType = 'text';
        $content = '你好，欢迎关注我的微信公众账号，希望你有所收获';
        $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
        $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
        echo $info;
    }

    //纯文本回复
    public function responseText($postObj)
    {
        //纯文本内容回复
        switch(trim($postObj->Content)){
           case '你好':
                $content = '感谢关注，查看博文请回复 PHP、前端、读书笔记、关于我';
                break;
            case 'php':
                $content = "<a href='http://193.112.224.24/cate/1'>学习PHP踩过的坑</a>";
                break;
            case '前端':
                $content = '学习前端过程中的一些笔记，经验分享';
                break;
            case '读书笔记':
                $content = '看过的一些乱七八糟的书';
                break;
            case '关于你':
                $content = '我是张小可，写bug的';
                break;
            default:
                $content = '请回复 PHP、前端、读书笔记、关于我，获取更多信息';
                break;
        }
        $template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
        //
        $fromUser = $postObj->ToUserName;
        $toUser = $postObj->FromUserName;
        $time = time();
        $msgType = 'text';
        //$content = '感谢关注，查看博文请回复 PHP、前端、读书笔记、关于我';
        echo sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
    }

    //获取微信服务器IP
    public function getWxServerIp()
    {
        $accessToken = '10_ylCufFPKQdQLg-VUwNJHXPjFr5ZoQOMvdcmdxSXZuIy3WKIXpppNuGhivfoTWDTT35GFM8pGG1Z6B2QvaVf-9alw6XjAMzdJ50MQiPa-YAPwkWNsyMeDDPTal3FkFtPENp3VgaDCWbh054yyVFQfAIAQAL';
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$accessToken;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $res = json_decode(curl_exec($ch));
        if(curl_errno($ch)){
            var_dump( curl_error($ch));
        }
        var_dump( $res );
        curl_close($ch);

    }

    //返回access_token
    public function getAccessToken()
    {
        //var_dump($_SESSION);
        //将access_token存储到session/cookie中
        if(isset($_SESSION['access_token']) && isset($_SESSION['expire_time'])>time()){
            return $_SESSION['access_token'];
        }else{
            $appid = 'wx3e7f7d1d677d3cfb';
            $appsecret = '1c4418fcd8ed80ce27f1045e53f26132';
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
            $res = $this->http_curl($url,'get','json');
            $access_token = $res['access_token'];
            //var_dump($access_token);
            //access_token存储到session中
            $_SESSION['access_token'] = $access_token;
            $_SESSION['expire_time'] = time()+7000;
            //var_dump($_SESSION);
            return $access_token;
        }

    }


    /*
     * $url 接口url string
     * $type 请求类型 String
     * $res 返回类型
     * $arr post请求参数，string
     */
    public function http_curl($url,$type='get',$res='json',$arr='')
    {
        //初始化
        $ch = curl_init();
        //设置参数
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($type == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        }
        $output = curl_exec($ch);
        if ($res == 'json') {
            if (curl_errno($ch)) {
                //请求失败。返回错误码
                return curl_error($ch);
            }else{
                //请求成功
                return json_decode($output, true);
            }
        }
        curl_close($ch);
    }

    //创建自定义菜单
    public function defineItem()
    {
        //创建微信菜单
        //接口调用通过curl get/post
        header('content-type:text/html;charset=utf-8');
        $access_token = $this->getAccessToken();
        //Log::info($access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $postArr = array(
            'button'=>array(
                array(
                    'type'=>'click',
                    'name'=>urlencode('博文'),
                    'key'=>'item1'
                ),  //第一个一级菜单
                array(
                    'type'=>'click',
                    'name'=>urlencode('小游戏'),
                    'sub_button'=>array(
                        array(
                            'name'=>'php',
                            'url'=>'http://193.112.224.24',
                            'type'=>'click',
                        ),//二级菜单
                        array(
                            'type'=>'view',
                            'name'=>urlencode('前端'),
                            'url'=>'http://193.112.224.24'
                        ),
                        array(
                            'type'=>'click',
                            'name'=>urlencode('读书笔记'),
                            'url'=>'http://193.112.224.24',
                        ),
                    ),
                    'key'=>'item2'
                ),  //第二个一级菜单
                array(
                    'type'=>'click',
                    'name'=>urlencode('关于我'),
                    'key'=>'item3'
                ),  //第三个一级及菜单
            )
        );
        $postJson = urldecode(json_encode($postArr));
        //var_dump($postJson);
        $res = $this->http_curl($url,'post','json',$postJson);
        //var_dump($res);
    }

    //群发消息
    public function sendMsg()
    {
        //获取access_token
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=".$access_token;
        //组装数据array
        $array = array(
            'touser'=>'oo5_T0wRLoT0NiQObxi5KZ_3MKvs',//微信用户的openID
            'text'=>array('content'=>urlencode('学习公众号开发')),//文本内容
            'msgtype'=>'text',//消息类型
        );
        //array->json
        $postJson = urldecode(json_encode($array));
        //var_dump($postJson);
        //curl请求接口  https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=ACCESS_TOKEN
        $res = $this->http_curl($url,'post','json',$postJson);
        //var_dump($res);
    }

    //获取用户openID
    public function getBaseInfo()
    {
        //获取code
        //Log::info('ok');
        $appid = 'wx3e7f7d1d677d3cfb';
        $redirect_uri = urlencode("http://193.112.224.24/weixin/getinfo");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=123&connect_redirect=1#wechat_redirect";
        header("Location:".$url);
        //Log::info('okk');
    }

    public function getUserOpenId()
    {
        //Log::info('ok1');
        //var_dump("xxxxx");
        //获取到网页授权的access_token
        $appid = 'wx3e7f7d1d677d3cfb';
        $appsecret = '1c4418fcd8ed80ce27f1045e53f26132';
        $code = $_GET['code'];
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."code=".$code."&grant_type=authorization_code";
        //Log::info('2');
        //获取用户openID
        $res = $this->http_curl($url,'get');
       // Log::info($res);
        var_dump($res);
        var_dump("xxxxx");
    }


}
