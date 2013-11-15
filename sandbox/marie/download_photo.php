<?php
/*
 * Created on Nov 15, 2013
 *
 * Here is an attempt to download photos from the deceased's facebook account (urls) and 
 * store them on the server
 *duidesign.com/working/images/deceased
 */
?>


<?php

$deceased_facebook_user_id = "688307710";

$filenameIn  = $_POST['text'];
$filenameOut = __DIR__ . '/images/' . basename($_POST['text']);

$contentOrFalseOnFailure   = file_get_contents($filenameIn);
$byteCountOrFalseOnFailure = file_put_contents($filenameOut, $contentOrFalseOnFailure);



// this is the new stuff to try out
  $facebook_user_id =  1;
  $facebook_user_name = "b";

// I want to create an array of the user's friend list
//$friend_list = array($epilogue_user_id, $facebook_user_id, $facebook_user_name );

//$get_friend_list = mysql_query("SELECT epilogue_user_id, facebook_user_id, facebook_name FROM user_friend_list ORDER BY facebook_name");
//while($row = mysql_fetch_array($get_friend_list)){
//    $season=$row['Season'];
//    $seasons[] = $season;
//}

<?php
include includes/config.php;


function getDeceasedPhotos($user_id){
	if (Login::isLoggedIn()):
	$user = $facebook->getUser();
	$facebook_get_photo = array();

	echo '<h3>Your User Object ($some_user_id = /user_id/photos)<h3>'

	$facebook_get_photo = $facebook->api($user_id .'/photos');
	
	vardump($facebook_get_photo);

	return $facebook_get_photo;
 
else:
      echo 'You are not Connected. Click <a href="login.php">here</a> to login.';
	
	
}

getDeceasedPhotos(688307710);

endif ?>


<?php
foreach ($facebook_get["friends"]["data"] as $value)
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
?>