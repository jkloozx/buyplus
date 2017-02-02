<?php


namespace Back\Controller;

use Think\Controller;
use Think\Page;

class BrandController extends Controller
{

    public function addAction()
    {
        if (IS_POST) {

            $model = D('Brand');
            if ($model->create()) {// 校验
                $model->add();// 添加
                $this->redirect('list');// 重定向到列表动作
            } else {
                // 将错误信息存储到session中, 便于下个页面输出错误消息
                session('message', ['error'=>1, 'errorInfo'=>$model->getError()]);
                session('data', $_POST);
                $this->redirect('add'); // 重定向到添加
            }
        } else {
//            获取到, 分配到模板, 删除, 做一个一次性的session会话数据
            $this->assign('message', session('message'));
            session('message', null);// 删除该信息
            $this->assign('data', session('data'));
            session('data', null);

            $this->display();
        }
    }

    public function listAction()
    {

        $model = M('Brand');

        // 查询条件
        $cond = [];// 初始化查询条件
        $fitler = []; // 初始化一个用于记录查询查询的数组, 分配到视图模板中
        if(null !== $title=I('get.filter_title', null, 'trim')) {
            // 在请求数据中存在filter_title, 需要设置条件
            $cond['title'] = ['like', $title . '%'];
            $filter['filter_title'] = $title;
        }
        // 继续判断其他的字段, 入$cond和$filter数组即可
        // 所有检索结束, 分配搜索条件
        $this->assign('filter', $filter);

        // 考虑分页
        $pagesize = 1;// 每页记录数
        // 计算总页数
        $total = $model->where($cond)->count();// 所有符合条件的记录数
        $totalPage = ceil($total/$pagesize);// 计算总页数
        $p = C('VAR_PAGE') ? C('VAR_PAGE') : 'p';// 当前的翻页参数
        $page = I('get.'.$p, '1', 'intval');
        // 考虑是否越界
        if ($page < 1) {// 小于第一页
            $page = 1;
        }
        if ($page > $totalPage) { // 考虑大于总页数
            $page = $totalPage;
        }
        // 为模型设置分页操作, 页码和每页记录数作为参数
        $model->page("$page, $pagesize");

        // 形成翻页操作接口
        $toolPage = new Page($total, $pagesize);
        // 定制样式结构
        $toolPage->setConfig('header', '显示开始 %FIRST_NUM% 到 %LAST_NUM% 之 %TOTAL_ROW% （总 %TOTAL_PAGE% 页）');
        $toolPage->setConfig('prev', '&lt;');
        $toolPage->setConfig('next', '&gt;');
        $toolPage->setConfig('first', '|&lt;');
        $toolPage->setConfig('last', '&gt;|');
        $toolPage->setConfig('theme', '<div class="col-sm-6 text-left"><ul class="pagination">%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%</ul></div><div class="col-sm-6 text-right">%HEADER%</div>');
        $this->assign('pageHtml', $toolPage->show());


        // 执行查询
        $list = $model->where($cond)->select();
        $this->assign('list', $list);

        $this->display();
    }

    /**
     * 专门处理ajax请求的动作
     */
    public function ajaxAction()
    {
        $operate = I('request.operate', null);
        if (is_null($operate)) {
            $this->ajaxReturn(['error'=>1, 'errorInfo'=>'没有确定的操作']);
        }

        switch ($operate) {
            case 'titleUnique':
                $model = M('Brand');
                if ($model->getByTitle(I('request.title', ''))) {
                    echo 'false';
                } else {
                    echo 'true';
                }
                break;
        }

    }
} 