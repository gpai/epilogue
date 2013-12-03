<?php


require_once "../includes/config.php";
require_once "../includes/classes/Login.php";
require_once "../includes/classes/FacebookFriend.php";
require_once "../includes/classes/Registry.php";
require_once "../includes/classes/Database.php";
require_once "../includes/classes/Epilogue.php";
require_once "../includes/classes/Favorite.php";
require_once "../includes/classes/Memorial.php";
require_once "../includes/classes/Photo.php";
require_once "../includes/classes/Session.php";
require_once "../includes/classes/User.php";
require_once "../includes/classes/Video.php";

 
    
    // If not logged in, we need to process them!
    if (!Login::isLoggedIn()) {
    	$loggedIn = false;
    } elseif (Login::isLoggedIn()) {
    	$loggedIn= true;
    }
    $loginUrl = Login::getLoginUrl();
    $logoutUrl = Login::getLogoutUrl();
    
    //Marie obtains their public Facebook information after logging in.
    
include "../Pages/index.phtml";
   
?>

  
