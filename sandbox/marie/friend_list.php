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


$resultSet = array();
mysql_select_db('Vixen_test');

foreach ($facebook_get["friends"]["data"] as $value)
  {
  $facebook_user_id = 1;
  $facebook_user_name = "b";

  $facebook_user_id =  ($value["id"]);
  $facebook_user_name = ($value["name"]);

  echo "$facebook_user_id is the ID for $facebook_user_name<br>";

  //InsertFriendList($facebook_user_id,$facebook_user_name);

  }


      
else:
      echo 'You are not Connected. Click <a href="login.php">here</a> to login.';
endif;




?>