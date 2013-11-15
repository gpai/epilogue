<?php

require_once "j/includes/config.php";

?>
<!doctype html>
<html>
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>

<?php

    // If not logged in, we need to process them!
    if (!Login::isLoggedIn()) {
    	echo 	'<a href="'. Login::getLoginUrl() .'"><button class="btn btn-primary btn-large"><i class="icon-facebook"></i>Login with Facebook</button></a>';
    } elseif (Login::isLoggedIn()) {
    	echo '<a href="'. Login::getLogoutUrl() .'">Logout</a>';
    }

?>


  </body>
</html>