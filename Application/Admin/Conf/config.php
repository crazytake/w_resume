<?php
return array(
	'URL_ROUTER_ON'     => true,
	'TMPL_PARSE_STRING' => array('__PUBLIC__' => __ROOT__.'/Application/Admin/Public/'),
	'DB_TYPE'   => 'mysqli', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'w_resume', // 数据库名
	//'DB_USER'   => 'root', // 用户名
	//'DB_PWD'    => 'abcd1234', // 密码
	'DB_USER'   => 'w_resume', // 用户名
	'DB_PWD'    => 'zhee4#%dzK', // 密码	
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'kwg_', // 数据库表前缀
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	'URL_MODEL' => 1
)
?>
