<?php
return array(
  'URL_ROUTER_ON' => true,
  "URL_ROUTE_RULES" => array(
    'new/:year\d/:month\d'  => 'News/archive',
    'new/:id\d'    => 'News/read',
    'new/:name'    => 'News/read',
    // 'editresume'   => 'EditResume/EditResume',
    'createresume' => 'EditResume/create_resume',
    // 'uploadImg'    => array('EditResume/UploadImg','', array('method' => 'POST')),
    // array('uploadImg', 'EditResume/UploadImg', '', array('method' => 'POST')),
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
    '__UPLOAD__'  => __ROOT__.'/Application/Home/Upload'
  )
)
?>
