<?php
/*
 * Created on Nov 15, 2013
 *
 * With a facebook user id... call facebook and pull a nice little array
 * use $epilogue_user_id (owner's facebook_id) OR $deceased_facebook_id OR $facebook_user_id(anyone)
 */
 
echo "-----start here------------<br>";
//Registry::getInstance()->set("config", $config);
require_once ('includes/classes/Database.php');
require_once ('includes/classes/FacebookFriend.php');
require_once ('includes/classes/Memorial.php');
require_once ('includes/classes/Photo.php');
include 'includes/config.php';
require_once ("includes/classes/Photo.php");
echo "-----start here    1 ------------<br>";


$fb_user_id = "688307710";

if (Login::isLoggedIn()):

// Photo Stuff - does nothing so far

$objPhoto = new Photo($fb_user_id);
echo "-----------------<br>";
$array_of_photos = $objPhoto->getPhotos($fb_user_id); 

$objPhoto->sortPhotos($array_of_photos);

?>
<pre><?php print_r ($array_of_photos["data"]) ?> </pre>;

<?php


//foreach ($array_of_photos["data"] as $key => $value){
//	print "key --- $key and value --- $value";	
//}

//$result = $objPhoto->displayPhotos($array_of_photos["data"], $indent='');
//echo $result;

echo "----2------------<br>";

 
else:
     echo ' You are not Connected. Click <a href="login.php">here</a> to login. ';
endif

?>
