<?php

class Database {

	private $_sql_db = '';
	private $_sql_user = '';
	private $_sql_pass = '';
	private $_sql_host = '';

	private $conn = '';
	
	private $_queries = 0;

	function __construct($user, $pass, $db, $host="localhost") {
		$this->_sql_db = $db;
		$this->_sql_user = $user;
		$this->_sql_pass = $pass;
		$this->_sql_host = $host;
		
		$dsn = 'mysql:host='.$host.';dbname='.$db;
		$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
		$this->conn = new PDO($dsn, $user, $pass, $options);		
	}

	public function raw_query($query) {
		return $this->conn->query($query);
	}

	public function query($query) {
		$stmt = $this->conn->query($query);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function fetchOne($query) {
		return $this->query($query);
	}
	
	public function fetchAll($query) {
		$resultSet = array();
		$stmt = $this->conn->query($query);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultSet[] = $row;
		}
		return $resultSet;
	}

	public function session_add($id, $key) {
		##
		## Since, the SQL table is set up such that only unique
		## 	users may be added... we must check for sessions
		##	made for the current user first.
		##
		global $config;
		$result = $this->query("SELECT COUNT( * ) AS TOTALFOUND FROM ".$config['session']['dbtable']." WHERE `user_id` = '". $id ."' LIMIT 1");

		
		if ($result['TOTALFOUND'] > 0) {
			$this->raw_query("DELETE FROM `epi_sessions` WHERE `user_id` = '". $id ."'");
		}
		$this->raw_query("INSERT INTO  ".$config['session']['dbtable']." (
					`last_activity` ,
					`session_id` ,
					`login_key` ,
					`ip_address` ,
					`user_agent` ,
					`user_id`
				)
				VALUES (
					'". time() ."',  '". session_id() ."',  '". $key ."', '". $_SERVER['REMOTE_ADDR'] ."',  '". $_SERVER['HTTP_USER_AGENT'] ."',  '". $id ."'
				);");
		
	}

	public function query_session_destroy() {
		return $this->raw_query("DELETE FROM `epi_sessions` WHERE `user_id` = '". $_SESSION['epi_id'] ."'");
	}

	function __destruct() {
// 		mysql_close($this->_sql);
		/*
			echo 'queries: '. $this->_queries;
			echo 'execution time: '. number_format((microtime(true)-$_SERVER["REQUEST_TIME_FLOAT"]), 5) .'s';
		*/
	} 

}

?>