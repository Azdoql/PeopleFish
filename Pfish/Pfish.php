<?php
/*
 * Pfish class file.
 * @author Dingjutu<310956199@qq.com>
 * 
 */
// 定义分节符 '\' or ' /'
defined('DIR_SEP') OR define('DIR_SEP', DIRECTORY_SEPARATOR);
// 默认项目文件
defined('APP_NAME') or define('APP_NAMR', 'App');
// 默认 项目文件 路径
defined('APP_PATH') or define('APP_PATH', 'APP'.DIR_SEP);
// 默认关闭调试模式
defined('APP_DEBUG') or define ('APP_DEBUG', false); 

// 系统根目录D:\wamp\www\PeopleFish
defined('PRO_PATH') or define('PRO_PATH', dirname(dirname(__FILE__)).DIR_SEP);
// 项目文件放置公共文件Common
defined('COMMON_PATH') or define('COMMON_PATH', APP_PATH.DIR_SEP.'Common'.DIR_SEP);
// 项目Conf目录文件放置公共配置文件 Common/Conf
defined('CONF_PATH') or define('CONF_PATH', COMMON_PATH.DIR_SEP.'Conf'.DIR_SEP);
// 系统Libaray文件目录
defined('LIB_PATH') or define('LIB_PATH', 'Pfish'.DIR_SEP.'Library'.DIR_SEP );
// 系统Mode文件目录
defined('MODE_PATH') or define('MODE_PATH', 'Pfish'.DIR_SEP.'Mode'.DIR_SEP);
// 配置文件的解析方法 
defined('CONF_PARSE') or define('CONF_PARSE', '');

require "Pfish/Library/Pfish/Pfish.class.php";
Pfish\Pfish::start();
?>