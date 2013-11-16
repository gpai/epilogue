<?php
include 'includes/config.php';
// This is for controller to get the list of memorial ids for the epilogue user


function GetMemorialId($selected_epilogue_id){

	$query = "SELECT memorial_id FROM memorial_id WHERE epilogue_user_id = '$selected_epilogue_id' ";
	$result = $Db->query($query);

	if(! $result){
		die('Could not get data: ' . mysql_error());
	}

	$resultSet = array();

	// Populate primary data
	while($row = mysql_fetch_assoc($result)){
		echo "<br>Memorial ID : {$row['memorial_id']} <br> ".
			 "Epilogue User ID:$selected_epilogue_id<br>".
//			 "Deceased Name:{$row['deceased_name']} <br>".
			 "--------------------------------- <br>";
		 $r = array();
		 $r['memorial_id'] 		= $row['memorial_id'];
		 $r['epilogue_user_id'] = $row['epilogue_user_id'];
		 $resultSet[] = $r; // Same as: array_push($r, $resultSet);
	}

	// Go on secondary data
//	foreach ($resultSet as $key => $result) {
		//	$SQL1 = "SELECT deceased_name FROM deceased_profile WHERE memorial_id = '$selected_memorial_id'" ;
		//	$result1 = mysql_query($SQL1, $link);

		// Run this query
		// Fetch the result and assign it to $value

//		$resultSet[$key]['deceased_name'] = "TBD"; //$value

//	}
	vardump($resultSet);
	return $resultSet;

?>