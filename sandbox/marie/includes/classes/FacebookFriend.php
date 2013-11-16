<?php
/*
 * Created on Nov 13, 2013
 * Class for the memorial_id table
 *
 */

//require_once "dbrunner.php"

class FacebookFriend
	{
	public function getFriendsFromFacebook()
		{
			$epilogue_user_id = "/me";
			$user = $facebook->getUser();

     		echo "<h3>Your User Object (".$epilogue_user_id." = /me)</h3>";
			echo "<h6>The Epilogue user has these Facebook Friends</h6>";

      		$facebook_get_friends = $facebook->api($epilogue_user_id .'?fields=friends');

			return $facebook_get_friends;

		}
	public function insertFriendsIntoDatabase()
		{
			foreach ($facebook_get_friends["friends"]["data"] as $value)
  				{
  				global $facebook_user_id;
  				global $facebook_user_name;

  				$facebook_user_id =  ($value["id"]);
  				$facebook_user_name = ($value["name"]);

  				echo "$facebook_user_id is the ID for $facebook_user_name<br>";

  				InsertFriendList();

  				}

  			echo "<br>";

function InsertFriendList() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
     global $facebook_user_id;
     global $facebook_user_name;
     global $facebook_get;
     $epilogue_user_id = $facebook_get["id"];


	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('Vixen_test');
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$facebook_user_name', 'N', 0, 0)";

	mysql_query($insert_please, $link);

}

		}


	}

$m = new Memorial;

var_dump($m);


?>
