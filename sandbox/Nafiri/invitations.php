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
//User sees invitation on page. (need a list of invitations the person received)
	//need $user_id and a list of memorials where $invited= Y for that person.
$facebookFriends = new FacebookFriend();
$epilogue_user_id = 
$invited="Y";
$memorial_id= $memorial->insertNewMemorial($epilogue_user_id, $deceased_facebook_user_id, $deceased_name, $death_date, $memorial_tagline);
$friendsList= $facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);

//User sees invitation
	//Grace
//Grace: Pop-up (Do you want to collaborate on this memorial? YES/NO)
	
//User accepts invitation->(link up the user_id with memorial_id)
	//Save or change $invited status.
include "invitations.phtml";
?>