<?php

require_once "includes/config.php";
require_once "includes/classes/FacebookFriend.php";
require_once "includes/classes/Registry.php";


//Getting a list of friends (not just collaborators but their actual friends list)

$facebookFriends = new FacebookFriend();
$epilogue_user_id = "100005789522071";
//Y=sent invitation, N=did not send invitation, A=accepted invitation
$invited = "Y";
$memorial_id="1";
$collabs= $facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);




// function getFriends()
// {
// 	echo "onomatopoeia";
// 	$user = new User();
// 	$user->friends(new friendsList);
// 	echo $friendsList;
// }
// echo "outside";

//Have Marie give me a function to add a new memorial id/space for user. When "Create New" is clicked.

//Will get list of memorials from DB/Marie
// $user=new User();
// echo $first->s_array;

// $memorials = array(
// 	99=>array('name'=>'Bob')
// ); // Replace with call to Marie's code that gives you an array of memorials.


//Need to get list of collaborators for a memorial


// Load the template
include "profile.phtml";

?>