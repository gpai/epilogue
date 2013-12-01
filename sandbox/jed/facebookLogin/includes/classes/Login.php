<?php

class Login {
	
	public static function isLoggedIn() {
		$facebook = Registry::getInstance()->get("fb");
		
		// First check to see if they are logged in
		$user = $facebook->getUser();
		if (!(bool)$user)
			return false;
		
		// If logged in, check permissions.
		// If they don't have the right permissions, send them through the login process again.
		return self::checkFacebookPermissions();
		
	}

	
	public static function getLoginUrl() {
		$config = Registry::getInstance()->get("config");
		$facebook = Registry::getInstance()->get("fb");
		
		$params = array(
				'scope' => $config['fb']['scope'],
				'redirect_uri' => $config['fb']['redirectLogin']
		);
		$loginUrl = $facebook->getLoginUrl($params);
		
		return $loginUrl;
	}
	
	public static function logout() {
		if (self::isLoggedIn()) {
// 			Registry::getInstance()->get("fb")->setSession(null);
			Session::destroy();
			return true;
		}else{
			return true;
		}
		
	}
	
	public static function getLogoutUrl() {
		$config = Registry::getInstance()->get("config");
		$facebook = Registry::getInstance()->get("fb");
		
		$params = array(
				'scope' => $config['fb']['scope'],
				'next' => $config['fb']['redirectLogout']
		);
		$url = $facebook->getLogoutUrl($params);
		
		return $url;
	}
	
	public static function getFacebookStatusUrl() {
		$config = Registry::getInstance()->get("config");
		$facebook = Registry::getInstance()->get("fb");
		
		$params = array(
				'scope' => $config['fb']['scope'],
				'redirect_uri' => $config['fb']['redirect']
		);
		$url = $facebook->getLoginStatusUrl($params);
		
		return $url;
	}
	
	public static function checkFacebookPermissions() {
		$config = Registry::getInstance()->get("config");
		$facebook = Registry::getInstance()->get("fb");
		
		$permissions = $facebook->api("/me/permissions");
		$configPerms = explode(", ", $config['fb']['scope']);
		
		foreach ($configPerms as $perm) {
			if( !array_key_exists($perm, $permissions['data'][0]) ) {
				echo $perm." not in SCOPE!!";
				return false;
			}
		}
		
		return true;
	}
}
