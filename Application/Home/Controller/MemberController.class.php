<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\MemberModel;

class MemberController extends Controller
{

    /**
     * 注册动作
     */
    public function registerAction()
    {
        if (IS_POST) {
            // 处理注册数据
            // 使用模型完成业务逻辑处理
            $model = D('Member');
            $result = $model->create($_POST, MemberModel::MODEL_REGISTER);// 使用create的第二个参数, 指定了当前的时机
            if($result) {
                // 插入到数据表
                $result = $model->add();
                $this->redirect('/login');// 重定向到登录
            } else {
                // 验证失败, 获取错误信息
                $this->error('注册失败: ' . $model->getError(), U('/register'));
            }

        } else {
            // 展示注册表单
            $this->display();
        }
    }

    /**
     * 登录动作
     */
    public function loginAction()
    {
        if (IS_POST) {
            // 业务逻辑处理
            $model_member = D('Member');
            // 一: 利用模型方法校验用户提交的数据是否合法
            // 合法返回当前的会员信息
            // 非法返回false
            if ($member = $model_member->checkMember(I('post.email', '', 'trim'), I('post.password','', 'trim'))) {
                // 会员合法
                // 二: session中的登录标志
                unset($member['password']);
                unset($member['password_salt']);
                session('member', $member);

                // 三: 更新登录日志(AR操作)
                $model_mll = M('MemberLoginLog');
                $model_mll->member_id = $member['member_id'];
                $model_mll->login_time = time();
                $model_mll->login_ip = get_client_ip(1);
                $model_mll->login_ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
                $model_mll->add();

                // 四: 重定向到会员中心
                $this->redirect('/center');
            } else {
                // 用户非法
                $this->error('用户信息非法', U('/login'));
            }
        } else {
            $this->display();
        }
    }


    public function centerAction()
    {
        echo '会员中心';
    }
}