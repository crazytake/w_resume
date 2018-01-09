<?php

 namespace Home\Controller;
 use Think\Controller;
  
  class RegController extends Controller{
	  public function reg(){
		 $this->display();
		 if(IS_POST){
			$user=D('User');
            if($user->create($_POST,5)){
                if($user->add()){
                    $this->success('注册成功，跳转中...',U('Login/login'));
                }else{
                    $this->error('注册失败，请重新注册！',U('reg'));
                }
            }else{
                $this->error($user->getError());
            }
            return;
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