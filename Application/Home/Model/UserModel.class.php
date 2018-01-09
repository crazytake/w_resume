<?php

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
	
	 protected $_validate=array(
		array('username','require','用户名不得为空！',1,'regex',5),
		array('username', '', '该用户名已被注册！', 0, 'unique', 5),
		array('username','/^[^@]{2,20}$/i','用户名长度过长',0,'regex',5),
		
		array('phone','require','手机号不得为空！',1,'regex',5),
		array('phone', '', '该手机号已被占用', 0, 'unique', 5),
		array('phone','/^(0|86|17951)?(13[0-9]|15[012356789]|18[0-9]|14[57])[0-9]{8}$/','手机号格式错误','regex',5),
		
		array('email','require','邮箱不得为空！',1,'regex',5),
		array('email', '', '该邮箱已被占用', 0, 'unique', 5),
		array('email','email','邮箱格式错误！',0,'regex',5),
		
		array('password','require','密码不得为空！',1,'regex',5),
		array('repassword','require','密码不得为空！',1,'regex',5),
		array('repassword','password','确认密码不正确',0,'confirm',5),
		array('verify','check_verify','验证码错误！',1,'callback',5), 
		
        array('username','require','用户名不得为空！',1,'regex',4), 
        array('password','require','密码不得为空！',1,'regex',4),
        array('verify','check_verify','验证码错误！',1,'callback',4), 
      );
		
	  protected $_auto = array ( 
         array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
      );	
	  	
	 public function login(){
    	$password=$this->password;
    	$info=$this->where(array('username'=>$this->username))->find();
    	if($info){
    		if($info['password']==$password){
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

	function check_verify($code, $id = ''){
    	$verify = new \Think\Verify();
    	return $verify->check($code, $id);
    }
}
?>