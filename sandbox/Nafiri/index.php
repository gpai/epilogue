<?php


require_once "includes/config.php";

 
    
    // If not logged in, we need to process them!
    if (!Login::isLoggedIn()) {
    	$loggedIn = false;
    } elseif (Login::isLoggedIn()) {
    	$loggedIn= true;
    }
    $loginUrl = Login::getLoginUrl();
    $logoutUrl = Login::getLogoutUrl();
    
include "index.phtml";
    
?>

  
