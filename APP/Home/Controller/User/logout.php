<?php 
session_start();
if (isset($_SESSION['user_name'])) {
	$_SESSION =array();   
	unset($_SESSION);
	$this->success('成功退出！');
}
?>