<?php

// This is a list of the files I need to include to make things work.
//include 'get_memorial_id.php';
//include 'includes/classes/Db.php';
include 'includes/config.php';


// The following are a series of calls for anything I will ever do. Comptuers are fast, it can just do all of them. kthxbai.


// listMemorialId
echo "GET MEMORIAL ID - WTF!!";
echo "<br>";
// Memorial class - has 1 method so far... it takes the user id and returns an array
// the array looks like this Array ( [0] => Array ( [memorial_id] => 1 [epilogue_user_id] => 100005789522071 [deceased_name] => Grace Pai ) )
$epilogue_user_id = "100005789522071";
require_once ('includes/classes/Memorial.php');
$objMem = new Memorial();
$objMem->listMemorialId($epilogue_user_id);



echo "<br>";


// Photo Stuff - does nothing so far
//require_once ('includes/classes/Photo.php');
//$objPhoto = new Photo("Jack");
//$objPhoto->sayHello();




?>