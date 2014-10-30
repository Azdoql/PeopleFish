<?php
namespace Pfish;

/**
 * 控制器类库文件
 */
class Controller {
    public $vars = array();
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
        include $this->view->display($templateFile);
    }

    private function getIncludeFile( $_inc_file ) {
       //return include'http://localhost/PeopleFish/APP/Home/View/Common/'.$_inc_file.'.html';
    }

    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return 
     */
    public function assign($name, $value='') {
        if (is_array($name)) {
            $this->vars = array_merge($this->vars,$name);
        } else {
            $this->vars[$name] = $value;
        }
    }
}
?>