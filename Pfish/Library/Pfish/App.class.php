<?php
/**
 *  App 系统运行类库文件
 */
namespace Pfish;

class App {
    
    /**
     * 系统运行文件
     * @return void;
     */
    static public function run() {
    
        if (FALSE !== APP_DEBUG) {
           App::init();
        } else {
            echo '加载缓存文件<br />';
        }
        
        return ;
    }
    
    /**
     * init
     * @return void
     */
    static public function init () {
        // URL 调度
        Dispatcher::dispatch();
        // 调运控制器方法
        //$_controller = new Controller;
        //$_controller->show();

        return ;
    }
}
