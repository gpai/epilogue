<?php

require_once "includes/config.php";

// This page gets the list of Friends from the Epilogue user and INSERTS them in the db

// epilogue_user_id = Who is the person who started the project, this is their facebook_id
//	facebook_user_id = Who are the Facebook Friends of the person who started the project
//	facebook_name = Facebook Friend's full name
//	invited	= Have they been invited to the Epilogue project? enum('Y', 'N', 'A')
//	facebook_relationship_flag	= NOT DONE YET = Would be nice to know if they are a sibling, parent, etc of user
//	deceased = 0 not the deceased, 1 is the deceased

// Need to get from View:
$epilogue_user_id = "/me";


// log on to facebook to get the array

if (Login::isLoggedIn()):

	$user = $facebook->getUser();

echo ' <h3>Your User Object ($epilogue_user_id = /me)</h3>';
echo ' <h6>The Epilogue user has these Facebook Friends</h6>';

	$facebook_get = $facebook->api($epilogue_user_id .'?fields=friends');
      
else:
      echo 'You are not Connected. Click <a href="login.php">here</a> to login.';
endif;





mysql_select_db('Vixen_test');

// I want to create an array of the user's friend list
//$friend_list = array($epilogue_user_id, $facebook_user_id, $facebook_user_name );

//$get_friend_list = mysql_query("SELECT epilogue_user_id, facebook_user_id, facebook_name FROM user_friend_list ORDER BY facebook_name");
//while($row = mysql_fetch_array($get_friend_list)){
//    $season=$row['Season'];
//    $seasons[] = $season;
//}

foreach ($facebook_get["friends"]["data"] as $value)
  {
  $facebook_user_id = 1;
  $facebook_user_name = "b";

  $facebook_user_id =  ($value["id"]);
  $facebook_user_name = ($value["name"]);

  echo "$facebook_user_id is the ID for $facebook_user_name<br>";

  InsertFriendList($facebook_user_id,$facebook_user_name);

  }

  echo "<br>";

function InsertFriendList($facebook_user_id,$facebook_user_name) {
	global $epilogue_user_id;
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$facebook_user_name', 'N', 0, 0)";
	mysql_query($insert_please, $link);
}

?>