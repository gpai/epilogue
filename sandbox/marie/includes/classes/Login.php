<?php

class Login {
	
	public static function isLoggedIn() {
		global $facebook;
		
		// First check to see if they are logged in
		$user = $facebook->getUser();
		if (!(bool)$user)
			return false;
		
		// If logged in, check permissions.
		// If they don't have the right permissions, send them through the login process again.
		return self::checkFacebookPermissions();
		
	}

	
	public static function getLoginUrl() {
		global $facebook, $config;
		
		$params = array(
				'scope' => $config['fb']['scope'],
				'redirect_uri' => $config['fb']['redirectLogin']
		);
		$loginUrl = $facebook->getLoginUrl($params);
		
		return $loginUrl;
	}
	
	public static function logout() {
		if (self::isLoggedIn()) {
			
			var_dump(Session::destroy());
			return "foo";
		}else{
			return true;
		}
		
	}
	
	public static function getLogoutUrl() {
		global $facebook, $config;
		
		$params = array(
				'scope' => $config['fb']['scope'],
				'next' => $config['fb']['redirectLogout']
		);
		$url = $facebook->getLogoutUrl($params);
		
		return $url;
	}
	
	public static function getFacebookStatusUrl() {
		global $facebook, $config;
		
		$params = array(
				'scope' => $config['fb']['scope'],
				'redirect_uri' => $config['fb']['redirect']
		);
		$url = $facebook->getLoginStatusUrl($params);
		
		return $url;
	}
	
	public static function checkFacebookPermissions() {
		global $facebook, $config;
		
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
	
//	public function insertFacebookLoginIntoDB($facebook_user_id, $token=NULL, $user_type){
		// marie would like to get the following items :
		//$facebook_user_id, $token=NULL (only if we need it later??), $user_type = "owner" or "invited" or "contributor"
//        $query = "INSERT INTO  `Vixen_test`.`login` (`facebook_user_id` ,`user_type` ,`fb_token`)VALUES ( '$facebook_user_id',  '$user_type',  '$token')";                
//       $db->raw_query($query);	
//	}

}
	