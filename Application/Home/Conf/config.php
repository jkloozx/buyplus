<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_CONTROLLER'    => 'Shop',
    'DEFAULT_ACTION'    => 'index',

    'TMPL_ACTION_ERROR'     =>  'Common/error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  'Common/success', // 默认成功跳转对应的模板文件
    //
    'URL_ROUTER_ON' => true, // 开启自定义路由
    'URL_ROUTE_RULES'   => [ // 自定义路由规则

        'register'  => 'Member/register', // 路由到用户的注册动作
        'login'     => 'Member/login',// 登录
        'center'    => 'Member/center'
    ],
    'URL_MODEL' => 2, // URL模式

    'TMPL_PARSE_STRING' => [
        
    ],
);