<?php

namespace Back\Model;

use Think\Model;


class CategoryModel extends Model
{

    public function getTreeList()
    {
        // 初始缓存配置
        S([
            'type' => 'Memcache',
            'host'  => '192.168.118.128',
            'port'  => '11211',
        ]);


        G('start');
        if(! $tree = S('category_tree')) {
            // 缓存不存在
            // 获取所有的分类
            $list = $this->order('sort_number')->select();
            // 递归处理
            $tree = $this->tree($list);

            // 增加设置缓存
            S('category_tree', $tree);// 默认永久有效 
        }
        echo G('start', 'end'), 's';

        return $tree;
    }

    protected function tree($list, $category_id=0, $level=0)
    {
        static $tree = [];
        foreach($list as $row) {
            if ($row['parent_id'] == $category_id) {
                $row['level'] = $level;
                $tree[] = $row;
                $this->tree($list, $row['category_id'], $level+1);
            }
        }
        return $tree;
    }
}