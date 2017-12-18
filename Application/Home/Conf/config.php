<?php
return array(
  'URL_ROUTER_ON' => true,
  "URL_ROUTE_RULES" => array(
    'new/:year\d/:month\d'  => 'News/archive',
    'new/:id\d'    => 'News/read',
    'new/:name'    => 'News/read',
    'test'     => 'Index/test',
    'hello/:name' =>
        function($name){
            echo 'Hello,'.$name;
        }
  ),
  'URL_MAP_RULES' =>  array(
    'new/test' => 'News/test',
  )
)
?>
