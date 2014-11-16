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

        return ;
    }
}
