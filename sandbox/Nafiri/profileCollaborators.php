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
require_once "profile.php";

//Need to get a list of friends from Marie of people not yet collaborating on this memorial
$activeCollaborators ="";
$nonCollaborators = "";

$epilogue_user_id = "100005789522071";
//Y=sent invitation, N=did not send invitation, A=accepted invitation
$invited = "A";
$memorial_id="1";
		//Let their name be displayed when user is typing in friend's name to invite
$activeCollaborators = $facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);
		//Leave it out of the list that the user sees
		
$invited !== "A";
$nonCollaborators=$facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);
//sends Facebook invitation.

//Collaborators page will be edited with the new collaborator added onto the list.

print_r($activeCollaborators);

//If the person says no to the invitation, have Grace remove that memorial from their invitation list.

print_r($nonCollaborators);


include "profileCollaborators.phtml";
?> 