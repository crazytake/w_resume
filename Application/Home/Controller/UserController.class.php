<?php
namespace Home\Controller;
use Think\Controller;

/**
 *
 */
class UserController extends Controller
{

  /*登录*/
  public function login(){
    if(IS_POST){
      $user=D('User');
      if($user->create($_POST,4)){
        if($user->login()){
          $this->success('登录成功，跳转中...',U('Index/index'));
        }else{
          $this->error('您的用户名或者密码错误！');
        }
      }else{
        $this->error($user->getError());
      }

      return;
    }
    if(session('id')){
      $this->error('您已经登录该系统，请勿重复登录！',U('Index/index'));
    }else{
      $this->display('login');
    }
  }

  /* 退出登录 */
  public function logout(){
    if(session('username')){
      //D('Member')->logout();
      session('username',null);
      session('id',null);
      session('[destroy]');
      $this->success('退出成功！', U('Index/index'));
    } else {
      $this->redirect('/Index/index');
    }
  }

  /*注册*/
  public function reg(){
    $this->display();
    if(IS_POST){
      $user=D('User');
      if($user->create($_POST,5)){
        if($user->add()){
          $this->success('注册成功，跳转中...',U('User/login'));
        }else{
          $this->error('注册失败，请重新注册！',U('reg'));
        }
      }else{
        $this->error($user->getError());
      }
      return;
    }
  }

  public function set_avatar()
  {
    $userId = 2;
    $config = array(
        'maxSize' => 3145728,
        'rootPath' => './Application/Home/Uploads/',
        'savePath' => 'avatar/'.$userId . '/',
        'exts' => array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub' => false,
        'replace' => true,
        'saveName' => array('uniqid', ''),
    );
    $upload = new \Think\Upload($config);//实例化上传类

    $info = $upload->upload();
    if(!$info){
      $res['status'] = 0;
      $res['content'] = '上传失败！';
      $this->ajaxReturn($res);
    }else{
      $savePath = $info['avatar']['savepath'].$info['avatar']['savename'];
      $data['avatar'] = $savePath;
      $User = D('User');
      $User->create();
      $User->where('id=2')->save($data);
      $res['status'] = 1;
      $res['content'] = '上传成功！';
      $this->ajaxReturn($res);
    }
  }

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
      if($User->create($_POST,6)){
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
