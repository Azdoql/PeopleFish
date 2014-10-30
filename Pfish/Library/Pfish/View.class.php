<?php
namespace Pfish;

class View {

	public $_conter_dir = null;
    
    public function __construct()
    {
    	
    }

    /**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param string $templateFile 模板文件名
     * @return mixed
     */
    function display ($templateFile='') {
        // 解析并获取模板内容
        $content = $this->fetch($templateFile);

        return $content;
    }

    public function fetch($templateFile = '') {

        // 页面缓存
        ob_start();
        ob_implicit_flush(0);
        $templateFile = $templateFile == '' ? 
            APP_PATH.'Home/View/'.CONTROLLER_NAME.'.html' :
            APP_PATH.'Home/View/'.dirname(CONTROLLER_NAME).'/'.$templateFile;
        $cacheFile = APP_PATH.'Home/Temp/'.CONTROLLER_NAME.'.html';
        if (is_file($templateFile)) {
            Template::compiler($templateFile, $cacheFile);
        } else {
            die('Error:模版文件不存在【'.CONTROLLER_NAME.'】');
        }      

        
        // 获取并清空缓存
        //$content = ob_get_clean();
        return $cacheFile;
    }

    /**
     * 模板变量赋值
     * @access public
     * @param mixed $name
     * @param mixed $value
     */
    public function assign($name,$value=''){
        if(is_array($name)) {
            $this->tVar   =  array_merge($this->tVar,$name);
        }else {
            $this->tVar[$name] = $value;
        }
        echo $this->tVar[$name];
    }
}

?>