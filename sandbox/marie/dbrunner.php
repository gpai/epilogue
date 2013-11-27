<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
ob_start();
session_start(); 
echo "----- start here run the classes and config ------------<br>";
//Registry::getInstance()->set("config", $config);
require_once ('includes/classes/Database.php');
require_once ('includes/classes/FacebookFriend.php');
require_once ('includes/classes/Memorial.php');
require_once ('includes/classes/Photo.php');
//require_once ('includes/classes/Post.php');
//require_once ('includes/classes/Favorite.php');
require_once ('includes/classes/Login.php');
include 'includes/config.php';
echo "----- the classes look good ------------<br>";
// The following are a series of calls for anything I will ever do. Comptuers are fast, it can just do all of them. kthxbai.


/*
 * facebook calls
 *
 * With a facebook user id... call facebook and pull a nice little array
 * use $epilogue_user_id (owner's facebook_id) OR $deceased_facebook_id OR $facebook_user_id(anyone)
 */






if (Login::isLoggedIn()):
//      $user_id = "688307710"; // Grace
      $user_id = "100005789522071";// Marie (memorial id #1 owner)
      $user_profile = $facebook->api($user_id);
 
else:
     echo ' You are not Connected. Click <a href="login.php">here</a> to login. ';
endif;

echo " ---------- the login to facebok went through fine ----------<br>";



echo "-- MEMORIAL class code ran below --<br>";

// Memorial class - has 2 methods so far... 
// 1 - get all the memorial ids for a user
// 2 - take the user data and auto-dec a new memorial id

//-------------------- stub data
//$epilogue_user_id = "100005789522071";
//$deceased_facebook_user_id = 1066380068; 
//$deceased_name = "Katherine Lowe";
//$death_date = "2013-10-22"; 
//$memorial_tagline = "She rocks";



//$objMem = new Memorial();
//$var_duh = $objMem->listMemorialId($epilogue_user_id);
//print_r(array_values($var_duh));
//$objMem->insertNewMemorial($epilogue_user_id, $deceased_facebook_user_id, $deceased_name, $death_date, $memorial_tagline);

echo "<br>--Memorial class done -----<br>";



echo "<br>-- PHOTO class below --<br>";
// Photo Stuff - get array of photo info back from facebook and then do stuff with the array

// -------------- stub data
//$whosphoto = "688307710"; 
//$whosphoto = "1280040613"; //Nafiri's id
//$photo_id = "0981";
//$vote = 1;
//$memorial_id = 1;

//$objPhoto = new Photo($whosphoto, $memorial_id);

echo "<br>---- download ALL of Nafiri's public photos into my image folder ----<br>";
//$objPhoto->getPhotoArray($whosphoto);
//$objPhoto->deceasedPhotosFromFacebookToFolder($whosphoto);


//$objPhoto->sortPhotos ($array);
//echo "<br>--";
//$objPhoto->upPhotoVote($photo_id, $memorial_id, $vote);

// echo "<br>--";

//$objPhoto->insertFacebookPhotoInfo($array_of, 1);


//echo "---run this to get/download deceased photos into the folder-----------<br>";

//$objPhoto = new Photo($deceased_facebook_user_id);
//$objPhoto->deceasedPhotosFromFacebookToFolder($whosphoto);




echo "---- did it work-----";

?>
<pre><?php print_r($array_of)?> </pre>

<?php

echo "-- Photo class done-----------<br>";






echo "-- FacebookFriends class --<br>";
// FacebookFriends class
//$facebook_user_id = "12345678";
//$facebook_user_name = "Mr. Whiskers";
//$epilogue_user_id = "688307710";
//$objFF = new FacebookFriend();

// --- in order to insert the friend list into our database
//$objFF->insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);
//echo "--FF class done ----<br>";

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

echo "-- FacebookFriends class done --"

?>
