<?php

namespace Back\Controller;

use Think\Controller;

class CategoryController extends Controller
{

    public function listAction()
    {

        $modelCategory = D('Category');

        $this->assign('list', $modelCategory->getTreeList());

        $this->display();
    }

    public function deleteAction()
    {

        $category_id = I('get.id', 0);
        if ($category_id == 0) {
            $this->redirect('list');
        }

        M('Category')->delete($category_id);
        // 初始缓存配置
        S([
            'type' => 'Memcache',
            'host'  => '192.168.118.128',
            'port'  => '11211',
        ]);
        // 删除
        S('category_tree', null);

        $this->redirect('list');
    }
}