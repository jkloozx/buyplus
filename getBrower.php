<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/15 0015
 * Time: 10:33
 */
const ALIPAY = 1;
const WXPAY = 2;
function get_user_browser() {
//    if (empty($_SERVER['HTTP_USER_AGENT']))
//    {
//        return '';
//    }
//
    $agent = $_SERVER['HTTP_USER_AGENT'];
//    $browser     = '';
//    $browser_ver = '';
//
//    if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs))
//    {
//        $browser     = 'Internet Explorer';
//        $browser_ver = $regs[1];
//    }
//    elseif (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs))
//    {
//        $browser     = 'FireFox';
//        $browser_ver = $regs[1];
//    }
//    elseif (preg_match('/Maxthon/i', $agent, $regs))
//    {
//        $browser     = '(Internet Explorer ' .$browser_ver. ') Maxthon';
//        $browser_ver = '';
//    }
//    elseif (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs))
//    {
//        $browser     = 'Opera';
//        $browser_ver = $regs[1];
//    }
//    elseif (preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $regs))
//    {
//        $browser     = 'OmniWeb';
//        $browser_ver = $regs[2];
//    }
//    elseif (preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $regs))
//    {
//        $browser     = 'Netscape';
//        $browser_ver = $regs[2];
//    }
//    elseif (preg_match('/safari\/([^\s]+)/i', $agent, $regs))
//    {
//        $browser     = 'Safari';
//        $browser_ver = $regs[1];
//    }
//    elseif (preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $regs))
//    {
//        $browser     = '(Internet Explorer ' .$browser_ver. ') NetCaptor';
//        $browser_ver = $regs[1];
//    }
//    elseif (preg_match('/Lynx\/([^\s]+)/i', $agent, $regs))
//    {
//        $browser     = 'Lynx';
//        $browser_ver = $regs[1];
//    }
//    if (!empty($browser))
//    {
//        return addslashes($browser . ' ' . $browser_ver);
//    }
//    else
//    {
//        return 'Unknow browser';
//    }
    $str1 = 'Mozilla/5.0 (Linux; U; Android 5.0.2; zh-cn; Redmi Note 2 Build/LRX22G) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/1.0.0.100 U3/0.8.0 Mobile Safari/534.30 Nebula AlipayDefined(nt:4G,ws:360|640|3.0) AliApp(AP/10.0.2.012305) AlipayClient/10.0.2.012305 Language/zh-Hans useStatusBar/true';
    $str2 = 'Mozilla/5.0 (Linux; Android 5.0.2; Redmi Note 2 Build/LRX22G; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/53.0.2785.49 Mobile MQQBrowser/6.2 TBS/043024 Safari/537.36 MicroMessenger/6.5.4.1000 NetType/4G Language/zh_CN';
    if (strpos($agent,'AlipayClient')){
        $brower = ALIPAY;
    }
    if (strpos($agent,'MicroMessenger')){
        $brower = WXPAY;
    }
    return $brower;
}
$brower = get_user_browser();
if ($brower == WXPAY){
    echo '微信浏览器';
}
if ($brower == ALIPAY){
    echo '支付宝浏览器';
}
