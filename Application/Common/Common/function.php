<?php

   function getpage($count, $pagesize = 10){
	    $Page = new \Think\Page($count,$pagesize);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('header', '共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页'); 
		$Page -> setConfig('first','首页');
		$Page -> setConfig('last','末页');
		$Page -> setConfig('prev','上一页');
		$Page -> setConfig('next','下一页');
		$Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
		$Page -> setConfig('theme','%FIRST%  %UP_PAGE%  %LINK_PAGE%  %DOWN_PAGE%  %END%  %HEADER% ');
		$Page->lastSuffix = false;
		return $Page;
	   }

?>