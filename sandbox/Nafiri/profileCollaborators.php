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
foreach($friendsList[$memorial_id]===1)
{
	if($friendsList[$invited]!=="A")
	{
		//Let their name be displayed when user is typing in friend's name to invite
	}
	else {
		//Leave it out of the list that the user sees
	}
}
//sends Facebook invitation.

//Collaborators page will be edited with the new collaborator added onto the list.

print_r($activeCollaborators);

//If the person says no to the invitation, have Grace remove that memorial from their invitation list.

print_r($nonCollaborators);


include "profileCollaborators.phtml";
?> 