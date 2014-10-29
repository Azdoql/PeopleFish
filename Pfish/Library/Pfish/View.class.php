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
    }

    public function fetch($templateFile = '') {

        // 页面缓存
        ob_start();
        ob_implicit_flush(0);
        $templateFile = $templateFile == '' ? 
            APP_PATH.'Home/View/'.CONTROLLER_NAME.'.html' :
            APP_PATH.'Home/View/'.dirname(CONTROLLER_NAME).'/'.$templateFile;
        $cacheFile = APP_PATH.'Home/Temp/'.CONTROLLER_NAME.'.php.html';
        Template::compiler($templateFile, $cacheFile);
        // 获取并清空缓存
        //$content = ob_get_clean();

        return $content;
    }

    
    
}

?>