<?php
require_once "includes/config.php";

//Have Marie give me a function to add a new memorial id/space for user. When "Create New" is clicked.

//Will get list of memorials from DB/Marie
$memorials = array(
	99=>array('name'=>'Bob')
); // Replace with call to Marie's code that gives you an array of memorials.


//Need to get list of collaborators for a memorial


// Load the template
include "profile.phtml";
?>