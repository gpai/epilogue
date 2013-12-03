<?php

require "includes/config.php";
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

/**
 * Get Epilogue User ID
 */
// Get user's eID.
// $epilogue_user_id = "100005789522071";
$epilogue_user_id = $epilogue->id;

/**
 * Get Facebook Friends
 */
//Getting a list of friends (not just collaborators but their actual friends list)
// $facebookFriends = new FacebookFriend();

// This doesn't exist yet -- but it should.
// $ff = $facebookFriends->getFriends();

/**
 * Get list of memorials that user is connected to, if any
 */
$memorial = new Memorial();
$memorialList = $memorial->listMemorialId($epilogue_user_id);

/**
 * For each memorial, get collaborators
 */
foreach ($memorialList as $key => $value) {
	$friendsList = $facebookFriends->getCollaborators($epilogue_user_id, $invited, $value['id']); // $value['id'] might not work, it depends on where the memorial id is.
	$memorialList[$key]['collaborators'] = $friendList;
}



// $login = new Login();

//$epilogue_user_id = $login[$user];
// echo $epilogue_user_id;
//Y=sent invitation, N=did not send invitation, A=accepted invitation
// $invited = "Y";
// $memorial_id= $memorial->insertNewMemorial($epilogue_user_id, $deceased_facebook_user_id, $deceased_name, $death_date, $memorial_tagline);

// $friendsList= $facebookFriends->getCollaborators($epilogue_user_id, $invited, $memorial_id);
//var_dump($friendsList);

//Have Marie give me a function to add a new memorial id/space for user. When "Create New" is clicked.
  //to create a new memorial Marie needs: epilogue_user_id, decesed_facebook_user_id, deseased_name
//Will get list of memorials from DB/Marie
// $memorial = new Memorial();
// $memorialList = $memorial->listMemorialId($epilogue_user_id);

//the call above gives back the memorial id, the deceased name as a string, and epilogue user id. This will be for every memorial that the user has.
// Replace with call to Marie's code that gives you an array of memorials.


//Need to get list of collaborators for a memorial



// Load the template
include "pages/profile.phtml";

?>