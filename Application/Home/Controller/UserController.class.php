<?php
namespace Home\Controller;
use Think\Controller;

/**
 *
 */
class UserController extends Controller
{

  public function set_username()
  {
    if (IS_POST) {
      // $id = $_SESSION['id'];
      $User = D('User');
      $id = 2;
      if($User->create($_POST)){
        if($User->update_user($_POST,$id)){
          redirect('/w_resume/self',0,'页面跳转中。。。');
        }else{
          $res = $User->getError();
          $this->assign('notice',$res);
          $this->display();
        }
      }else{
        $res = $User->getError();
        $this->assign('notice',$res);
        $this->display();
      }
    }else{
      $this->display();
    }
  }

  public function set_phone()
  {
    if (IS_POST) {
      // $id = $_SESSION['id'];
      $User = D('User');
      $id = 2;
      if($User->create($_POST)){
        if($User->update_user($_POST,$id)){
          redirect('/w_resume/self',0,'页面跳转中。。。');
        }else{
          $res = $User->getError();
          $this->assign('notice',$res);
          $this->display();
        }
      }else{
        $res = $User->getError();
        $this->assign('notice',$res);
        $this->display();
      }
    }else{
      $this->display();
    }
  }

  public function set_email()
  {
    if (IS_POST) {
      // $id = $_SESSION['id'];
      $User = D('User');
      $id = 2;
      if($User->create($_POST)){
        if($User->update_user($_POST,$id)){
          redirect('/w_resume/self',0,'页面跳转中。。。');
        }else{
          $res = $User->getError();
          $this->assign('notice',$res);
          $this->display();
        }
      }else{
        $res = $User->getError();
        $this->assign('notice',$res);
        $this->display();
      }
    }else{
      $this->display();
    }
  }

  public function set_wechat()
  {
    if (IS_POST) {
      // $id = $_SESSION['id'];
      $User = D('User');
      $id = 2;
      if($User->create($_POST)){
        if($User->update_user($_POST,$id)){
          redirect('/w_resume/self',0,'页面跳转中。。。');
        }else{
          $res = $User->getError();
          $this->assign('notice',$res);
          $this->display();
        }
      }else{
        $res = $User->getError();
        $this->assign('notice',$res);
        $this->display();
      }
    }else{
      $this->display();
    }
  }

  public function set_pwd()
  {
    if (IS_POST) {
      // $id = $_SESSION['id'];
      $User = D('User');
      $id = 2;
      $User->id = $id;
      $_POST['password'] = md5($_POST['password']);
      $_POST['origin_password'] = md5($_POST['origin_password']);
      $_POST['repassword'] = md5($_POST['repassword']);
      if($User->create($_POST,4)){
        if($User->update_user($_POST,$id)){
          redirect('/w_resume/self',0,'页面跳转中。。。');
        }else{
          $res = $User->getError();
          $this->assign('notice',$res);
          $this->display();
        }
      }else{
        $res = $User->getError();
        $this->assign('notice',$res);
        $this->display();
      }
    }else{
      $this->display();
    }
  }

  public function verify()
  {
    $Verify = new \Think\Verify();
    $Verify->fontSize = 30;
    $Verify->length = 3;
    $Verify->useNoise = false;
    $Verify->entry();
  }
}

?>
