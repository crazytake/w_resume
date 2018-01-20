<?php
/**
 * Created by PhpStorm.
 * User: Kel
 * Date: 2018/1/10
 * Time: 22:58
 */
 namespace Admin\Controller;
 use Think\Controller;

 class TemplateController extends CommonController{
   public function lst(){
     $this->display();
   }
   public function add(){
     if(IS_POST){
       $tplId = 1;
       $config = array(
         'maxSize' => 8145728,
         'rootPath' => './Uploads/',
         'savePath' => 'tpl/' . $tplId . '/',
         'exts' => array('jpg', 'gif', 'png', 'jpeg', 'html'),
         'autoSub' => false,
         'replace' => true,
         'saveName' => array('uniqid', ''),
       );
       $upload = new \Think\Upload($config);
       $info = $upload->upload();
       if(!$info) {// 上传错误提示错误信息
         $this->error($upload->getError());
       }else{// 上传成功
         $data['template_name'] = $_POST['template_name'];
         $data['template_tag'] = $_POST['template_tag'];
         $data['template_author'] = $_POST['template_author'];
         $data['template_introduce'] = $_POST['template_introduce'];
         $data['template_img'] = $info['template_img']['savepath'] . $info['template_img']['savename'];
         $data['template_html'] = $info['template_html']['savepath'] . $info['template_html']['savename'];
         $data['add_time'] = time();
         $tpl = M('Template');
         $tpl->data($data)->add();
         $this->success('上传成功！');
         
         // if($tpl->create($data)){
         //   $result = $tpl->add($data);
         // } else{
         //   $this->error($upload->getError());
         // }
       }
     }else{
       $this->display();
     }
   }
 }

 ?>
