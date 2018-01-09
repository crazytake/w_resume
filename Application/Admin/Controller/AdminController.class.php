<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function lst(){
		$this->display();
    }
	public function aaa(){
		$this->show("test");
	}

}
