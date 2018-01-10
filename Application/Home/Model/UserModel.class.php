<?php
namespace Home\Model;
use Think\Model;

/**
 *
 */
class UserModel extends Model
{

  protected $_validate=array(
			array('verify','check_verify','验证码错误！',1,'callback',6),
			array('username','require','请填写昵称！'),
			array('username','','改昵称已被使用！',0,'unique',6),
			array('phone','/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','请输入正确的手机号码！'),
			array('email','email','请输入正确的邮箱地址！'),
			array('wechat_id','require','请输入为微信号！'),
			array('origin_password','check_pwd','原密码不正确！',1,'callback',6),
			array('repassword','password','两次输入的密码不一致！',0,'confirm'),

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

  public function update_user($data, $id){
    $info = $this->where('id='.$id)->setField($data);
    if($info){
      return true;
    }else{
      return false;
    }
  }

  function check_pwd($pwd) {
    $origin_pwd =  $this->where('id='.$this->id)->field('password')->select();
    if($pwd == $origin_pwd[0]['password']){
      return true;
    }else{
      return false;
    }
  }

  function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
  }

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

}


 ?>
