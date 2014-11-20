<?php
session_start();
if (isset($_POST) && isset($_POST['_act']) && 'log' == $_POST['_act']) {
	$user = D('User');
	// cleaer shu ju

	$data = array(
		'userName'	=>	$_POST['userName'],
		'passWord'	=>	$_POST['passWord'],
	);

	$user->creat($_POST);
	$info = false;
	$_post = $user->select('User');
	if (is_array($_post)) {
		foreach ($_post as $key => $value) {
			if ($value['userName'] !== $data['userName'] &&
				$value['passWord'] !== md5($data['passWord'])) {
				$info = false;
			} else {
				$info = true;
			}
		}
	}
	

	if ($info) {
		session_start();
		$_SESSION['user_name'] = $_POST['userName'];  
		$this->success('登录成功！', '../Index/index.html');
	} else {
		$this->success('用户名不存在或用户名和密码不匹配！');
	}

}



$this->display();
?>