<?php
require_once "j/includes/config.php";
//require_once "common.php";
// This is on hold until we hear from Nafiri : )


// This page updates the list of Friends selected by the Epilogue user with a Y if they are invited

// epilogue_user_id = Who is the person who started the project, this is their facebook_id
//	facebook_user_id = Who are the Facebook Friends of the person who started the project
//	facebook_name = Facebook Friend's full name
//	INVITED	= Have they been invited to the Epilogue project? enum('Y', 'N', 'A')
//	facebook_relationship_flag	= NOT DONE YET = Would be nice to know if they are a sibling, parent, etc of user
//	deceased = 0 not the deceased, 1 is the deceased

// Need to get from View:
$epilogue_user_id = "100005789522071"; // Marie's id
$invite_this_friend = "615155884"; // Nithin's id
UpdateInviteStatus();


if (Login::isLoggedIn()): ?>

<h3>You</h3>

     <?php $user = $facebook->getUser();
     ?>

<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

<h3>Your User Object ($epilogue_user_id = /me)</h3>



<?php else: ?>
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>



<?php


function UpdateInviteStatus() {
	global $epilogue_user_id;
	global $invite_this_friend;

	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');

	//test to see connection of database
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// select Vixen_test database
	mysql_select_db('Vixen_test');

	// chose the table and then update some of  fields in it

	$update_this = "UPDATE `Vixen_test`.`user_friend_list` SET invited = 'Y' WHERE facebook_user_id = '$invite_this_friend' AND epilogue_user_id = '$epilogue_user_id'";
	mysql_query($update_this, $link);


}




?>
