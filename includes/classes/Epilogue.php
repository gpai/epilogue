<?php
/*
	Epilogue Group

	advisor: Jed B.

	members: 
		Anita Marie G.
		Baldwin C.
		Nafiri K.
		Nithin J.

*/

class Epilogue {

	private $_sql = '';
	private $_facebook = '';
	private $_id = '';
	private $_token = '';

	public $id = '';

	function __construct($sql, $facebook) {
		$this->_sql = $sql;
		$this->_facebook = $facebook;
		$this->_id = $this->_facebook->getUser();
		$this->_token = $facebook->getAccessToken();

		$this->id = $this->_id;
	}

	public function hasAccount($fbId) {
			$check = $this->_sql->query("SELECT COUNT(*) AS TOTALFOUND FROM user WHERE fb_id = '". $fbId ."' LIMIT 1");
			return ($check['TOTALFOUND']);
	}

	private function makeAccount($fbId) {
		$this->_sql->raw_query("INSERT INTO user (id, fb_id, added) VALUES (NULL, ". $fbId .", ". time() .")");
		$this->_sql->raw_query("INSERT INTO fbtoken (id, fb_id, fb_token, added) VALUES (NULL, ". $fbId .", '". $this->_token ."', ". time() .")");
	}

	public function isLoggedIn() {
		if ($this->_id && isset($_SESSION['epi_id'])) { // Check if user has a current ID...
			if (!$this->hasAccount($this->_id)) {
				$this->makeAccount($this->_id);
			}
			// Check session id with database.
			$result = $this->_sql->query("SELECT * FROM session WHERE user_id='". $_SESSION['epi_id'] ."' LIMIT 1");
			return (session_id() == $result['session_id']);
		} else {
			return false; // No Session with user.
		}
	}

	public function fbCheck() {
		if ($this->_id && !$this->isLoggedIn()) {
			$this->login($this->_id);
		}
	}

	public function login($fbId) {

		if (!$this->isLoggedIn()){ // Not logged in...
			if (!$this->hasAccount($this->_id)) { // make account!
				$this->makeAccount($this->_id);
			}
			$check = $this->_sql->query("SELECT COUNT(*) AS TOTALFOUND FROM user WHERE fb_id = '". $fbId ."' LIMIT 1");
			if ($check['TOTALFOUND'] > 0) {
				$info = $this->_sql->query("SELECT * FROM user WHERE fb_id = '". $fbId ."' LIMIT 1");
				$this->sessionBuild($info['id']);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function logout() {
		if ($this->isLoggedIn()){ 
			var_dump($this->_sql->session_destroy());
			return "foo";
		}else{
			return true;
		}	
	}


	public function sessionRebuild() {
		if (!$this->isLoggedIn() && isset($_COOKIE['epi_loginkey'])) {
			/* 
				Check if the user has the same IP and Browser
			*/
			
			$result = $this->_sql->query("SELECT COUNT(*) AS TOTALFOUND, user_id FROM session WHERE (ip = '". $_SERVER['REMOTE_ADDR'] ."' AND user_agent = '". $_SERVER['HTTP_USER_AGENT'] ."' AND login_key = '". $_COOKIE['epi_loginkey'] ."') LIMIT 1");
			if ($result['TOTALFOUND'] > 0) {
				$this->sessionBuild($result['user_id']);
			}
		}else{
			/* Refresh the session */
			$result = $this->_sql->query("SELECT *, COUNT(*) AS TOTALFOUND FROM user_sessions WHERE login_key = '". $_COOKIE['epi_loginkey'] ."'  LIMIT 1");
			if ($result['TOTALFOUND'] > 0) {
				$this->sessionBuild($result['user_id']);
			}
		}

		if ($this->isLoggedIn()) {
			setcookie("epi_id", $_SESSION['epi_id'], 0, "/");
			setcookie("session", session_id(), 0, "/");	
			setcookie("epi_loginkey", $_SESSION['epi_loginkey'], time()+60*60*24*365*10, "/");
			$this->_sql->raw_query("UPDATE session SET last_action = '". time() ."' WHERE login_key = '". $_SESSION['epi_loginkey'] ."' LIMIT 1");

		}
	}

	private function sessionBuild($id) {

		
		$genKey = md5(time()*time()+(60*60*24*365*10) ."key". session_id());

		$this->_sql->session_add($id, $genKey);

		$_SESSION['epi_id'] = $id;
		$_SESSION['epi_loginkey'] = $genKey;
		
		setcookie("epi_id", $id, 0, "/");
		setcookie("epi_session", session_id(), 0, "/");	
		setcookie("epi_loginkey", $genKey, time()+60*60*24*365*10, "/");
	}	

	public function createAccount($fbId, $fbToken) {
		$this->_sql->raw_query("INSERT INTO user (id, fb_id, added) VALUES (NULL, ". $fbId .", ". time() .")");
		$this->_sql->raw_query("INSERT INTO token (id, fb_id, fb_token, added) VALUES (NULL, ". $fbId .", '". $this->_token ."', ". time() .")");
		return;
	} 

	/* Trustees */

	public function saveTrustee($user, $id_1, $id_2) {
		# Assume User is Logged in, $user -> User Object
		$this->_sql->raw_query('INSERT INTO epi_trustees VALUES (NULL, '. $user->_id .',  '. $id_1 .',  '. $id_2 .')  ON DUPLICATE KEY UPDATE primary = '. $id_1 .', secondary = '. $id_2 .';');
	}

	public function hasTrustees($user) {
		# Assume User is Logged in, $user -> User Object
		$q = $this->_sql->query('SELECT COUNT(*) AS TOTALFOUND FROM epi_trustees WHERE user_id = "'. $user->_id .'"');
		return ($q['TOTALFOUND'] > 0);
	}

	public function trusteeInfo($user, $which = 'primary') {
		# Assume User is Logged in, $user -> User Object
		$q = $this->_sql->query('SELECT * FROM epi_trustees WHERE user_id = "'. $user->_id .'"');
		$call = $user->graph_call_on_user($q[$which], 'fields=name');
		return array('id' => $q[$which], 'name' => $call->name);
	}

	/* Messages */
	public function saveMessage($user, $recepient, $message) {
		# Assume User is Logged in, $user -> User Object
		$this->_sql->raw_query('INSERT INTO epi_messages VALUES (NULL, '. $user->_id .',  '. $recepient .',  "'. htmlentities($message) .'") ');
	}


	function __destruct() {

	}
}

