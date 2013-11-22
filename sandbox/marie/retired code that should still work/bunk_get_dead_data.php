<?php
// Get the Facebook data of the deceased
// The Epilogue user gets to pick which types of data to copy down
// Photo, Post, Note, Video, Favorite
require_once "j/includes/config.php";

$deceased_facebook_user_id = "688307710";

function GetDeceasedProfile(){
	echo "GetDeceasedProfile";
	global $deceased_facebook_user_id;

	$deceased_facebook_user_id_with_slash = "\688307710";
	$deceased_profile = $facebook->api($deceased_facebook_user_id_with_slash . '?fields=name,birthday,bio,picture');
}

GetDeceasedProfile();
?>

<pre><?php print_r($deceased_profile); ?></pre>

<?php
function GetDeceasedPhoto(){
	echo "GetDeceasedPhoto";
}

function GetDeceasedPost(){
	echo "GetDeceasedPost";
}

function GetDeceasedNote(){
	echo "GetDeceasedNote";
}

function GetDeceasedVideo(){
	echo "GetDeceasedPhoto";
}

function GetDeceasedFavorite(){
	echo "GetDeceasedFavorite";
}

?>
<?php
require_once "j/includes/config.php";
//require_once "common.php";
$deceased_facebook_user_id = "/688307710";
$deceased_death_date = "provided by user";


if (Login::isLoggedIn()): ?>

     <?php $user = $facebook->getUser();
     ?>

<?php
global $deceased_facebook_user_id;
$deceased_user_profile = $facebook->api("/688307710");
?>
      <pre><?php print_r($deceased_user_profile); ?></pre>

<?php else: ?>
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>

<?php
print_r(array_values($deceased_user_profile));
echo "--------------------" ?>





<?php

  $bio =  "blah";
  $name = "b";
  $birthday = "10/10/1990";
  global $deceased_user_profile;

foreach ($deceased_user_profile as $value)
  {
  global $bio;
  global $name;
  global $birthday;
  global $deceased_facebook_user_id;

  $bio =  ($value["bio"]);
  $name = ($value["name"]);
  $birthday = ($value['birthday']);
  echo "$bio and $name and $birthday";
  InsertDeceasedProfile();

  }

  echo "<br>";

function InsertDeceasedProfile() {
	global $current_database;
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_firstdb');

  global $bio;
  global $name;
  global $birthday;
  global $deceased_facebook_user_id;
  global $deceased_death_date;

	if (!$link) {
		die('Could not connect: ' . mysql_error());
		}

	mysql_select_db('Vixen_firstdb');
	$insert_deceased_profile = "INSERT INTO `Vixen_firstdb`.`deceased_profile` VALUES ('$deceased_facebook_user_id', '$name', '$birthday','$deceased_death_date',0,$bio,0,0)";

	mysql_query($insert_deceased_profile, $link);

}



?>




<?php
require_once "j/includes/config.php";
require_once "common.php";
$deceased_facebook_user_id = "/688307710";
$deceased_death_date = "provided by user";


if (Login::isLoggedIn()): ?>

     <?php $user = $facebook->getUser();
     ?>

<?php
global $deceased_facebook_user_id;
$deceased_user_profile = $facebook->api($deceased_facebook_user_id.'?fields=name,birthday,bio,picture');
?>
      <pre><?php print_r($deceased_user_profile); ?></pre>

<?php else: ?>
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>

<?php
print_r(array_values($deceased_user_profile));
echo "--------------------" ?>





<?php

  $bio =  "blah";
  $name = "b";
  $birthday = "10/10/1990";
  global $deceased_user_profile;

foreach ($deceased_user_profile as $value)
  {
  global $bio;
  global $name;
  global $birthday;
  global $deceased_facebook_user_id;

  $bio =  ($value["bio"]);
  $name = ($value["name"]);
  $birthday = ($value['birthday']);
  echo "$bio and $name and $birthday";
  InsertDeceasedProfile();

  }

  echo "<br>";

function InsertDeceasedProfile() {
	global $current_database;
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');

  global $bio;
  global $name;
  global $birthday;
  global $deceased_facebook_user_id;
  global $deceased_death_date;

	if (!$link) {
		die('Could not connect: ' . mysql_error());
		}

	mysql_select_db('Vixen_test');
	$insert_deceased_profile = "INSERT INTO `Vixen_test`.`deceased_profile` VALUES ('$deceased_facebook_user_id', '$name', '$birthday','$deceased_death_date',0,$bio,0,0)";

	mysql_query($insert_deceased_profile, $link);

}



?>