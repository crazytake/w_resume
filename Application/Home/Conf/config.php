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
  )
)
?>
