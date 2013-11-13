<?php
require_once "includes/config.php";

//Need to get a list of friends.
$friends = array();
$friends[]["id"]=56;
$friends[]["name"]="Misty";
//echo "Friends: ".$friend["id"].", ".$friend[]["name"];

//list of whether or not friends are already collaborators.


//var_dump($friends);
include "profileCollaborators.phtml";
?>