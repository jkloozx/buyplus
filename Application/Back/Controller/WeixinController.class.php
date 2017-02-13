<?php

namespace Back\Controller;

use Think\Controller;

class WeixinController extends Controller {



    public function replyAction() {
//        $options = array(
//            'token'=>'jkloozx', //填写你设定的key
//            'encodingaeskey'=>'Bgmr5zO13SkH0zy8QpHQfuJoAgStUAzORusqUzuempp', //填写加密用的EncodingAESKey
//            'appid'=>'wx9312e7bdbaa7b825', //填写高级调用功能的app id, 请在微信开发模式后台查询
//            'appsecret'=>'6028a7cbd83a463528148571f4700afd' //填写高级调用功能的密钥
//        );
//        $wx = new \Org\Wechat\Wechat($options);
//        $model_reply = M('wx_reply');
//
//        $wx->valid();
//        $type = $wx->getRev()->getRevType();
//        switch($type) {
//            case Wechat::MSGTYPE_TEXT:
//                $key = $wx->getRev()->getRevContent();
//                if ($content = $model_reply -> getByReply_key($key)){
////                    $wx->text($content)->reply();
//                    $wx->text("hello world")->reply();
//                }else{
//                    $wx->text('你说什么，我听不清楚~')->reply();
//                }
//                exit;
//                break;
//            case Wechat::MSGTYPE_EVENT:
//                break;
//            case Wechat::MSGTYPE_IMAGE:
//                break;
//            default:
//                $wx->text("help info")->reply();
//        }

        $options = array(
            'token' => 'jkloozx', //填写你设定的key
//            'encodingaeskey'=>'encodingaeskey' //填写加密用的EncodingAESKey，如接口为明文模式可忽略
        );
        $weObj = new \Org\Wechat\Wechat($options);
        $weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
        $type = $weObj->getRev()->getRevType();
        switch ($type) {
            case Wechat::MSGTYPE_TEXT:
                $weObj->text("hello, I'm wechat")->reply();
                exit;
                break;
            case Wechat::MSGTYPE_EVENT:
                break;
            case Wechat::MSGTYPE_IMAGE:
                break;
            default:
                $weObj->text("help info")->reply();
        }


    }

}