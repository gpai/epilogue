<?php
/*
 * Created on Nov 15, 2013
 *
 * With a facebook user id... call facebook and pull a nice little array
 * use $epilogue_user_id (owner's facebook_id) OR $deceased_facebook_id OR $facebook_user_id(anyone)
 */

require_once ("includes/classes/Photo.php");

$objPhoto = new Photo("June");
$objPhoto->sayHello();

//$objPhoto->setName(123);


?>
