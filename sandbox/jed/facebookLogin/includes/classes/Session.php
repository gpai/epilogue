<?php

class Session {

	public static function destroy() {
		Registry::getInstance()->get("db")->query_session_destroy();
		setcookie("epi_id", 0, 0, "/");
		setcookie("epi_session", 0, 0, "/");
		setcookie("epi_loginkey", 0, 0, "/");
		session_destroy();
	}
}

