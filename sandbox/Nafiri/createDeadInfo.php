<?php
require_once "includes/config.php";
//Needs friends list from Marie
$friends=array(
	60=>array('name'=>"Harry Potter")
);
//User decides on the friend and save the deceased's FB_id and possible other information.
//User inputs the date of death, Grace temporarily saves the input, and I ask Marie to give me an add/insert function so I can add that information into the DB.
//User decides whether or not they want collaborators.
//If yes on collaboration, users will select their friends names from their friend's list.
//When "Continue" is clicked, all information not yet stored in the DB will be stored. (possibly as one packet)

include "createDeadInfo.phtml";
?>