<?php

class Database {

	private $_sql_db = '';
	private $_sql_user = '';
	private $_sql_pass = '';
	private $_sql_host = '';

	private $connection = '';
	
	private $_queries = 0;

	function __construct($user, $pass, $db, $host="localhost") {
		$this->_sql_db = $db;
		$this->_sql_user = $user;
		$this->_sql_pass = $pass;
		$this->_sql_host = $host;

		$this->connection = new mysqli($this->_sql_host, $this->_sql_user, $this->_sql_pass, $this->_sql_db);
	}
	
	/**
	 * Quazi-depricated. Baldwin used this, but we have changed libraries, so we are going to kind of make it go away.
	 * Some bugs might show up because of this, but we will find them!
	 * 
	 * @param String $sql
	 * @throws Exception
	 * @return multitype:unknown
	 */
	public function raw_query($sql) {
		return $this->query($sql);
	}

	public function query($sql) {
		$res = mysqli_query($this->connection, $sql); 
		if (!$res) { 
			throw new Exception(mysqli_error($this->connection).". Full query: [$sql]"); 
		};
		return $res;
	}
	
	public function fetchOne($sql) {
		$res = mysqli_query($this->connection, $sql); 
		if (!$res) { 
			throw new Exception(mysqli_error($this->connection).". Full query: [$sql]"); 
		};
		$rs = $this->query($sql);
		$result = $rs->fetch_assoc();
		$rs->close();
		return $result;
	
	}
 	
	public function fetchAll($sql) {
		$res = mysqli_query($this->connection, $sql); 
		if (!$res) { 
			throw new Exception(mysqli_error($this->connection).". Full query: [$sql]"); 
		};
		
		$q = $this->raw_query($sql);
		$resultSet = array();

		
		while($r = $q->fetch_assoc())
    		$resultSet[] = $r;

		$q->close();
		
		return $resultSet;
	}

	public function session_add($id, $key) {
		##
		## Since, the SQL table is set up such that only unique
		## 	users may be added... we must check for sessions
		##	made for the current user first.
		##
		global $config;
		$result = $this->fetchOne("SELECT COUNT( * ) AS TOTALFOUND FROM ".$config['session']['dbtable']." WHERE `user_id` = '". $id ."' LIMIT 1");

		
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

	/**
	 * Runs SQL to delete user_id from SESSION table
	 * @return boolean
	 */
	public function query_session_destroy() {
		return $this->query("DELETE FROM `epi_sessions` WHERE `user_id` = '". $_SESSION['epi_id'] ."'");
	}

	function __destruct() {
// 		mysql_close($this->_sql);
		/*
			echo 'queries: '. $this->_queries;
			echo 'execution time: '. number_format((microtime(true)-$_SERVER["REQUEST_TIME_FLOAT"]), 5) .'s';
		*/
	} 

}

