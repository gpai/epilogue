<?php
require_once "includes/config.php";
require_once "includes/classes/FacebookFriend.php";
require_once "includes/classes/Registry.php";
require_once "includes/classes/Database.php";
require_once "includes/classes/Epilogue.php";
require_once "includes/classes/Favorite.php";
require_once "includes/classes/Login.php";
require_once "includes/classes/Memorial.php";
require_once "includes/classes/Photo.php";
require_once "includes/classes/Session.php";
require_once "includes/classes/User.php";
require_once "includes/classes/Video.php";

// Cut the link
// Replace with some function that Marie gives us.
// She says that she needs the following data:
// - Memorial id
// - User id


//Needs a list of collaborators based on the memorial id. (get list from Marie)

$facebookFriends = new FacebookFriend();
$epilogue_user_id = "100005789522071";
//Y=sent invitation, N=did not send invitation, A=accepted invitation
$invited = "A";
$memorial_id="1";
$friendsList= $facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);

echo "Only debug code should be echoed in a controller.";
echo "My memorial ID is: ".$_GET['memorial_id'];
echo "My user id is: ";

var_dump($_GET);

include "discard.phtml";
?>

