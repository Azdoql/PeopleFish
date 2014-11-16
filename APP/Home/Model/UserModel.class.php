<?php
namespace Home\Model;
use Pfish\Model;

class UserModel extends Model{
	protected $_validate  = array(
		array('verify','require','验证码必须!'), // 都有时间都验证
		array('name','checkName','帐号错误!',1,'function',4), // 只在登录时候验证
		array('password','checkPwd','密码错误!',1,'function',4), // 只在登录时候验

	);

	public function clean($data) {

		$validate = array(
            'require'   =>  '/\S+/',
            'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
            'currency'  =>  '/^\d+(\.\d+)?$/',
            'number'    =>  '/^\d+$/',
            'zip'       =>  '/^\d{6}$/',
            'integer'   =>  '/^[-\+]?\d+$/',
            'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
            'english'   =>  '/^[A-Za-z]+$/',
        );

        if (preg_match($validate['email'], $data['userName']) || 
        	preg_match($validate['number'], $data['userName']) ||
        	preg_match($validate['require'], $data['userName'])) {
        
		}

		/*
		 // 检查是否有内置的正则表达式
        if(isset($validate[strtolower($rule)]))
            $rule = $validate[strtolower($rule)];
        return preg_match($rule,$value)===1;
        */
	}
}
?>