<?php

require_once "includes/config.php";
    
    // If not logged in, we need to process them!
    if (!Login::isLoggedIn()) {
    	echo 	'<a href="'. Login::getLoginUrl() .'"><button class="btn btn-primary btn-large"><i class="icon-facebook"></i>Login with Facebook</button></a>';
    } elseif (Login::isLoggedIn()) {
    	echo '<a href="'. Login::getLogoutUrl() .'">Logout</a>';
    }
    
?>
