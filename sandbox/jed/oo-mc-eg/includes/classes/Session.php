<?php

class Session {

	public static function destroy() {
		global $config;
		$db = new Db($config['db']['user'], $config['db']['password'], $config['db']['schema']);
		var_dump($db->query_session_destroy(), "query");
		setcookie("epi_id", 0, 0, "/");
		setcookie("epi_session", 0, 0, "/");
		setcookie("epi_loginkey", 0, 0, "/");
		session_destroy();
	}
}

?>