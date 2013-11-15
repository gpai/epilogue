<?php
require_once "includes/config.php";
//require_once "common.php";

if (Login::isLoggedIn()): ?>

<h3>You</h3>

     <?php $user = $facebook->getUser();
     ?>

<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

<h3>Your User Object (/me)</h3>

      <?php

      $fb_user_id = "/me";
      $user_profile = $facebook->api($fb_user_id .'?fields=friends');
      ?>
      <pre><?php print_r($user_profile); ?></pre>

<?php else: ?>
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>

<?php
print_r(array_values($user_profile));
echo "--------------------" ?>



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
'$epilogue_user_id',  '$facebook_user_id', '$epilogue_user_name', 'N', '0')";

	mysql_query($insert_please, $link);

}



?>