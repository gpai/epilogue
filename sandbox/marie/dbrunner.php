<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
 
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


$fb_user_id = "688307710";

if (Login::isLoggedIn()):
      $user_id = "688307710"; // Grace
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
//$objMem = new Memorial();
//$var_duh = $objMem->listMemorialId($epilogue_user_id);
//print_r(array_values($var_duh));
echo "Photo class";
// Photo Stuff - does nothing so far
//$whosphoto = "688307710"; 
//$photo_id = "0981";
//$vote = 1;
//$memorial_id = 1;
//$objPhoto = new Photo($whosphoto);
//$photo_vote = $objPhoto->getPhotoVote($photo_id, $memorial_id);
echo "<br>";
//$objPhoto->upPhotoVote($photo_id, $memorial_id, $vote);
//$objPhoto->getPhotos($whosphoto);
echo "<br>";
$objPhoto = new Photo($epilogue_user_id);
echo "-----------------<br>";
//$array_of = $objPhoto->getFavorites($fb_user_id); 
$photo_url = "https://scontent-b.xx.fbcdn.net/hphotos-prn2/s720x720/8667_10151501514847711_269651373_n.jpg";
$objPhoto->downloadDeceasedPhotos($photo_url);

echo "where is the damn photo";

//print_r ($array_of) ?
//$result = $objPhoto->displayPhotos($array_of_photos["data"], $indent='');
//echo $result;

echo "FacebookFriends class";
// FacebookFriends class
//$facebook_user_id = "12345678";
//$facebook_user_name = "Mr. Whiskers";
//$epilogue_user_id = "688307710";
$objFF = new FacebookFriend();

// --- in order to insert the friend list into our database
//$objFF->insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);
echo "------what is the dealio";

//print_r($array_of_friends);

//$objFF->insertFriendsIntoDatabase($epilogue_user_id);

echo "<br>";
echo "-------------------------";
$invite = "N"; // Y = invited, (A)ccepted invite
$memorial_id = "1";
$array_of_peeps = $objFF->getCollaborators($epilogue_user_id, $invite, $memorial_id);
print_r($array_of_peeps);

//$objFF->updateInviteStatus($epilogue_user_id, $invite_this_friend, $sivite, $memorial_id);
echo "--- <br>";



?>
