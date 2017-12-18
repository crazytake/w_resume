<?php
return array(
  'URL_ROUTER_ON' => true,
  "URL_ROUTE_RULES" => array(
    'new/:id\d'    => 'News/read',
    'new/:name'    => 'News/read',
    'new/:year\d/:month\d'  => 'News/archive',

  ),
  'URL_MAP_RULES' =>  array(

  )
)
?>
