create database buyplus4 charset=utf8;

use buyplus4;
-- 会员表
create table kang_member
(
    member_id int unsigned auto_increment,  -- 主键
    email varchar(255) null default '', -- 邮箱
    telephone varchar(16) null default '', -- 电话
    password char(40) not null default '', -- 密码
    password_salt char(8) not null default '', -- 密码盐值
    nickname varchar(32) not null default '', -- 显示昵称
    gender enum('Male', 'Female', 'Secret') not null default 'Secret',
    newsletter tinyint not null default 0, -- 是否使用email订阅
    register_time int not null default 0, -- 注册时间
    primary key (member_id),
    index (email),
    index (telephone)
) charset=utf8;

-- 会员登录日志
create table kang_member_login_log
(
    member_login_log_id int unsigned auto_increment,
    member_id int unsigned not null default 0, -- 关联字段
    login_time int not null default 0, -- 时间
    login_ip int unsigned not null default 0, -- IP
    login_ua varchar(255) not null default '', -- user-agent
    primary key (member_login_log_id),
    index (member_id)
) charset=utf8;


-- 活动表
create table kang_event
(
    event_id int unsigned auto_increment,
    title varchar(128) not null default '',
    -- begin_time
    -- end_time
    primary key (event_id)
) charset=utf8;

-- 会员活动关联
create table kang_member_event
(
    member_event_id int unsigned auto_increment,
    member_id int unsigned not null default 0,
    event_id int unsigned not null default 0,
    primary key (member_event_id)
) charset=utf8;


-- 商品分类表
drop table if exists kang_category;
create table kang_category (
    category_id int unsigned auto_increment,
    title varchar(32) not null default '',
    parent_id int unsigned not null default 0,
    sort_number int not null default 0,

    image varchar(255) not null default '', -- 分类图片
    image_thumb varchar(255) not null default '', -- 分类图片缩略图
    -- 前台展示
    is_used boolean not null default 1, -- tinyint(1)
    is_nav tinyint not null default 1, -- 针对顶级分类
    -- SEO优化
    meta_title varchar(255) not null default '',
    meta_keywords varchar(255) not null default '',
    meta_description varchar(1024) not null default '',
    primary key (category_id),
    index (parent_id),
    index (sort_number)
) charset=utf8;

insert into kang_category values (1, '未分类', 0, -1, '', '', 0, 0, '', '', '');
insert into kang_category values (5, '眼镜', 0, 0, '', '', 1, 1, '', '', '');
insert into kang_category values (6, '男士眼镜', 5, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (7, '女士眼镜', 5, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (8, '飞行员眼镜', 5, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (9, '驾驶镜', 5, 0,'', '',  1, 0, '', '', '');
insert into kang_category values (10, '太阳镜', 5, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (11, '图书', 0, 0, '', '', 1, 1, '', '', '');
insert into kang_category values (12, '历史', 11, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (14, '科技', 11, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (15, '计算机', 11, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (16, '电子书', 11, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (17, '科普', 14, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (18, '建筑', 14, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (19, '工业技术', 14, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (20, '电子通信', 14, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (21, '自然科学', 14, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (22, '互联网', 15, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (23, '计算机编程', 15, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (24, '硬件，攒机', 15, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (25, '大数据', 15, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (26, '移动开发', 15, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (27, 'PHP', 15, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (28, '近代史', 12, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (29, '当代史', 12, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (30, '古代史', 12, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (31, '先秦百家', 12, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (32, '三皇五帝', 12, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (33, '励志', 16, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (34, '小说', 16, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (35, '成功学', 16, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (36, '经济金融', 16, 0, '', '', 1, 0, '', '', '');
insert into kang_category values (37, '免费', 16, 0, '', '', 1, 0, '', '', '');


-- brand 品牌表
create table kang_brand
(
  brand_id int UNSIGNED AUTO_INCREMENT,
  title varchar(32) not null default '',
  logo varchar(255) not null default '',
  site varchar(255) not null default '', -- 官网地址
  sort_number int not null default 0,
  created_at int not null default 0, -- 创建时间
  updated_at int not null default 0, -- 更新时间
  primary key (brand_id),
  -- 添加一个约束, 使用constraint
  CONSTRAINT `onlyOneTitle` unique key `oneTitle` (title),
  index (sort_number)
) CHARSET=utf8;


-- drop table if exists kang_goods;
-- create table kang_goods
-- (
--   goods_id int UNSIGNED AUTO_INCREMENT,
--   brand_id int UNSIGNED,
--   primary key (goods_id),
--   CONSTRAINT `aaaa` FOREIGN KEY `brandIndex` (brand_id) REFERENCES kang_brand (brand_id)
--   -- FOREIGN KEY (brand_id) REFERENCES kang_brand (brand_id)
-- ) CHARSET=utf8;