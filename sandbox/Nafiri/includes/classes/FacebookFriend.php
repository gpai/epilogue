<?php
/*
 * Created on Nov 13, 2013
 * Class for the memorial_id table
 *
 */


class FacebookFriend{
	
			
	public function getFriendsFromFacebook($epilogue_user_id){
			// call to facebook for the array of friends of the epilogue owner
			$user = $facebook->getUser();
//     		echo "<h3>Your User Object (".$epilogue_user_id." = /me)</h3>";
//			echo "<h4>The Epilogue user has these Facebook Friends</h4>";
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

	public function insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id) {
	// insert single friend into db table
	$db = Registry::getInstance()->get('db');
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$facebook_user_name', 'N', 0, 0)";	
	$db->raw_query($insert_please);
	}
	
	public function getCollaborators($epilogue_user_id, $status, $memorial_id){
		// returns array of those who have $status of N,Y,A
		// N = facebook friend but not invited, 
		// Y = invited OR (A)ccept invite to collaborate
		$db = Registry::getInstance()->get('db');
		$query = 'SELECT epilogue_user_id, facebook_user_id, facebook_name, invited, deceased FROM user_friend_list WHERE status = "$status" AND memorial_id = "$memorial_id"';		
		$result = $db->fetchAll($query); 
		print_r(array_values($result));
		return $result;	
	}


	public function updateInviteStatus($epilogue_user_id, $invite_this_friend, $status, $memorial_id) {
		// Flags a friend to be invited (Y) or (A)ccept to collaborate -- $status = N, Y or A only --
		$db = Registry::getInstance()->get('db');
		$update_this = "UPDATE `Vixen_test`.`user_friend_list` SET invited = '$status' WHERE facebook_user_id = '$invite_this_friend' AND epilogue_user_id = '$epilogue_user_id' AND memorial_id = '$memorial_id'";
		$db->raw_query($update_this);
	}
	

	
	
	
	
}




?>
