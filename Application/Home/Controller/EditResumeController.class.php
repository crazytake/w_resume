<?php
  namespace Home\Controller;
  use Think\Controller;

  Class EditResumeController extends Controller {
    // public function EditResume() {
    //   echo "test";
    //
    //   $this->display();
    // }
    public function create_resume() {
      $this->display();
    }
    public function upload_img(){
      var_dump($_FILES['img']);
      if(!$_FILES){
          echo "111";
      }
      if($this->method == 'post'){
        $config = array(
          'maxSize' => 3145728,
          'rootPath'=> './Uploads/',
          'savePath'=>'',
          'exts'    => array('jpg', 'gif', 'png', 'jpeg'),
        );
        $upload = new \Think\Upload($config);//实例化上传类

        $info   =   $upload->upload();
        echo "test1".$_FILES['img'].$info.$upload;
      }


      // 上传文件

      // $this -> display();
      // if(!$info) {// 上传错误提示错误信息
      //     $this->error($upload->getError());
      // }else{// 上传成功
      //   foreach($info as $file){
      //     echo $file['savepath'].$file['savename'];
      //   }
      //   $this->success('上传成功！');
      // }
    }
    public function save_info() {
      var_dump($_POST);
//      $data = M()
    }

    // protected $resume = array(
    //   'baseinfo' => array(
    //     'username' => 'An',
    //     'birthday' => '1993/06',
    //     'location' => '广州',
    //     'experience' => '一年工作经验',
    //     'phone' => '13654822549',
    //     'oneword' => '没什么好说的'
    //   ),
    //   'intension' => array(
    //     'expect_job' => 'php开发',
    //     'expect_type'=> '全职',
    //     'expect_city'=> '广州',
    //     'entry_time' => '随时到岗'
    //   ),
    //   'education' => array(
    //     [0]=> array(
    //       'school_name' => '华师',
    //       'major' => '网络工程',
    //       'qualification' => '本科',
    //       'graduation_year' => '2016',
    //       'study_contents' => '........',
    //     ),
    //     [1] => array(
    //       'school_name' => '华师',
    //       'major' => '网络工程',
    //       'qualification' => '本科',
    //       'graduation_year' => '2016',
    //       'study_contents' => '........',
    //     )
    //   ),
    //   'work_history' => array(
    //     [0] => array(
    //       'company' => 'xx',
    //       'place' => 'php开发工程师',
    //       'c_stime' => '2016/06',
    //       'c_etime' => '2017/01',
    //       'work_contents' => 'xxxxx'
    //     ),
    //     [1] => array(
    //         'company' => 'xx',
    //         'place' => 'php开发工程师',
    //         'c_stime' => '2016/06',
    //         'c_etime' => '2017/01',
    //         'work_contents' => 'xxxxx'
    //     )
    //   ),
    //   'project_history' => array(
    //     [0] => array(
    //       'project_name' => 'xx',
    //       'project_duty' => '前端开发',
    //       'p_stime' => '2016/06',
    //       'p_etime' => '2016/09',
    //       'project_contents' => 'xxx'
    //     )
    //   ),
    //   'evalution' => array(
    //     'eva_contents' => 'xxx'
    //   )
    // );
  }
  ?>
