<?php

/**
 * Created by PhpStorm.
 * User: Kel
 * Date: 2018/1/4
 * Time: 12:55
 */
namespace Home\Model;
use Think\Model;
class ResumeModel extends Model {
    protected $fields = array('id', 'user_id', 'template_id', 'resume_content','head_path','base_info','intension','education','work_history','project_history','evalution','customized_module');

    public function return_id(){
        return $this->id;
    }
    public function create_resume($data){
//        $this->user_id = $data['user_id'];
//        $this->template_id = $data['template_id'];
//        $this->resume_content = $data['resume_content'];
        return $this->add($data);
    }
    public function update_resume($id,$data){
        $this->where('id='.$id)->save($data);
    }
}