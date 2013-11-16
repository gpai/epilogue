<?php
require_once "includes/config.php";

//Need to get a list of friends from Marie
$friends=array(
	88=>array('name'=>"Ash"),
	15=>array('name'=>"Misty")
);

var_dump($friends);
//$friends = array("Misty","Brock");


//Need to get a list of collaborators on the project
$collab=array(
	15=>array('name'=>"Misty"),
	90=>array('name'=>"Brock")
);
var_dump($collab);
//$collab=array("Ash","Misty");



//list of whether or not friends are already collaborators.
foreach($friends as $fid => $fname)
{
	foreach($collab as $cid=> $cname)
	{
		if($fid!==$cid & $fname!==$cname)
		{
			echo $fid;
			echo $cid;
			echo "not the same, ";
			
		}
		else
		{
			echo $fid;
			echo $cid;
			echo "same, ";
			
		}
	}
}

// for($i=0;$i<count($friends);++$i)
// {
// 	for($n=0;$n<count($collab);++$n)
// 	{
// 		if($friends[$i]!==$collab[$n])
// 		{
// 			echo "hi";
// 			//include in the list of people that can be invited
// 		}
// 		else
// 		{
// 			echo"ho";
// 			//do not include in list.
// 		}
// 	}
// }

//sends Facebook invitation.

//Collaborators page will be edited with the new collaborator added onto the list.

//If the person says no to the invitation, have Grace remove that memorial from their invitation list.


//var_dump($friends);
include "profileCollaborators.phtml";
?> 