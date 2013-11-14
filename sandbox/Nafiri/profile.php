<?php
require_once "includes/config.php";

//Will get list of memorials from DB/Marie
$memorials = array(); // Replace with call to Marie's code that gives you an array of memorials.
$memorials[]['id'] = 99;
$memorials[]['name'] = "Bob";

//Need to get list of collaborators for a memorial


// Load the template
include "profile.phtml";
?>