<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
//include 'includes/classes/Database.php';
include 'includes/config.php';


// The following are a series of calls for anything I will ever do. Comptuers are fast, it can just do all of them. kthxbai.


// listMemorialId
echo "GET MEMORIAL ID - WTF!!";
echo "<br>";
// Memorial class - has 1 method so far... it takes the user id and returns an array
// the array looks like this Array ( [0] => Array ( [memorial_id] => 1 [epilogue_user_id] => 100005789522071 [deceased_name] => Grace Pai ) )
//--------------------
//$epilogue_user_id = "100005789522071";
//require_once ('includes/classes/Memorial.php');
//$objMem = new Memorial();
//$var_duh = $objMem->listMemorialId($epilogue_user_id);
//print_r(array_values($var_duh));


// Photo Stuff - does nothing so far
//require_once ('includes/classes/Photo.php');
//$objPhoto = new Photo("Jack");
//$objPhoto->sayHello();

echo "FacebookFriends class";
// FacebookFriends class
require_once ('includes/classes/FacebookFriend.php');
//$facebook_user_id = "12345678";
//$facebook_user_name = "Mr. Whiskers";
$epilogue_user_id = "100005789522071";
$objFF = new FacebookFriend();
//$objFF->insertFriendList($facebook_user_id, $facebook_user_name, $epilogue_user_id);
echo "-------------------------";
$objFF->getCollaborators($epilogue_user_id);


?>