<?php
require_once "includes/config.php";
//First, find out from Grace if this page is still going to display how much information is in each category.
//If that information needs to be shown, ask Marie for a function to get a count of those categories.
//User makes selections for themselves and other collaborators.
// Marie decides how she is going to include or exclude data from the Meaning Manager.
//Once "Continue" is clicked, all chosen data will go through the meaning.php (meaning manager page).


include "createCategories.phtml";
?>