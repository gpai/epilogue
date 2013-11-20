<?php
require_once "includes/config.php";

if (Login::isLoggedIn()):

echo "<h3>Sample Page<h3>";

	$user = $facebook->getUser();
     

//<img src="https://graph.facebook.com/picture">

//      $fb_user_id = "/me";
      $user_id = "688307710"; // Grace
      $user_profile = $facebook->api($fb_user_id .'/photo');
    
    //  <pre><?php print_r($user_profile)? ></pre>

else:
     echo '  You are not Connected. Click <a href="login.php">here</a> to login.';
endif

print_r(array_values($user_profile));


echo "--------------------" 





?>