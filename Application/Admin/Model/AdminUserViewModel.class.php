<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class AdminUserViewModel extends ViewModel {
    
    public $viewFields = array(

    	'AdminUser'=>array('id','username','role_id','_type'=>'LEFT'),
    	'AdminRole'=>array('role_name','permission_id_arr','_on'=>'AdminRole.id=AdminUser.role_id'),

    	);

    
}