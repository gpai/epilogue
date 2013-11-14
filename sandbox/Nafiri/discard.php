<?php
require_once "includes/config.php";

// Cut the link
// Replace with some function that Marie gives us.
// She says that she needs the following data:
// - Memorial id
// - User id

echo "Only debug code should be echoed in a controller.";
echo "My memorial ID is: ".$_GET['memorial_id'];
echo "My user id is: ";

//var_dump($_GET);

include "discard.phtml";
?>