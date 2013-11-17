<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
//require_once ('includes/classes/Database.php');
//require_once ('includes/classes/FacebookFriend.php');
//require_once ('includes/classes/Memorial.php');
//require_once ('includes/classes/Photo.php');
//include 'includes/config.php';






// The following are a series of calls for anything I will ever do. Comptuers are fast, it can just do all of them. kthxbai.


// listMemorialId
echo "GET MEMORIAL ID - WTF!!";
echo "<br>";
// Memorial class - has 1 method so far... it takes the user id and returns an array
// the array looks like this Array ( [0] => Array ( [memorial_id] => 1 [epilogue_user_id] => 100005789522071 [deceased_name] => Grace Pai ) )
//--------------------
//$epilogue_user_id = "100005789522071";
//$objMem = new Memorial();
//$var_duh = $objMem->listMemorialId($epilogue_user_id);
//print_r(array_values($var_duh));

echo "Photo class";
// Photo Stuff - does nothing so far
//$objPhoto = new Photo("Jack");
//$objPhoto->sayHello();

echo "FacebookFriends class";
// FacebookFriends class
//$facebook_user_id = "12345678";
//$facebook_user_name = "Mr. Whiskers";
//$epilogue_user_id = "100005789522071";
//$objFF = new FacebookFriend();
//$objFF->insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);
//$array_of_friends = $objFF->getFriendsFromFacebook($epilogue_user_id);
//$objFF->insertFriendsIntoDatabase($epilogue_user_id);
//$objFF->insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);
//echo "-------------------------";
//$status = "Y"; // Y = invited, (A)ccepted invite
//$objFF->getCollaborators($epilogue_user_id, $status, $memorial_id);
//$objFF->updateInviteStatus($epilogue_user_id, $invite_this_friend, $status, $memorial_id);


















?>