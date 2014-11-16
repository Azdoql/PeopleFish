<?php
$error = '';
$InfoName = false;
$Info = false;

if (isset($_POST) && isset($_POST['_act']) && ($_POST['_act'] == 'reg')) {
	if (isset($_POST['userName']) && !empty($_POST['userName'])) {
		if (strlen($_POST['userName']) < 6) {
			$error = '长度不能小于６';
		} else {
			$InfoName = true;
		}
	} else {
		$error= '用户名不能为空';
	}
}

if ($InfoName) {
	if (isset($_POST['passWord']) && !empty($_POST['passWord'])) {
		if (strlen($_POST['passWord']) >= 6) {
			if ($_POST['rePass'] == $_POST['passWord']) {
				$Info = true;
			} else {
				$error = '两次密码不相同';
			}
		} else {
			$error = '密码位数不足';
		}
	} else {
		$error= '密码不能为空';
	}
}

if ($Info === true) {
	$user = M('User');

	$arr  = array(
		'userName' => $_POST['userName'],
		'passWord' => md5($_POST['passWord']),

	);

	if (!is_numeric($user->insert('User', $arr))) {
		$error = 'OK';
	} else {
		$error = 'error';
	}
}

if (isset($_POST['userName'])) {
	$this->assign('userName', $_POST['userName']);
} else {
	$this->assign('userName', '');
}

$this->assign('error', $error);
	

$this->display();
?>