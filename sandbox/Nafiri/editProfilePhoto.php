<?php
require_once "includes/config.php";
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
//Needs a list of all of the deceased's public pictures from Facebook (Get from Marie).

//Log into FB
if (!Login::isLoggedIn()) {
	$loggedIn = false;
} elseif (Login::isLoggedIn()) {
	$loggedIn= true;
}
$loginUrl = Login::getLoginUrl();
$logoutUrl = Login::getLogoutUrl();


$photos = new Photo();
//Grace's user id
$user_id = "688307710";

$photos->deceasedPhotosFromFacebookToFolder($user_id);
//$photoLibrary = $photos->getPhotos($user_id);
//If they want to upload on their own, get a function from Marie that allows for this image file to be inserted into the database where the rest of the pictures are.

include "editProfilePhoto.phtml";
?>