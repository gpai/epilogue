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
		$listofid = array(1,2);
//		return $listofid;
		print_r(array_values($listofid));
			
		$query = "SELECT memorial_id, deceased_name FROM memorial_id WHERE epilogue_user_id = '$epilogue_user_id' ";
		$result = $Db->query($query);
		
 		print_r(array_values($result));
		print_r(array_values($listofid));		
		if(! $result){
			die('Could not get data: ' . mysql_error());
		}

//		$resultSet = array();
//		print_r(array_values($resultSet));


		while($row = mysql_fetch_assoc($result)){
			echo "<br>Memorial ID : {$row['memorial_id']} <br> ".
			 	"Epilogue User ID:$selected_epilogue_id<br>".
			 	"Deceased Name:{$row['deceased_name']} <br>".
			 	"--------------------------------- <br>";
		 $r = array();
		 $r['memorial_id'] 		= $row['memorial_id'];
		 $r['epilogue_user_id'] = $row['epilogue_user_id'];
		 $r['deceased_name'] = $row['deceased_name'];
		 $resultSet[] = $r;
				
 		}
 	}
 }
 
 
?>
