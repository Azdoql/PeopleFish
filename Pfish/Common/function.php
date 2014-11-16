<?php
/**
 * @param $alue 输出的变量 
 */
function P($value) {
	if (is_array($value)) {
		print_r($value);
	} else {
		echo $value . '<br />';
	}
}

/**
 *
 * @param $string 字符串
 * @param $startstr  截取的第一个字符串
 * @param $endstr  截取的第二个字符串
 * @return $str 返回截取的字符串
 *
 * */
function getStr($string, $startstr = null, $endstr = null) {
	
	if (null !== $startstr) {	
		$s = strpos($string, $startstr);
		if (FALSE !== $s) {
			$string = (substr($string, $s + strlen($startstr)));
			
			if (empty($string)) {
				return false;
			}
			P($string);
		} else {
			return false;
		}
	}

	if (null !== $endstr) {
		$e = strpos($string, $endstr);
		if (FALSE !== $e) {
			$string = substr($string, 0, 0 - strlen($startstr));
		}
	}

	$array = explode('/', $string);
	foreach ($array as $value) {
		if (!empty($value)) {
			$string = !isset($string) ? $value : $string .DIR_SEP . $value;
		}
	}
	
	return $string;
}


/**
 * 递归创建文件
 * 
 */
function mkdirs ($dir) {
	$dir = dirname($dir);
    if (!is_dir($dir)) {
        if (!is_dir(dirname($dir))) {
           mkdirs(dirname($dir));
        } 
        mkdir($dir, 0755, true);
    }        
}

function I($file) {
	if (is_file($file)) {
		require $file;
	} else {
		return false;
	}

	return true;
}

/**
 *	获取和设置配置参数 
 * 	@param string | array $name 配置变量
 *	@param mixed $value 配置值
 *	@param mixed $default 默认值
 *	@return mixed
 */
function C($name = null, $value = null, $default = null) {
	static $_config = array();
	// 无参数获取 
	if (empty($name)) {
		return $_config;
	}

	//  优先执行设置获取或赋值
	if (is_string($name)) {
		if (false !== strpos($name, '.')) {
			$name = strtoupper($name);
			if (is_null($value)) {
				return isset($_config[$name]) ? $_config[$name] : $default;
			}
			$_config[$name] = $value;

			return ;
		}
	}

	// 数组配量设置
	if (is_array($name)) {
		$_config = array_merge($_config, array_change_key_case($name, CASE_UPPER));
		return ;
	}

	return null;	// 避免非法参数
}

/**
 *	加载配置文件 
 *	@param string $file 配置文件名
 *	@param string $parse 配置解析方法
 *	@return void
 */
function load_config($file, $parse = CONF_PARSE) {
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	switch ($ext) {
		case 'php':
			if (file_exists($file)) {
				return include $file;
			}			
			break;
		default:
			if (function_exists($parse)) {
				return $parse($file);
			} else {

			}
			break;
	}
}

/**
 * 实例化模型类 格式 [资源://][模块/]模型
 * @param string $name 资源地址
 * @param string $layer 模型层名称
 * @return Model
 */
function D($name='',$layer='') {

    if(empty($name)) return new Pfish\Model;
    
    $class = 'Home\\Model\\'.$name.'Model';
    $model = new $class();
    return $model;
}

/**
 * 实例化一个没有模型文件的Model
 * @param string $name Model名称 支持指定基础模型 例如 MongoModel:User
 * @param string $tablePrefix 表前缀
 * @param mixed $connection 数据库连接信息
 * @return Model
 */
function M($name='', $tablePrefix='',$connection='') {
   $class = 'Pfish\\Model';
   return new $class($name='', $tablePrefix='',$connection='');
}
?>