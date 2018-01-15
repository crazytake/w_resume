<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    public function lst(){	
		$User = M('User'); // 实例化User对象
        $count = $User->count();// 查询满足要求的总记录数
        $Page=getpage($count,3);
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $user_arr = $User->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('user_arr',$user_arr);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板				
    }
	public function modify(){
		$User = M('User');
		//$uid=$_GET["uid"];
		//$new_data['username'] = $_POST['username'];
		
		$id=I("id");
		
		if(IS_POST){
			if($User->create($_POST)){	
				//print_r($_POST);	
				$user_info=$User->save();
				if($user_info != false){
					$this->success("用户信息修改成功",U('lst'));
				}else{
					$this->error("用户信息修改失败",U('lst'));	
				}
			}
		}else{
			$user_info=$User->where("id=$id")->find();
			$this->assign('user_info',$user_info);
			$this->display();		
		}
    }
	
	public function del(){
		$User = M('User');
		$id=I("id");
		$user_del=$User->where("id=$id")->delete();
		//$user_del=$User->where('id='.$id)->delete();
		if($user_del !=false){
		$this->success("删除用户成功",U('lst'));
		}else{
			$this->error("删除用户失败",U('lst'));	
		}
    }
	public function resume(){
		$this->display();
    }
	
	public function myResume(){
		$this->display();
    }
}
