<?php
namespace Home\Model;
use Pfish\Model;

class UserModel extends Model{
	protected $_validate  = array(
		array('userName','','用户名不能为空!'), // 都有时间都验证
		array('name','checkName','帐号错误!',1,'function',4), // 只在登录时候验证
		array('password','checkPwd','密码错误!',1,'function',4), // 只在登录时候验

	);

    protected function login() {
        $this->
    } 

}
?>