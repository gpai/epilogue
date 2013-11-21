<?php


require_once "includes/config.php";
require_once 'includes/classes/Login.php';

 
    
    // If not logged in, we need to process them!
    if (!Login::isLoggedIn()) {
    	$loggedIn = false;
    } elseif (Login::isLoggedIn()) {
    	$loggedIn= true;
    }
    $loginUrl = Login::getLoginUrl();
    $logoutUrl = Login::getLogoutUrl();
    
    //Marie obtains their public Facebook information after logging in.
    
include "index.phtml";
   
?>

  
