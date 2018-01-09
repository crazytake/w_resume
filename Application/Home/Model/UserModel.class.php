<?php
namespace Home\Model;
use Think\Model;

/**
 *
 */
class UserModel extends Model
{

  protected $_validate=array(
    array('verify','check_verify','验证码错误！',1,'callback',4),
    array('username','require','请填写昵称！'),
    array('username','','改昵称已被使用！',0,'unique',3),
    array('phone','/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/','请输入正确的手机号码！'),
    array('email','email','请输入正确的邮箱地址！'),
    array('wechat_id','require','请输入为微信号！'),
    array('origin_password','check_pwd','原密码不正确！',1,'callback',4),
    array('repassword','password','两次输入的密码不一致！',0,'confirm')
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

}


 ?>
