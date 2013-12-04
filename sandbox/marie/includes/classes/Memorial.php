<?php
/*
 * Created on Nov 16, 2013 
 * This class handles the 'creation' of a new memorial id
 */

class Memorial {

	
	public function listMemorialId($epilogue_user_id) {
		// JED: First things first, let's get some objects!
		$db = Registry::getInstance()->get('db');
		// End Jed	
		// print "This returns an array of the memorials of this user id : '$epilogue_user_id'";
		
		$query = "SELECT memorial_id, deceased_name, epilogue_user_id FROM memorial_id WHERE epilogue_user_id = '$epilogue_user_id' ";
		$result = $db->fetchAll($query); 
		return $result;
 	}
 	
 	


 	public function insertNewMemorial($epilogue_user_id, $deceased_facebook_user_id, $deceased_name, $death_date, $memorial_tagline){
 		// takes the user provided data and returns a newly created memorial id
 		$db = Registry::getInstance()->get('db');
 		$query = "INSERT INTO `Vixen_test`.`memorial_id` (`epilogue_user_id`, `deceased_facebook_user_id`, `deceased_name`, `death_date`, `memorial_tagline`) VALUES ($epilogue_user_id, $deceased_facebook_user_id, '$deceased_name', $death_date, '$memorial_tagline')";
 		$db->raw_query($query); 
 		$get_new_id = "SELECT MAX(memorial_id) FROM memorial_id";		
 		$mem_id = $db->fetchAll($get_new_id); 
 		//return $mem_id;
		return array($mem_id,$epilogue_user_id, $deceased_facebook_user_id, $deceased_name);
 	}
 	
 	
 	
 }

 
 
 
 
 