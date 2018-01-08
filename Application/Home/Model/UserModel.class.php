<?php

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
	
	 protected $_validate=array(
        array('username','require','用户名不得为空！',1,'regex',3), 
        array('password','require','密码不得为空！',1,'regex',1), 
        //array('username','','管理员名称不得重复！',1,'unique',3), 
        array('username','require','用户名不得为空！',1,'regex',4), 
        array('password','require','密码不得为空！',1,'regex',4),
        array('verify','check_verify','验证码错误！',1,'callback',4),  
		
		array('username','require','用户名不得为空！',1,'regex',5),
		array('username', '', '该用户名已被注册！', 0, 'unique', 5),
		array('phone','require','手机号不得为空！',1,'regex',5),
		array('email','require','邮箱不得为空！',1,'regex',5),
		array('email', '', '该邮箱已被占用', 0, 'unique', 5),
		array('password','require','密码不得为空！',1,'regex',5),
		array('password1','require','密码不得为空！',1,'regex',5),
		array('verify','check_verify','验证码错误！',1,'callback',5), 

        );
		
	 public function login(){
    	$password=$this->password;
    	$info=$this->where(array('username'=>$this->username))->find();
    	if($info){
    		if($info['password']==md5($password)){
    			session('id',$info['id']);
    			session('username',$info['username']);
    			return true;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }
	
	public function reg(){
		
		
		}
	
	function check_verify($code, $id = ''){
    	$verify = new \Think\Verify();
    	return $verify->check($code, $id);
    }
	
	}

?>