<?php
namespace Pfish;

class Model {
	
	private $db_config = array();
	private $db = null;
	private $name = null;
	protected $_validate = array(); 

	 /**
     * 取得DB类的实例对象 字段检查
     * @access public
     * @param string $name 模型名称
     * @param string $tablePrefix 表前缀
     * @param mixed $connection 数据库连接信息
     */
	function __construct($name='', $tablePrefix='',$connection='') {
	
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
					$this->db = new Db\Mysql($this->db_config);
				break;
			
			default:
				
				break;
		}
	}

	public function query($query) {
		$this->db->query($query);
	}

	public function select($table, $type = MYSQLI_ASSOC) {
		return $this->db->select($table, $type);
	}

	public function insert($table, $array) {
		$this->db->insert($table, $array);
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
      
        return preg_match($rule,$value)===1;
	}

	/*
	 *
	 */
	public function creat($_data)  {
		
			$mothed =  MOTHED;
			$this->$mothed($_data);
		return false;
	}

	private static function isWhiteSpace( $str ) {
		return ( $str == '' || preg_match( '/^\s+$/' , $str ) );
	}

	protected function clear($_data, $_model, $_errorno) {
		
		$view = new Controller;

		foreach ($_data as $key => $value) {
			if (isset($_model[$key])) {
				foreach ($_model[$key] as $k => $v) {					
					if (!$this->regex($value, $v)) {
						$view->error($_errorno[$key][$k]);
					}
				}
			}
		}
	}



}
?>