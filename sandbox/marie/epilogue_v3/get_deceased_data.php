<?php
require_once "j/includes/config.php";
//require_once "common.php";
// This page gets the data of the deceased from Facebook and INSERTS them in the db


// Need to get from View:
$epilogue_user_id = "/me";
$deceased_facebook_user_id = "688307710";

if (Login::isLoggedIn()): ?>

<h3>The deceased is Grace</h3>

     <?php $user = $facebook->getUser();
     ?>

<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

<h3>Your User Object ($epilogue_user_id = /me)</h3>
<h6>The Epilogue user has these Facebook Friends</h6>

      <?php
global $epilogue_user_id;
global $deceased_facebook_user_id;

      $deceased_user_photo = $facebook->api('/'.$deceased_facebook_user_id.'?fields=photos');
      ?>


<?php else: ?>
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>



<?php

// this is the new stuff to try out
  $facebook_user_id =  1;
  $facebook_user_name = "b";



foreach ($facebook_get["friends"]["data"] as $value)
  {
  global $facebook_user_id;
  global $facebook_user_name;

  $facebook_user_id =  ($value["id"]);
  $facebook_user_name = ($value["name"]);

  echo "$facebook_user_id is the ID for $facebook_user_name<br>";

  }

  echo "<br>";





?>