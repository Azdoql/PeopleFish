<?php
$this->assign('title', '网上问卷调查系统');

$tpl = array('tit'	=>	array(
	'title'	=>	'问卷调查',
	'url'	=>	'www.baidu.com'
	),
); 

$this->assign('tit', $tpl['tit']);

$tpl = array(
	array(
		'url'	=>	'#',
		'name'	=>	'问卷',
	),
	array(
		'url'	=>	'#',
		'name'	=>	'表单'
	),
	array(
		'url'	=>	'#',
		'name'	=>	'模版库',
	),
	array(
		'url'	=>	'#',
		'name'	=>	'论坛',
	),
	array(
		'url'	=>	'#',
		'name'	=>	'帮助',
	),
); 

$this->assign('nav', $tpl);
$this->display('index.html');
?>