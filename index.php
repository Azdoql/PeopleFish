<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL); 
// 定义项目名称
define("APP_NAME", "APP");

// 项目路径
define("APP_PATH", "APP".DIRECTORY_SEPARATOR);
// 是否开启调试模式
defined('APP_DEBUG') or define ('APP_DEBUG', true);
// 引入系统文件
require dirname(__FILE__).DIRECTORY_SEPARATOR.'Pfish'.DIRECTORY_SEPARATOR.'Pfish.php';
?>
