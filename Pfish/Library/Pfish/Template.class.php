<?php
namespace Pfish;
/**
 * 模版解析
 */
class Template {

    private $template_tag_left = '<{';//模板左标签
    private $template_tag_right = '}>';//模板右标签

	public function __construct () {

	}

	// 定义模版解析数组
	static public $_rules = array(
        /*{$name}*/
        '/\{\$([a-z0-9_]+)\}/is'    => '<?php echo \$$1; ?>',
        /*{$name.naem}*/
        '/\{\$([a-z0-9_]+).([a-z0-9_]+)\}/is'    => 
            '<?php echo \$$1[\'$2\']; ?>',
        /*{$name.name.name}*/
        '/\{\$([a-z0-9_]+).([a-z0-9_]+).([a-z0-9_]+)\}/is'    => 
            '<?php echo \$$1[\'$2\'][\'$3\']; ?>',
        /*${name}*/
        '/\$\{([a-z0-9_]+)\}/is'    => '<?php echo $this->vars[\'$1\']; ?>',
        /*${name.naem}*/
        '/\$\{([a-z0-9_]+).([a-z0-9_]+)\}/is'    => 
            '<?php echo $this->vars[\'$1\'][\'$2\']; ?>',
        /*${name.name.name}*/
        '/\$\{([a-z0-9_]+).([a-z0-9_]+).([a-z0-9_]+)\}/is'    => 
            '<?php echo $this->vars[\'$1\'][\'$2\'][\'$3\']; ?>',
        /*include | require file*/
        '/\{(include|require)\s+([a-z0-9_\/\-]+)\}/is'    
            =>  '<?php $1 \$this->getIncludeFile(\'$2\') ?>',
        /*for ( val : {array} )*/
        '/for\s*\(\s*\$([a-z0-9_]+)\s*:\s*\$\{([a-z0-9_]+)\}\s*\)/i'
            => 'foreach ( \$this->vars[\'$2\'] as \$$1 )',
    );


	/**
	 * 解析模版函数
	 * @param $_tmpl_file 模版文件
	 * @param $_temp_file 解析后的模版文件
	 */
	static function compiler($_tmpl_file, $_temp_file) {

        // 获取模版内容
		$_TPL = file_get_contents($_tmpl_file);
        if ( $_TPL === FALSE ) {
            die('Error:获取模版内容失败【'.$_tmpl_file.'】');
        }    
       
        //解析后的模版内容
        $_TPL = preg_replace( array_keys(self::$_rules), self::$_rules, $_TPL);
        
        if ( ! file_exists( $_temp_file ) ) {
            self::mkdirs($_temp_file);
        }
        
        //3. put the replaced content into the cache file
        if ( file_put_contents($_temp_file, $_TPL, LOCK_EX) != strlen($_TPL) )
            die('Error: Unable to write the content to the cache file '.$_temp_file);
	}



    /**
     * 匹配结束 字符串
     */
    private function parse_comm($content) {
        $search = array(
            "/".$this->template_tag_left."\/foreach".$this->template_tag_right."/is",
            "/".$this->template_tag_left."\/if".$this->template_tag_right."/is",
            "/".$this->template_tag_left."else".$this->template_tag_right."/is",
  
        );
  
        $replace = array(
            "<?php } ?>",
            "<?php } ?>",
            "<?php } else { ?>"
        );
        $content = preg_replace($search, $replace, $content);
        return $content;
    }

    /**
     * 销毁变量 
     */
    public function __destruct(){
        $this->vars = null;
    }


    static public function mkdirs ($dir) {
        $dir = dirname($dir);
        if (!is_dir($dir)) {
            if (!is_dir(dirname($dir))) {
               self::mkdirs(dirname($dir));
            } 
            mkdir($dir, 0755, true);
        }        
    }

  
}
?>