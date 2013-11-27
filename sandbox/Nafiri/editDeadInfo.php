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
//Need information about the deceased. This information should generally be together and saved from the createDeadInfo page.


//Once changes are made and they click save, either rewrite all of the information or just find what's different and change that part.


include "editDeadInfo.phtml";
?>