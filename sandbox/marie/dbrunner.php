<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
include 'includes/classes/Db.php';
//include 'includes/config.php';


// The following are a series of calls for anything I will ever do. Comptuers are fast, it can just do all of them. kthxbai.


// GetMemorialID
echo "GET MEMORIAL ID - WTF!!";

// -- Just as a sample, let's set our test variable
//$userId = "100005789522071";
//GetMemorialId($userId);

//$selected_memorial_id = '688307710';

// inserts new epilogue user's facebook friends into db
//include 'includes/config.php';
//include 'common_sql.php';
//$facebook_user_id= '688307710';// grace's id'
//$facebook_user_name= 'Grace Pai';
//InsertFriendList($facebook_user_id,$facebook_user_name); 
// GetFooBar
//...

echo "<br>";


// Photo Stuff - does nothing so far
require_once ('includes/classes/Photo.php');
$objPhoto = new Photo("Jack");
$objPhoto->sayHello();

echo "<br>";
// Memorial class - does nothing so far
$epilogue_user_id = "100005789522071";
require_once ('includes/classes/Memorial.php');
$objMem = new Memorial();
$objMem->listMemorialId($epilogue_user_id);


?>