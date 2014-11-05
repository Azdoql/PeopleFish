<?php

var_dump($_POST);
if (isset($_POST) && isset($_POST['userName']) && isset($_POST['userName']) ) {
	$user = M();
	unset($_POST['rePass']);
	$user->I('User', $_POST);
}


$this->display();
?>