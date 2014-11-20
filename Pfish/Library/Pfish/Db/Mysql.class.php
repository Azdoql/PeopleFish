<?php
namespace Pfish\Db;
use Pfish\Db;

class Mysql extends Db {
	private $_config = array();
	private $_link = NULL;
	private $_debug = false;

	public function __construct($config) {
		$this->_config = $config;
		$this->connect();
	}

	/**
	 * Link SQL
	 */
	private function connect() {
		$this->_link = mysqli_connect($this->_config['DB_HOST'],
			$this->_config['DB_USER'], $this->_config['DB_PWD'], 
			$this->_config['DB_NAME'],
			$this->_config['DB_PORT']);
		
		if ( $this->_link == FALSE ) {
			die("Error: cannot connected to the database server.");
		}

		$_charset = $this->_config['DB_CHARSET'];
		mysqli_query( $this->_link, 'SET NAMES \''.$_charset.'\'');
		mysqli_query( $this->_link, 'SET CHARACTER_SET_CLIENT = \''.$_charset.'\'');
		mysqli_query( $this->_link, 'SET CHARACTER_SET_RESULTS = \''.$_charset.'\'');
	}

	public function query( $_query ) {
		
		if ( $this->_link == NULL ) {
			$this->connect();
		}

		return mysqli_query( $this->_link, $_query );
	}

	public function select($table, $_type = MYSQLI_ASSOC) {
		$_query = 'SELECT * FROM '. 'pfish_' . $table .' WHERE 1 = 1 ';
		
		$_ret = $this->query ( $_query );

		
		if ( $_ret != FALSE ) {
			$_result = array();
			while ( ( $_row = mysqli_fetch_array( $_ret, $_type ) ) != FALSE ) {
				$_result[] = $_row;
			}

			return $_result;
		} else {
			echo 'Error!';
		}
		return FALSE;

	}

	public function insert($table, $array) {
		$_fileds = null;
		$_values = null;

		foreach ($array as $key => $val) {
			$_fileds .= ($_fileds === null) ? $key : ','.$key;
			$_values .= ($_values === null) ? '\''.$val.'\'' : ',\''.$val.'\''; 
		}
		if ($_fileds !== null) {
			$query = 'INSERT INTO ' . 'pfish_' . $table . '(' .$_fileds . 
				') VALUES(' . $_values. ')' ;

			if ($this->query($query) != FALSE) {
				return mysqli_insert_id($this->_link);
			}
		}
	}

}
?>