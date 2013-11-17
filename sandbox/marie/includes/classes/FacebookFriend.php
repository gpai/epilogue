<?php
/*
 * Created on Nov 13, 2013
 * Class for the memorial_id table
 *
 */



class FacebookFriend{
		
	public function getFriendsFromFacebook($epilogue_user_id){
			$user = $facebook->getUser();
     		echo "<h3>Your User Object (".$epilogue_user_id." = /me)</h3>";
			echo "<h4>The Epilogue user has these Facebook Friends</h4>";
      		$facebook_get_friends = $facebook->api($epilogue_user_id .'?fields=friends');
			return $facebook_get_friends;
	}
		
	public function insertFriendsIntoDatabase($epilogue_user_id){
			$facebook_get_friends = getFriendsFromFacebook($epilogue_user_id);
			foreach ($facebook_get_friends["friends"]["data"] as $value){
  				$facebook_user_id =  ($value["id"]);
  				$facebook_user_name = ($value["name"]);
  				echo "$facebook_user_id is the ID for $facebook_user_name<br>";

  				insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);

  				}

	}

function insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id) {
	$db = Registry::getInstance()->get('db');	
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$facebook_user_name', 'N', 0, 0)";	
	$db->raw_query($insert_please);
	return;
}




}




?>
