<?php
namespace Home\Controller;
use Think\Controller;
/**
 *
 */
class SetSelfController extends Controller
{

  public function set_username()
  {
    # code...

    $this->display();
  }
  public function set_phone(){
    $this->display();

  }
  public function set_email(){
    $this->display();
  }
  public function set_wechat(){
    $this->display();
  }
  public function set_pwd(){
    $this->display();
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
