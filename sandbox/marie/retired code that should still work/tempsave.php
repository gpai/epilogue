<?php

// this is the new stuff to try out
  $facebook_user_id =  1;
  $facebook_user_name = "b";


foreach ($user_profile["friends"]["data"] as $value)
  {
  global $facebook_user_id;
  global $facebook_user_name;

  $facebook_user_id =  ($value["id"]);
  $facebook_user_name = ($value["name"]);
  echo "$facebook_user_id and $facebook_user_name";
  samplepageInsert();

  }

  echo "<br>";

function samplepageInsert() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
     global $facebook_user_id;
     global $facebook_user_name;
     global $user_profile;
     $epilogue_user_id = $user_profile["id"];


	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('Vixen_test');
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$epilogue_user_name', 'N', 0)";

	mysql_query($insert_please, $link);

}



?>

<?php

// this is the new stuff to try out
  $item_id =  1;
  $photo_url = "b";
  $photo_date = '1999-10-21T01:46:06+0000';

foreach ($deceased_user_photo["photos"]["data"] as $value)
  {
  global $item_id;
  global $photo_url;
  global $photo_date;
  global $deceased_facebook_user_id;

  $item_id =  ($value["id"]);
  $photo_url = ($value["source"]);
  $photo_date = ($value['created_time']);
  echo "$item_id and $photo_url and $photo_date";
  PhotoInsert();

  }

  echo "<br>";

function PhotoInsert() {
	global $current_database;
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_firstdb');

  global $item_id;
  global $photo_url;
  global $photo_date;
  global $deceased_facebook_user_id;

	if (!$link) {
		die('Could not connect: ' . mysql_error());
		}

	mysql_select_db('Vixen_firstdb');
	$insert_photo = "INSERT INTO `Vixen_firstdb`.`photo` VALUES ('$item_id', '$photo_url', '$photo_date',0,0,0,0,'$deceased_facebook_user_id')";

	mysql_query($insert_photo, $link);

}



//"INSERT INTO $current_database.`post` VALUES (
//`item_id`,`post_content`,`post_date`,`like`,`share`,`comment_id`,`tagged`,`facebook_user_id`)";

foreach ($user_profile["friends"]["data"] as $value)
  {
  global $facebook_user_id;
  global $facebook_user_name;

  $facebook_user_id =  ($value["id"]);
  $facebook_user_name = ($value["name"]);
  echo "$facebook_user_id and $facebook_user_name";


  }

  echo "<br>";

function samplepageInsert() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
     global $facebook_user_id;
     global $facebook_user_name;
     global $user_profile;
     $epilogue_user_id = $user_profile["id"];


	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('Vixen_test');
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$epilogue_user_name', 'N', '0')";

	mysql_query($insert_please, $link);

}

?>
