<?php

require "../includes/config.php";
require_once "../includes/classes/FacebookFriend.php";
require_once "../includes/classes/Registry.php";
//require_once "includes/classes/Database.php";
require_once "../includes/classes/Epilogue.php";
require_once "../includes/classes/Favorite.php";
require_once "../includes/classes/Login.php";
require_once "../includes/classes/Memorial.php";
require_once "../includes/classes/Photo.php";
require_once "../includes/classes/Session.php";
require_once "../includes/classes/User.php";
require_once "../includes/classes/Video.php";


//Getting a list of friends (not just collaborators but their actual friends list)

$facebookFriends = new FacebookFriend();
$epilogue_user_id = "100005789522071";
//Y=sent invitation, N=did not send invitation, A=accepted invitation
$invited = "Y";
$memorial_id="1";
$friendsList= $facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);
var_dump($friendsList);

//Have Marie give me a function to add a new memorial id/space for user. When "Create New" is clicked.
  //to create a new memorial Marie needs: epilogue_user_id, decesed_facebook_user_id, deseased_name
//Will get list of memorials from DB/Marie
$memorial = new Memorial();
$memorialList=$memorial->listMemorialId($epilogue_user_id);
// ); // Replace with call to Marie's code that gives you an array of memorials.


//Need to get list of collaborators for a memorial



// Load the template
include "../Pages/profile.phtml";

?>