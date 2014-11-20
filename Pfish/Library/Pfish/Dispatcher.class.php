<?php
/**
 *
 * Dispatcher 
 *      
 */
namespace Pfish;

class Dispatcher {

    /**
      * URL解析函数
      * @param void
      * @return  解析后的URL（控制器url）
      */
    static public function dispatch () {

        $PATH_INFO = isset($_SERVER['PATH_INFO']) ?
            $_SERVER['PATH_INFO'] : '';

        if (FALSE !== strpos($PATH_INFO, '.html')) {
            $contArr = explode('/', $PATH_INFO);
            array_shift($contArr);
            $urlCase = substr(array_pop($contArr), 0, -5);
        } else {
          $contArr = 'Index';
          $urlCase = 'index';
        }

        self::getControllerS($contArr ,$urlCase);
        return ;
    }

    /**
     *  @param $var 控制器文件
     *  @param $urlCase 模版文件
     */
    static public function getControllerS($contArr = array(),$urlCase) {
      if (is_array($contArr)) {
            foreach ($contArr as $value) {
              $filename = isset($filename) ? $filename.$value.'/' : $value.'/';
            }
        } elseif (is_string($contArr)) {
            $filename = $contArr.'/';
        }

      define('CONTROLLER_NAME', $filename.$urlCase);
      
      $o = Pfish::instance('Pfish\Controller');
      $o->show($filename, $urlCase);
      return false;
    } 

}
?>