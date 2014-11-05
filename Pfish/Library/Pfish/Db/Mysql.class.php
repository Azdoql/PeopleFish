<?php
namespace Pfish\Db;
use Pfish\Db;

class Mysql extends Db {
	private $_config = array();
	private $_link = null;
	private $_debug = fasle;

	public function __construct($config) {
		$this->_config = $config;
		P($this->_config );
		$this->connect();
	}

	/**
	 * Link SQL
	 */
	private function connect() {
		$this->_link = mysqli_connect($this->_config['DB_HOST'],
			$this->_config['DB_USER'], $this->_config['DB_PWD'], $this->_config['DB_NAME'],
			 $this->_config['DB_PORT']);
		
		if ( $this->_link == FALSE ) die("Error: cannot connected to the database server.");
		
		$_charset = $this->_config['DB_CHARSET'];
		mysqli_query( $this->_link, 'SET NAMES \''.$_charset.'\'');
		mysqli_query( $this->_link, 'SET CHARACTER_SET_CLIENT = \''.$_charset.'\'');
		mysqli_query( $this->_link, 'SET CHARACTER_SET_RESULTS = \''.$_charset.'\'');
	}

	public function query( $_query ) {
		//connect to the database server as necessary
		if ( $this->_link == NULL ) $this->connect();
		//print the query string for debug	
		//if ( $this->_debug ) echo 'query: ', $_query, '<br />';
		return mysqli_query( $this->_link, $_query );
	}

	public function select() {

	}

	public function I($table, $array) {
		$_fileds = null;
		$_values = null;

		foreach ($array as $key => $val) {
			$_fileds .= ($_fileds === null) ? $key : ','.$key;
			$_values .= ($_values === null) ? '\''.$val.'\'' : ',\''.$val.'\''; 
		}
		if ($_fileds !== null) {
			$query = 'INSERT INTO ' . 'pfish_' . $table . '(' .$_fileds . ') VALUES(' .
				$_values. ')' ;

			if ($this->query($query) != false) {
				echo '<br />sss'. mysqli_insert_id($this->_link);
			}
		}
		return FALSE;
	}

}
?>