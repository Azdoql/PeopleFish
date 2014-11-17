<?php
namespace Pfish;

class Model {
	
	private $db_config = array();
	private $Db = null;
	protected $_validate = array(); 

	 /**
     * 取得DB类的实例对象 字段检查
     * @access public
     * @param string $name 模型名称
     * @param string $tablePrefix 表前缀
     * @param mixed $connection 数据库连接信息
     */
	function __construct($connection = '') {
		$config = C();
		$this->db_config = $config;
		$this->db();

	}

	/**
	 *  
	 */
	public function db() {

		switch ($this->db_config['DB_TYPE']) {
			case "mysql":
				$this->Db = new Db\Mysql($this->db_config);
				break;
			
			default:
				
				break;
		}
	}

	public function select() {
		$this->Db->select();
	}

	public function insert($table, $array) {
		$this->Db->insert($table, $array);
	}

	/**
     * 使用正则验证数据
     * @access public
     * @param string $value  要验证的数据
     * @param string $rule 验证规则
     * @return boolean
     */
	public function regex ($value, $rule) {
		 $validate = array(
            'require'   =>  '/\S+/',
            'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
            'currency'  =>  '/^\d+(\.\d+)?$/',
            'number'    =>  '/^\d+$/',
            'zip'       =>  '/^\d{6}$/',
            'integer'   =>  '/^[-\+]?\d+$/',
            'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
            'english'   =>  '/^[A-Za-z]+$/',
        );
		
		 // 检查是否有内置的正则表达式
        if(isset($validate[strtolower($rule)])) {
            $rule = $validate[strtolower($rule)];
        }
        echo preg_match($rule,$value).'<br />';
        return preg_match($rule,$value)===1;
	}

	/*
	 *
	 */
	public function clear($a)  {
		print_r($this->_validate);
		foreach ($this->_validate as $key => $value) {
			
		}
		if (!$this->regex('email@qq', 'email')) {
			$a = new Controller;
			//$a->error('ss');
		} 
	}



}
?>