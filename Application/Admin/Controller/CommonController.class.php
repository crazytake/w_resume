<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    
    public function __construct(){
        parent::__construct();
        if(!session('id')){
            $this->error('请先登录系统！',U('Login/index'));
        }
		
		//权限处理
		$admin_role=M("admin_role");
		$permission_str=$admin_role->where("id=".$_SESSION["role_id"])->getField("permission_id_arr");
		$permission_arr=unserialize($permission_str);
/*		$permission_arr=array();
		$permission_arr["Index"][0]=array(17,1);
		$permission_arr["Index"][1]=array(18,1);
		$permission_arr["Admin"][0]=array(5,1);
		$permission_arr["Admin"][1]=array(4,1);
		$permission_arr["Admin"][2]=array(6,0);
		$permission_arr["Admin"][3]=array(7,0);
		$permission_arr["User"][0]=array(8,1);
		$permission_arr["User"][1]=array(9,0);
		$permission_arr["User"][2]=array(10,0);
		$permission_arr["User"][3]=array(11,1);
		$permission_arr["Resume"][0]=array(12,1);
		$permission_arr["Resume"][1]=array(13,1);
		$permission_arr["Resume"][2]=array(14,0);
		$permission_arr["Resume"][3]=array(15,0);
*/
		
		//下面的代码判断用户是否超出权限,如果当前操作没有在权限表中定义，则不作限制，否则，判定该操作是否在用户的权限范围内。
		$permission=M("admin_permission");
		$map["permission_controller"]=CONTROLLER_NAME;
		$map["permission_function"]=ACTION_NAME;
		$cur_permission_arr=$permission->where($map)->find();
		if($cur_permission_arr!=null){
			//判断是否有权限进行该操作
			$is_allow=false;
			foreach($permission_arr as $key=>$value){
				if($key==CONTROLLER_NAME){
					foreach($value as $v){
						if($v[0]==$cur_permission_arr["id"]){
							//当前操作被允许
							$is_allow=true;
						}
					}	
				}
			}
			if(!$is_allow){
				//发出错误提示
				$this->error('您没有权限执行该操作！');
			}
		}
		
		
		
		//导航处理
		$admin_permission=M("admin_permission");
		$nav_arr=array();
		foreach($permission_arr as $key => $value){
			$row=$admin_permission->where("permission_controller='$key' and permission_function='' ")->find();
			$nav_arr[$row['id']]["nav_name"]=$row["permission_name"];
			$nav_arr[$row['id']]["nav_controller"]=$row["permission_controller"];
			foreach($value as $k => $v){
				if($v[1]==1){
					$menu_row=$admin_permission->where("id='{$v[0]}'")->find();
					$nav_arr[$row['id']]["nav_menu"][]=$menu_row;
				}
			}
		}
		$this->assign("action",ACTION_NAME);
		$this->assign("controller",CONTROLLER_NAME);
		$this->assign("nav",$nav_arr);
		
		
		
    }

    
}