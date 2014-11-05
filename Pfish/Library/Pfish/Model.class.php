<?php
namespace Pfish;

class Model {
	
	private $db_config = array();
	private $Db = null;

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

	public function I($table, $array) {
		$this->Db->I($table, $array);
	}
}
?>