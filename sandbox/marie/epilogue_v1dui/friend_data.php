<?php
require_once "j/includes/config.php";
// This is where the deceased profile data for the memorial site will get pulled and put in the db
// $deceased_facebook_user_id;
// $deceased_name;
// $deceased_dob;
// $deceased_death_date;
// $deceased_profile_picture;
// $deceased_about_me;

$deceased_facebook_user_id = "/688307710"; // Grace's ID
$deceased_death_date = "10/10/2013"; // need to get from view
$birthday = "10/10/1990"; // might not be available null?

if (Login::isLoggedIn()): ?>

<h3>The Deceased User Profile </h3>

<?php
echo "$name and $birthday and $deceased_death_date";
?>
     <?php
      global $deceased_facebook_user_id;
      $user = $facebook->getUser();
      $deceased_user_profile = $facebook->api('$deceased_facebook_user_id');

//        $name = ($deceased_user_profile["name"]);
//  		$birthday = ($deceased_user_profile['birthday']);
      ?>

      <pre><?php print_r($deceased_user_profile); ?></pre>

<?php else: ?>
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>
      <pre><?php print_r($deceased_user_profile); ?></pre>

<?php
print_r(array_values($deceased_user_profile));
echo "--------------------" ?>

<?php

function InsertDeceasedProfile() {
	global $current_database;
  	global $name;
  	global $birthday;
  	global $deceased_facebook_user_id;
  	global $deceased_death_date;
  	global $deceased_user_profile;

	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
		}

	mysql_select_db('Vixen_test');
	$insert_deceased_profile = "INSERT INTO `Vixen_test`.`deceased_profile` VALUES ('$deceased_facebook_user_id', '$name', '$birthday','$deceased_death_date',0,'nope',0,0)";
	mysql_query($insert_deceased_profile, $link);

}

InsertDeceasedProfile();
echo "$bio and $name and $birthday and $deceased_death_date";


?>
