<?php
/*
 * Created on Nov 15, 2013
 *
 * With a facebook user id... call facebook and pull a nice little array
 * use $epilogue_user_id (owner's facebook_id) OR $deceased_facebook_id OR $facebook_user_id(anyone)
 */
?>

<?php
include includes/config.php;


function getDeceasedPhotos($user_id){
	if (Login::isLoggedIn()):
	$user = $facebook->getUser();
	$facebook_get_photo = array();

	echo '<h3>Your User Object ($some_user_id = /user_id/photos)<h3>'

	$facebook_get_photo = $facebook->api($user_id .'/photos');
	
	vardump($facebook_get_photo);

	return $facebook_get_photo;
 
else:
      echo 'You are not Connected. Click <a href="login.php">here</a> to login.';
	
	
}

endif ?>
