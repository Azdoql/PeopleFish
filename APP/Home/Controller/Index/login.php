<?php
print_r($_POST);
if (isset($_POST) && isset($_POST['_act']) && 'log' == $_POST['_act']) {
	$user = D(User);
	// cleaer shu ju
	$user->clear();
	if ($user->insert()) {
		$this->success();
	}
}

$this->display();
?>