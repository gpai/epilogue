<?php
require_once "includes/config.php";
include("Sessions.php");


//var_dump($_COOKIE);

//Get session time from Session.php from Marie
//Calculate how many days are left in the session.
//Have Grace display the session.
include "finalizeDaysLeft.phtml";
?>