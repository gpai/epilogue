<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
ob_start();
session_start(); 
echo "-----start here------------<br>";
//Registry::getInstance()->set("config", $config);
require_once ('includes/classes/Database.php');
require_once ('includes/classes/FacebookFriend.php');

require_once ('includes/classes/Memorial.php');
require_once ('includes/classes/Photo.php');
//require_once ('includes/classes/Post.php');
//require_once ('includes/classes/Favorite.php');
require_once ('includes/classes/Login.php');
include 'includes/config.php';

// The following are a series of calls for anything I will ever do. Comptuers are fast, it can just do all of them. kthxbai.


/*
 * facebook calls
 *
 * With a facebook user id... call facebook and pull a nice little array
 * use $epilogue_user_id (owner's facebook_id) OR $deceased_facebook_id OR $facebook_user_id(anyone)
 */


echo "-----start here    2 ------------<br>";



if (Login::isLoggedIn()):
//      $user_id = "688307710"; // Grace
      $user_id = "100005789522071";// Marie (memorial id #1 owner)
      $user_profile = $facebook->api($user_id);
 
else:
     echo ' You are not Connected. Click <a href="login.php">here</a> to login. ';
endif;


// listMemorialId
echo "GET MEMORIAL ID - WTF!!";
echo "<br>";
// Memorial class - has 1 method so far... it takes the user id and returns an array
// the array looks like this Array ( [0] => Array ( [memorial_id] => 1 [epilogue_user_id] => 100005789522071 [deceased_name] => Grace Pai ) )
//--------------------
$epilogue_user_id = "100005789522071";
$deceased_facebook_user_id = 1066380068; 
$deceased_name = "Katherine Lowe";
$death_date = "2013-10-22"; 
$memorial_tagline = "She rocks";
$objMem = new Memorial();
//$var_duh = $objMem->listMemorialId($epilogue_user_id);
//print_r(array_values($var_duh));
$objMem->insertNewMemorial($epilogue_user_id, $deceased_facebook_user_id, $deceased_name, $death_date, $memorial_tagline);

echo "------new memorial created?-???-----";



echo "Photo class";
// Photo Stuff - does nothing so far
//$whosphoto = "688307710"; 
//$photo_id = "0981";
//$vote = 1;
//$memorial_id = 1;
//$objPhoto = new Photo($whosphoto);
//$objPhoto->getPhotos($whosphoto);


















//$objPhoto->sortPhotos ($array);
echo "did it work??????";


echo "<br>--";
//$objPhoto->upPhotoVote($photo_id, $memorial_id, $vote);
//$objPhoto->getPhotos($whosphoto);
echo "<br>--";


echo "---run this to get/download deceased photos into the folder-----------<br>";
//$photo_url = "https://scontent-b.xx.fbcdn.net/hphotos-prn2/s720x720/8667_10151501514847711_269651373_n.jpg";
//$objPhoto->downloadDeceasedPhotos($photo_url);
//$deceased_facebook_user_id = "688307710";
//$objPhoto = new Photo($deceased_facebook_user_id);
//$objPhoto->deceasedPhotosFromFacebookToFolder($deceased_facebook_user_id);

echo "--------------";



echo "FacebookFriends class";
// FacebookFriends class
//$facebook_user_id = "12345678";
//$facebook_user_name = "Mr. Whiskers";
//$epilogue_user_id = "688307710";
//$objFF = new FacebookFriend();

// --- in order to insert the friend list into our database
//$objFF->insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);
echo "------";

//print_r($array_of_friends);

//$objFF->insertFriendsIntoDatabase($epilogue_user_id);

//echo "<br>";
//echo "-------run to get list of collaborators for memorial id #1------------";
//$invite = "N"; // Y = invited, (A)ccepted invite
//$memorial_id = "1";
//$array_of_peeps = $objFF->getCollaborators($epilogue_user_id, $invite, $memorial_id);
//print_r($array_of_peeps);

// echo "--- run to change the invite status"
//$objFF->updateInviteStatus($epilogue_user_id, $invite_this_friend, $invite, $memorial_id);
//echo "--- <br>";



?>
