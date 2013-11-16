<?php
/*
 * Created on Nov 16, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include includes/config.php;
require_once ("includes/classes/Db.php");
 
 class Memorial{
 	
 	public function listMemorialId($epilogue_user_id){
 		print "This will return an array of the memorials of this user id : '$epilogue_user_id'";

// ---------- old code to get to Vixen_test -------------
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie');

	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('Vixen_test');
	$query = "SELECT memorial_id, deceased_name, epilogue_user_id FROM memorial_id WHERE epilogue_user_id = '$epilogue_user_id' ";
	$result = mysql_query($query, $link);
	
		
		if(! $result){
			die('Could not get data: ' . mysql_error());
		}

		$resultSet = array();

		while($row = mysql_fetch_assoc($result)){
//			echo "<br>Memorial ID : {$row['memorial_id']} <br> ".
//			 	"Epilogue User ID:  {$row['epilogue_user_id']} <br>".
//			 	"Deceased Name:{$row['deceased_name']} <br>".
//			 	"--------------------------------- <br>";
		 $r = array();
		 $r['memorial_id'] 		= $row['memorial_id'];
		 $r['epilogue_user_id'] = $row['epilogue_user_id'];
		 $r['deceased_name'] = $row['deceased_name'];
		 $resultSet[] = $r;			
 		}
		print_r(array_values($resultSet));

 	}
 }
 
 
?>
