<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function lst(){
		$admin=D("AdminUserView");
		$adminList=$admin->select();
		$this->assign("adminList",$adminList);
		$this->display();
    }
	public function aaa(){
		$this->show("test");
	}

}
