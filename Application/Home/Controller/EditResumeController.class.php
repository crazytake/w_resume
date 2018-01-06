<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ResumeModel;

Class EditResumeController extends Controller
{
    // public function EditResume() {
    //   echo "test";
    //
    //   $this->display();
    // }\

    public function create_resume()
    {
        $this->display();
    }

    public function upload_img()
    {
        $Resume = D('Resume');
        $Resume->create();
        $userId = 132;
        $templateId = 21;
        $config = array(
            'maxSize' => 3145728,
            'rootPath' => './Application/Home/Uploads/',
            'savePath' => 'headPic/' . $userId . '/',
            'exts' => array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub' => false,
            'replace' => true,
            'saveName' => array('uniqid', ''),
        );
        $upload = new \Think\Upload($config);//实例化上传类

        $info = $upload->upload();
        if (!$info) {
            $this->error($upload->getError());
            $res['status'] = 0;
            $res['content'] = '上传失败！';
            $this->ajaxReturn($res);
        } else {
            if($_POST['resume_id']){
                $savePath = $info['img']['savepath'] . $info['img']['savename'];
                $data['head_path'] = $savePath;
                $Resume->update_resume($_POST['resume_id'],$data);
                $res['status'] = 1;
                $res['content'] = '上传成功！';
                $this->ajaxReturn($res);
            }else{
                $savePath = $info['img']['savepath'] . $info['img']['savename'];
                $data['user_id'] = $userId;
                $data['template_id'] = $templateId;
                $data['head_path'] = $savePath;
                $resume_id = $Resume->create_resume($data);
                $res['status'] = 1;
                $res['content'] = '上传成功！';
                $res['resume_id'] = $resume_id;
                $this->ajaxReturn($res);
            }
        }
    }

    public function save_info()
    {
        $Resume = D('Resume');
        $data = json_decode(file_get_contents("php://input"),true);
        if ($data['resume_id']) {
            $module_name = array_keys($data)[1];
            $data[$module_name] = json_encode($data[$module_name]);
            $Resume->update_resume($data['resume_id'],$data);
            $res['status'] = 1;
            $res['content'] = '上传成功！';
            $this->ajaxReturn($res);
        } else {
            $module_name = array_keys($data)[1];
            $data[$module_name] = json_encode($data[$module_name]);
            $resume_id = $Resume->create_resume($data);
            $res['status'] = 1;
            $res['content'] = '保存成功！';
            $res['resume_id'] = $resume_id;
            $this->ajaxReturn($res);
        }
    }

    protected function save_change($arr, $type)
    {
        $resume[$type] = $arr;
        return $resume;
    }

}

?>
