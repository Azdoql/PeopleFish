<?php
/**
 * @param $alue 输出的变量 
 */
function P($value) {
	if (is_array($value)) {
		echo '<pre>';
		var_dump($value);
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
* @param $array 数组
* @param $sysbol 连接符号
* @param $suffix 后缀
*/
function converPaths ($array, $symbol, $suffix) {
	var_dump($array);
	echo 'aa';
    if (!empty($array[0] && !empty($array[1])) &&!empty(end($array))) {
        for ($i = 0; $i < count($array) - 1; $i++) {
            $ContrPath = isset($ContrPath) ? 
            $ContrPath.$array[$i].DIR_SEP : $array[$i].DIR_SEP;
        }            
        $ControlFile = $ContrPath . end($array);
    } else {
        $ControlFile = 'Index'.DIR_SEP.'index';
    }

    return $ControlFile.$suffix;
}


function error () {

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
?>