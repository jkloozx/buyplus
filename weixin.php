<?php
/*
    方倍工作室 http://www.cnblogs.com/txw1958/
    CopyRight 2013 www.fangbei.org  All Rights Reserved
*/
header('Content-type:text');
define("TOKEN", "jkloozx");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
} else {
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest {
    public function valid() {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            header('content-type:text');
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature() {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function responseMsg() {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
//            if ($keyword == "?" || $keyword == "？") {
//                $msgType = "text";
//                $contentStr = date("Y-m-d H:i:s", time());
//                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//                echo $resultStr;
//            }
            switch ($keyword){
                case '？':
                case '?':
                    $msgType = "text";
                    $contentStr = date("Y-m-d H:i:s", time());
                    break;
                case '你好啊':
                    $msgType = "text";
                    $contentStr = '你也好啊，哈哈哈哈~';
                    break;
                case 'jkloozx':
                    $msgType = "text";
                    $contentStr = 'how do you know that?who are you?';
                    break;
                case '今天天气不错嘛~':
                    $msgType = "text";
                    $contentStr = '是啊是啊，是晴天呢~';
                    break;
                case '姓名':
                    $msgType = "text";
                    $contentStr = 'jkloozx';
                    break;
                 case '性别':
                    $msgType = "text";
                    $contentStr = '男';
                    break;
                 case '年龄':
                    $msgType = "text";
                    $contentStr = '23';
                    break;
                 case '体重':
                    $msgType = "text";
                    $contentStr = '70kg';
                    break;
                 case '身高':
                    $msgType = "text";
                    $contentStr = '185cm';
                    break;
                default:
                    $msgType = "text";
                    $contentStr = '你说什么，我没有听清楚~';
            }
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        } else {
            echo "";
            exit;
        }
    }
}