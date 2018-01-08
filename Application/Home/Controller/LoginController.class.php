<?php
  
  namespace Home\Controller;
  use Think\Controller;
  
  class LoginController extends Controller{
	
		  
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
            $this->success('退出成功！', U('/Index/index'));
        } else {
            $this->redirect('/Index/index');
        }
    }
		  
	  public function verify(){
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length   = 3;
        $Verify->useNoise = false;
        $Verify->entry();
        }  
 }
 
?>