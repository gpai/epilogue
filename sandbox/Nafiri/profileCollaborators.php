<?php
require_once "includes/config.php";

//Need to get a list of friends from Marie
$friends = array("Misty","Brock");
// $friends[]['id']=56;
// $friends[]['name']="Misty";

//Need to get a list of collaborators on the project

$collab=array("Ash","Misty");
// $collab[]['id']=88;
// $collab[]['name']="Ash";
// $collab[]['id']=56;
// $collab[]['name']="Misty";



//list of whether or not friends are already collaborators.
for($i=0;$i<count($friends);++$i)
{
	for($n=0;$n<count($collab);++$n)
	{
		if($friends[$i]!==$collab[$n])
		{
			echo "hi";
			//include in the list of people that can be invited
		}
		else
		{
			echo"ho";
			//do not include in list.
		}
	}
}

//sends Facebook invitation.

//Collaborators page will be edited with the new collaborator added onto the list.


//var_dump($friends);
include "profileCollaborators.phtml";
?> 