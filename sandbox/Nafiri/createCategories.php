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
//First, find out from Grace if this page is still going to (display how much information is in each category.
//If that information needs to be shown, ask Marie for a function to get a count of those categories.)<-don't think this is happening


//User makes selections for the memorial.
// Marie decides how she is going to include or exclude data from the Meaning Manager.

//Invitation isn't sent out until AFTER the memorial is made
//Once "Continue" is clicked, all chosen data will go through the meaning.php (meaning manager page).


include "createCategories.phtml";
?>