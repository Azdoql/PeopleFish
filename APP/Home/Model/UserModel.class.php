<?php
namespace Home\Model;
use Pfish\Model;

class UserModel extends Model{
	
    protected function login($_data) {
      
    	$_model = array(
    	  'userName' =>  array('require'),
        'passWord' =>  array('require'),
    	);
    	$_errono = array(
    		'userName'	=>	array('用户名不能为空!'),
        'passWord'  =>  array('密码尚未填写!'),
    	);
      
      $this->clear($_data, $_model, $_errono);
    } 

}
?>