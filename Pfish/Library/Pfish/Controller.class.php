<?php
namespace Pfish;

/**
 * 控制器类库文件
 */
class Controller {

    /**
     * 视图实例对象
     * @var view
     * @access protected
     */    
    protected $view  = null;
    /**
     * wenjianjiegoulujing
     * @var view
     * @access protected
     */    
    protected $filePath  = null;


    public function __construct() {
        //include APP_PATH.'Home/Controller/'.CONTROLLER_NAME.'.php';
        //实例化视图类
        $this->view = Pfish::instance('Pfish\View');
    }
    
    /**
     * 
     */
    public function show ($filename, $urlCase) {
        if (is_file(APP_PATH.'Home/Controller/'.$filename.$urlCase.'.php')) {
            include APP_PATH.'Home/Controller/'.$filename.$urlCase.'.php';
        } else {
            echo 'Error:';
        } 

        return ;
    }

    /**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param string $templateFile 模板文件名
     * @return mixed
     */
    public function display ($templateFile='') {
        $this->view->display($templateFile);
    }

    // 替换模版中的值
    public function assign($key, $value) {
        $this->vars[$key] = $value;
    }

    private function getIncludeFile( $_inc_file ) {
        $_tpl_dir = $this->_tpl_dir;
        $_cache_dir = $this->_cache_dir;
        if ( strpos($_inc_file, '../') !== FALSE ) {
            $_tarr = explode('/', $_inc_file);
            foreach ( $_tarr as $_val ) {
                if ( $_val != '..' ) break;
                $_tpl_dir = dirname($_tpl_dir);
                $_cache_dir = dirname($_cache_dir);
                $_inc_file = str_replace('../', '', $_inc_file);
            }
        }

        $_tpl_file = $_tpl_dir.'/'.$_inc_file;
        $_cache_file = $_cache_dir.'/'.$_inc_file.'.php';
        //echo $_tpl_file,'<br />';
        //echo $_cache_file,'<br />';
        if ( ! $this->isCached( $_cache_file ) ) {
            $this->compile( $_tpl_file, $_cache_file );
        }
        
        return $_cache_file;
    }
}
?>