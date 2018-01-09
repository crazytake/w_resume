<?php
return array(
  'URL_ROUTER_ON' => true,
  "URL_ROUTE_RULES" => array(
    'new/:year\d/:month\d'  => 'News/archive',
    'new/:id\d'    => 'News/read',
    'new/:name'    => 'News/read',
    'createresume' => 'EditResume/create_resume',
    'self'=>'Index/self_center',
    'set/username'=>'User/set_username',
    'set/phone'=>'User/set_phone',
    'set/email'=>'User/set_email',
    'set/wechat'=>'User/set_wechat',
    'set/pwd'=>'User/set_pwd',
//    'update/username'=>array('User/set_username','',array('method'=>'post')),
  ),
  'URL_MAP_RULES' =>  array(
    'new/test' => 'News/test',
  ),
  'TMPL_PARSE_STRING' => array(
    '__CSS__' => __ROOT__.'/Application/Home/Public/css',
    '__JS__'  => __ROOT__.'/Application/Home/Public/js',
    '__IMG__' => __ROOT__.'/Application/Home/Public/img',
    '__COMMON__'  => __ROOT__.'/Application/Home/Public/common',
    '__PUBLIC__'  => __ROOT__.'/Application/Home/Public/',
    '__UPLOAD__'  => __ROOT__.'/Application/Home/Uploads'
  ),
  
  
  'URL_ROUTER_ON'     => true,
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'w_resume', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'abcd1234', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'kwg_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	'URL_MODEL' => 1
)
?>
