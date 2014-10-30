<?php
/**
 * Build 类库文件 
 *
 */
namespace Pfish;

class Build {
    
    static public function checkDir($module) {

        // 检测应用目录是否需要自动创建
        if (!is_dir(APP_PATH.$module)) {
            // 创建模块的目录结构
            self::buildAppDir($module);
        } else {
            // 检查缓存目录
            self::buildRuntime();
        }
    }
    
    static public function mkdirs ($dir) {
        if (!is_dir($dir)) {
            if (!is_dir(dirname($dir))) {
               self::mkdirs(dirname($dir));
            } 
            mkdir($dir, 0755, true);
        }
        
        // Ã¿¸öÎÄ¼þÄ¿Â¼½¨Á¢index.htmlÎÄ¼þ
        if (!file_exists($dir.'/index.html')) {
            file_put_contents($dir.'/index.html', '<html>Error</html>');
        }
        
    }

    // 检测应用目录是否需要自动创建
    static public function buildAppDir($module) {
        // 没有创建的话自动创建

        if (!is_dir(APP_PATH)) {
            if (!mkdir(APP_PATH, 0777, true)) {
                die("Error:".dirname(__FILE__));
            }
        }
       
        if (is_writeable(APP_PATH)) {echo 'sdsd';
            $dirs = array(
                COMMON_PATH,
                COMMON_PATH.'Common/',
                CONF_PATH,
                APP_PATH.$module.'/',
                APP_PATH.$module.'/Common/',
                APP_PATH.$module.'/Controller/',
                APP_PATH.$module.'/View/',
                APP_PATH.$module.'/Conf/',
                );

            // 生成项目目录文件
            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
            }
            // 写入目录安全文件
            self::buildDirSecure($dirs);
            // 写入应用配置文件
            if (!is_file(CONF_PATH.'config.php')) {
                file_put_contents(CONF_PATH.'config.php', "<?php\n".
                    "return array(\n\t//'配置项'    =>  '配置值'\n);?>");
            }
            // 写入模块配置文件
            if (!is_file(APP_PATH.$module.'/Conf/config.php')) {
                file_put_contents(APP_PATH.$module.'/Conf/config.php', "<?php\n".
                    "return array(\n\t//'配置项'    =>  '配置值'\n);?>");
            } else {
                header('Content-Type:text/html; charset=utf-8');
                exit('应用目录['.APP_PATH.']不可写，目录无法自动生成！<BR>请手动生成项目目录~');
            }
            // 写入控制器文件
            #code.......
            if (false) {
                self::buildController($module, $controller);
            } else {
                self::buildController($module);
            }

            // 写入视图文件
            #code......
            
        } else {
            die("Error: No TRUE");
        }
        
    }

    // 检查缓存目录(Runtime) 如果不存在自动创建
    static public function buildRuntime() {

    }

    // 安全目录文件生成方法 
    static public function buildDirSecure($dirs = array()) {
        // 目录安全文件 （默认开启）
        defined('BUILD_DIR_SECURE') or define('BUILD_DIR_SECURE', true);
        if (BUILD_DIR_SECURE) {
            defined('DIR_SECURE_FILENAME') or define('DIR_SECURE_FILENAME', 'index.html');
            defined('DIR_SECURE_CONTENT') or define('DIR_SECURE_CONTENT', '');

            // 自动写入安全目录文件
            $content = DIR_SECURE_CONTENT;
            $files = explode(',', DIR_SECURE_FILENAME);
            foreach ($files as $filename) {
                foreach ($dirs as $dir) {
                    file_put_contents($dir.$filename, $content);
                }
            }
        }
    }

    // 自动生成控制器文件
    static public function buildController($module, $controller = 'Index') {
        $file = APP_PATH.$module.'/Controller/'.$controller.'/index.php';
        if(!is_file($file)){
            if (!file_exists(dirname($file))) {
                mkdir(dirname($file), 0755, true);
            }
            $content = "<?php\n\techo 'Hello World!';\n?>";
            file_put_contents($file,$content);
        }
    }
}
?>